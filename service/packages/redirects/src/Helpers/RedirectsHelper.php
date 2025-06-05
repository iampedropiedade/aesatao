<?php

namespace Concrete\Package\Redirects\Helpers;

use Concrete\Core\Database\Connection\Connection;
use Concrete\Core\Http\Request;
use Concrete\Core\Page\Page;
use Concrete\Core\Site\Service;
use Concrete\Core\Support\Facade\Application;
use Concrete\Core\Utility\Service\Text;
use Concrete\Core\View\View;
use Database;
use Core;

class RedirectsHelper
{
    public $page = 1;
    public $items_per_page = 0;
    public $total_items = 0;
    public $total_pages = 1;
    public $site_id = 1;

    public static function getTable()
    {
        return 'Rawnet301Redirects';
    }

    public static function addRedirect($data)
    {
        $db = Database::get();

        $q = "replace into " . self::getTable();
        $q .= " set ";
        $q .= " redirect_from=?,";
        $q .= " redirect_to=?,";
        $q .= " redirect_type=?,";
        $q .= " isWildchar=?,";
        $q .= " isRegexp=?,";

        $isWildchar = "N";
        $isRegexp = "N";
        if ($data["is_preg"]) {
            $isRegexp = "Y";
        } else {
            $data["redirect_from"] = ltrim($data["redirect_from"], "/");
        }

        $orig_from = $data["redirect_from"];
        $schema = @parse_url($data["redirect_from"]);
        if (empty($schema['path'])) {
            $schema['path'] = '';
        }
        $data["redirect_from"] = $schema["path"];
        if (strpos($orig_from, "?") !== false) {
            $data["redirect_from"] .= "?" . $schema["query"];
        }

        if (strpos($data["redirect_from"], "*") !== false && $isRegexp == "N") {
            $isWildchar = "Y";
        }
        $q .= " site_id=?";
        $i = array(
            $data["redirect_from"],
            $data["redirect_to"],
            $data["redirect_type"],
            $isWildchar,
            $isRegexp,
            $data["site_id"],
        );

        $db->query($q, $i);

        return $db->Insert_ID();
    }

    public static function updateRedirect($data)
    {
        $db = Database::get();

        $q = "UPDATE " . self::getTable();
        $q .= " set ";
        $q .= " redirect_from=?,";
        $q .= " redirect_to=?,";
        $q .= " redirect_type=?,";
        $q .= " isWildchar=?,";
        $q .= " isRegexp=?";
        $q .= " WHERE ID = ?";

        $isWildchar = "N";
        $isRegexp = "N";
        if ($data["is_preg"]) {
            $isRegexp = "Y";
        } else {
            $data["redirect_from"] = ltrim($data["redirect_from"], "/");
        }

        $orig_from = $data["redirect_from"];
        $schema = @parse_url($data["redirect_from"]);
        $data["redirect_from"] = $schema["path"];
        if (strpos($orig_from, "?") !== false) {
            $data["redirect_from"] .= "?" . $schema["query"];
        }

        if (strpos($data["redirect_from"], "*") !== false && $isRegexp == "N") {
            $isWildchar = "Y";
        }

        $i = array(
            $data["redirect_from"],
            $data["redirect_to"],
            $data["redirect_type"],
            $isWildchar,
            $isRegexp,
            $data['ID']
        );

        $db->query($q, $i);
    }

    public static function deleteRedirect($redirectID)
    {
        $db = Database::get();

        $redirectID = intval($redirectID);

        $q = "delete from " . self::getTable() . " where ID=?";
        $i = array($redirectID);

        $db->query($q, $i);

        return true;
    }

    public function setItemsPerPage($num)
    {
        $this->items_per_page = intval($num);
    }

    public function setPage($num)
    {
        $this->page = intval($num);
        if ($this->page < 1) {
            $this->page = 1;
        }
    }

    public function getTotalPages()
    {
        return $this->total_pages;
    }

    public function getRedirects()
    {
        /**
         * @var Connection $db
         */
        $db = Database::get();

        $q_count = "select count(1) from ";
        $q = "select * from ";

        $q .= self::getTable();
        $q_count .= self::getTable();

        $request = Request::getInstance();

        $params = $countParams = [];
        $pagePathsCount = 0;
        $q_count .= " WHERE site_id = ?";
        $q .= ' WHERE site_id = ?';
        $params[] = $this->site_id;
        $countParams[] = $this->site_id;

        if ($request->query->has('redirect_search') && array_key_exists('search', $request->query->get('redirect_search')) && !empty($request->query->get('redirect_search')['search'])) {
            $subQuery = ' AND WHERE (redirect_from = ? OR redirect_to = ?)';
            $q_count .= $subQuery;

            // we need to search for the home page, so allow index.php and '/' searches
            if ($request->query->get('redirect_search')['search'] === '/' || $request->query->get('redirect_search')['search'] === 'index.php') {
                $value = 1;
            } else {
                $value = ltrim($request->query->get('redirect_search')['search'], '/');
            }

            $params = [$value, $value];
            $countParams = [$value, $value];

            $q_count2 = "select count(1) from " . self::getTable();
            $subQuery2 = ' r, PagePaths p WHERE r.redirect_to = p.cID AND p.ppIsCanonical = 1 AND p.cPath = ?';

            $q_count2 .= $subQuery2;

            $pagePathsCount = $db->GetOne($q_count2, [$request->query->get('redirect_search')['search']]);

            // We need to union and inner join as redirect_to can be an id of a page or the url :(
            $q .= $subQuery . ' UNION SELECT r.* FROM ' . self::getTable() . $subQuery2;

            /**
             * @var Text $txt
             */
            $txt = \Core::make('helper/text');
            $params[] = '/' . $txt->urlify($request->query->get('redirect_search')['search']);
        }

        $q .= ' order by ID asc';

        $this->total_items = $db->GetOne($q_count, $countParams) + $pagePathsCount;

        if (!empty($this->items_per_page)) {
            $this->total_pages = ceil($this->total_items / $this->items_per_page);
        } else {
            $this->total_pages = 1;
        }

        if ($this->total_pages > 1) {
            $limit = " LIMIT ";
            $limit .= (($this->page - 1) * $this->items_per_page);
            $limit .= ", " . $this->items_per_page;
            $q .= $limit;
        }

        $redirects = $db->GetAll($q, $params);

        return $redirects;
    }

    public static function getWildchars($siteId)
    {
        $db = Database::get();

        $q = "select * from ";
        $q .= self::getTable();
        $q .= ' where isWildchar="Y"';
        $q .= ' and site_id = ?';

        $i = [$siteId];
        $redirects = $db->GetAll($q, $i);

        return $redirects;
    }

    public static function getRegexps($siteId)
    {
        $db = Database::get();

        $q = "select * from ";
        $q .= self::getTable();
        $q .= ' where isRegexp="Y"';
        $q .= ' and site_id = ?';
        $i = [$siteId];
        $redirects = $db->GetAll($q, $i);

        return $redirects;
    }

    public static function getTrailingSlashAlternative($url)
    {
        $url2 = rtrim($url, "/");
        if ($url2 !== $url) {
            return $url2;
        }
        return $url2 . '/';
    }

    public static function getRedirectByURL($url, $siteId)
    {
        $url = ltrim($url, "/");
        $url2 = self::getTrailingSlashAlternative($url);

        $db = Database::get();

        $q = "select * from ";
        $q .= self::getTable();
        $q .= ' where redirect_from=? or redirect_from=?';
        $q .= ' and site_id=?';

        $i = array(
            $url,
            $url2,
            $siteId
        );

        $redirect = $db->GetRow($q, $i);
        return $redirect;
    }

    public static function doRedirect($redirectRec)
    {
        $redirect_to = $redirectRec["redirect_to"];

        if ($redirectRec["redirect_type"] == "P") {
            $nh = Core::make('helper/navigation');

            $pageID = intval($redirect_to);
            $page = Page::getByID($pageID);
            $redirect_to = $nh->getLinkToCollection($page);
        } elseif ($redirectRec["redirect_type"] == "F") {
            $fileID = intval($redirect_to);
            $redirect_to = View::url('/download_file', $fileID);
        } elseif ($redirectRec["isRegexp"] && $redirectRec["redirect_type"] == "M") {
            $redirect_to = preg_replace($redirectRec["redirect_from"], $redirectRec["redirect_to"], $_SERVER["REQUEST_URI"]);
        }

        header("HTTP/1.1 301 Moved Permanently");
        header("Location: $redirect_to");
        exit;
    }

    public static function checkPage($url = null, $siteId = 1)
    {
        $orig_url = $url;

        if ($url === null) {
            $orig_url = $url = $_SERVER["REQUEST_URI"];
        }

        if (strpos($url, "/dashboard/") !== false) {
            return;
        }

        $url = ltrim($url, "/");

        // check the url in the way it is
        $r = self::getRedirectByURL($url, $siteId);
        if (!empty($r)) {
            // perform redirect
            self::doRedirect($r);
            return;
        }

        $r = self::getRedirectByURL(urldecode($url), $siteId);
        if (!empty($r)) {
            // perform redirect
            self::doRedirect($r);
            return;
        }

        // if no matches found, check for wildchars
        $wc = self::getWildchars($siteId);
        foreach ($wc as $w) {
            if (self::matchWildchar($url, $w["redirect_from"])) {
                self::doRedirect($w);
                return;
            }
        }

        // if no wildchars worked, check for regexps
        $wc = self::getRegexps($siteId);
        foreach ($wc as $w) {
            if (self::matchRegexp($orig_url, $w["redirect_from"])) {
                self::doRedirect($w);
                return;
            }
        }
    }

    public static function matchWildchar($url, $pattern)
    {
        $pattern = preg_quote($pattern, "/");
        $pattern = str_replace('\\*', '.*', $pattern);
        if (preg_match('/^' . $pattern . '$/u', $url)) {
            return true;
        }
        $url = urldecode($url);
        if (preg_match('/^' . $pattern . '$/u', $url)) {
            return true;
        } else {
            return false;
        }
    }

    public static function matchRegexp($url, $pattern)
    {
        $url = urldecode($url);

        if (preg_match($pattern, $url)) {
            return true;
        } else {
            return false;
        }
    }

    public static function init()
    {
        /**
         * @var Service $service
         */
        $service = Application::getFacadeApplication()->make(Service::class);
        $site = $service->getSite();
        $siteId = $site ? $site->getSiteID() : 1;
        self::checkPage(null, $siteId);
    }

    /**
     * Returns the redirect by its id
     * @param $id
     * @return array
     */
    public static function getByRedirectId($id)
    {
        /**
         * @var Connection $db
         */
        $db = Database::get();
        $query = 'select * from ' . self::getTable() . ' WHERE ID = ?';

        return $db->fetchAssoc($query, [$id]);
    }

    public function getSiteId(): int
    {
        return $this->site_id;
    }

    public function setSiteId(int $site_id): self
    {
        $this->site_id = $site_id;
        return $this;
    }
}
