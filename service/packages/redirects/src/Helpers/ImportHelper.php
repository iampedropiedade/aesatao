<?php
namespace Concrete\Package\Redirects\Helpers;

use Concrete\Core\Page\Page;
use Concrete\Core\Site\Service;
use Concrete\Core\Support\Facade\Application;

class ImportHelper
{
    public static function validateRow($row, $siteId)
    {

        $errors = array();

        // validate source - must not be empty
        if (empty($row[0])) {
            $errors[] = t("The source link (the first column in csv file) must not be empty");
        }

        // validate destination type - must be one of FILE, PAGE or URL
        if (!in_array($row[1], array("PAGE", "FILE", "URL"))) {
            $errors[] = t("The destination type (the second column in csv file) must be %s, %s or %s", "PAGE", "FILE", "URL");
        }

        // validate destination value - must not be empty, or the PAGE/FILE should exist
        if (empty($row[2])) {
            $errors[] = t("The destination point (the third column in csv file) must not be empty");
        }
        else {
            if ($row[1] == "PAGE") {
                if ($row[2] != "" . intval($row[2])) {
                    $path = $row[2];
                    $cID = self::collectionIdFromPath($path, $siteId);
                    if ($cID < 1) {
                        $errors[] = t("The page path %s not valid. No such page in cms.", $path);
                    }
                }
                else {
                    $p = Page::getByID($row[2]);
                    if ($p->getCollectionID() < 1) {
                        $errors[] = t("The page ID %s not valid. No such page in cms.", $row[2]);
                    }
                }
            }
        }

        return $errors;
    }

    public static function importData($rows, $siteId)
    {
        if (!empty($rows) && is_array($rows)) {
            foreach ($rows as $row) {
                self::importRow($row, $siteId);
            }
        }
    }

    public static function importRow($row, $siteId)
    {
        $redirect_from = $row[0]; // 1st column

        if ($row[1] == "PAGE") {
            $redirect_type = "P";
        }
        elseif ($row[1] == "URL") {
            $redirect_type = "U";
        }
        elseif ($row[1] == "FILE") {
            $redirect_type = "F";
        }

        $redirect_to = $row[2]; // 3rd column
        if ($row[1] == "PAGE") {
            if ($redirect_to != "" . intval($redirect_to)) {
                $redirect_to = self::collectionIdFromPath($redirect_to, $siteId);
            }
        }

        $data = [
            "redirect_from" => $redirect_from,
            "redirect_to" => $redirect_to,
            "redirect_type" => $redirect_type,
            "is_preg" => false,
            "site_id" => $siteId,
        ];

        RedirectsHelper::addRedirect($data);
    }

    public static function collectionIdFromPath($path, $siteId)
    {
        /**
         * @var Service $siteService
         */
        $siteService = Application::getFacadeApplication()->make(Service::class);
        $site = $siteService->getByID($siteId);
        $p = Page::getByPath($path, 'RECENT', $site->getSiteTreeObject());
        if (is_object($p) && $p->getCollectionID() > 0) {
            return $p->getCollectionID();
        }

        return false;
    }

    public static function readCSV($filepath, $delimiter = ";")
    {
        $rows = array();
        $fp = fopen($filepath, "rb");
        if ($fp) {
            while (!feof($fp)) {
                $data = fgetcsv($fp, 8000, $delimiter);
                if (!empty($data)) {
                    $rows[] = $data;
                }
            }
            fclose($fp);
        }
        return $rows;
    }

}
