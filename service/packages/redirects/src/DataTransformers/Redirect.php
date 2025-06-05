<?php
namespace Concrete\Package\Redirects\DataTransformers;

use Concrete\Core\File\File;
use Concrete\Core\Page\Page;
use \Concrete\Core\Legacy\Loader;

class Redirect
{
    /**
     * @param array $redirect
     * @return array
     */
    public function transform(array $redirect) : array
    {
        $nh = Loader::helper("navigation");
        if ($redirect["redirect_type"] == "P") {
            $rpage = Page::getByID($redirect['redirect_to']);
            $redirect_to = $nh->getLinkToCollection($rpage);
        }
        elseif ($redirect["redirect_type"] == "U") {
            $redirect_to = $redirect['redirect_to'];
            if (strpos($redirect_to, "http://") !== 0 && strpos($redirect_to, "https://") !== 0 && strpos($redirect_to, "/") !== 0) {
                $redirect_to = "/" . $redirect_to;
            }
        } 
        elseif ($redirect["redirect_type"] == "M") {
            $redirect_to = $redirect['redirect_to'];
        }
        elseif ($redirect["redirect_type"] == "F") {
            $rfile = File::getByID($redirect['redirect_to']);
            if (!empty($rfile)) {
                $redirect_to = $rfile->getApprovedVersion()->getRelativePath(); //View::url('/download_file', $redirect['redirect_to']); 
            } else {
                $redirect_to = 'Broken';
            }
        }

        $data = [];
        $data['redirect_from'] = $redirect['redirect_from'];
        $data['redirect_to'] = $redirect_to;
        //$data['date_added'] = $page->getCollectionDatePublic();
        return $data;
    }

}
