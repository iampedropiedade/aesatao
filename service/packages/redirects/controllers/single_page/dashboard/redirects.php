<?php

namespace Concrete\Package\Redirects\Controller\SinglePage\Dashboard;

use Concrete\Core\Page\Controller\DashboardSitePageController;
use Concrete\Package\Redirects\Helpers\RedirectsHelper;
use Core;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;

/**
 * Class Redirects
 * @package Concrete\Package\Redirects\Controller\SinglePage\Dashboard\Redirects
 */
class Redirects extends DashboardSitePageController
{

    public function on_start()
    {
        parent::on_start();

        $html = Core::make('helper/html');
        $this->addHeaderItem($html->css('dashboard.css', 'redirects'));
        $this->addFooterItem($html->javascript('redirects.js', 'redirects'));
    }

    public function view($msg = false)
    {
        if ($msg == "added") {
            $this->set("message", t("Redirect added"));
        }
        elseif ($msg == "error") {
            $this->set("message", t("Please ensure you enter all the information required"));
        }

        $current_page = 1;
        if (isset($_GET['page'])) {
            $current_page = intval($_GET["page"]);
            if ($current_page <= 1) {
                $current_page = 1;
            }
        }

        $redirectsHelper = new RedirectsHelper();
        $redirectsHelper->setPage($current_page);
        $redirectsHelper->setItemsPerPage(50);
        $redirectsHelper->setSiteId($this->site->getSiteID());

        $this->set("current_page", $current_page);
        $this->set("redirects", $redirectsHelper->getRedirects());
        $this->set("total_pages", $redirectsHelper->getTotalPages());

        $lastSearch = "";
        if ($search = $this->request->query->get('redirect_search')) {
            $lastSearch = $search['search'];
        }

        $this->set('lastSearch', $lastSearch);

        /**
         * @var FlashBag $session
         */
        $session = \Session::getFlashBag();

        $error = "";
        $success = "";

        if ($session->has('error')) {
            $error = $session->get('error');
        }
        if ($session->has('success')) {
            $success = $session->get('success');
        }

        $this->set('errorMessage', $error);
        $this->set('successMessage', $success);

    }

    public function add_redirect($msg = false)
    {
        if ($this->isPost()) {

            if ($this->post("redirect_from") && $this->post("redirect_type")) {

                $redirect_type = $this->post("redirect_type");
                if (!in_array($redirect_type, array("P", "U", "F", "M"))) {
                    $redirect_type = "U";
                }

                if ($redirect_type == "U") {
                    $redirect_to = $this->post("redirect_to");
                    if (strpos($redirect_to, "http://") !== 0 && strpos($redirect_to, "https://") !== 0 && strpos($redirect_to, "/") !== 0) {
                        $redirect_to = "/" . $redirect_to;
                    }
                }
                elseif ($redirect_type == "F") {
                    $redirect_to = $this->post("redirectFile");
                }
                elseif ($redirect_type == "M") {
                    $redirect_to = $this->post("redirect_to");
                }
                else {
                    $redirect_to = $this->post("redirectPage");
                }

                $is_preg = false;
                if ($this->post("redirect_from_type") == "regexp") {
                    $is_preg = true;
                }

                $data = array(
                    "redirect_from" => $this->post("redirect_from"),
                    "redirect_to" => $redirect_to,
                    "redirect_type" => $redirect_type,
                    "is_preg" => $is_preg,
                    "site_id" => $this->site->getSiteID(),
                );

                $id = RedirectsHelper::addRedirect($data);

                $this->redirect("/dashboard/redirects", "view", "added");
            }
            else {
                $this->redirect("/dashboard/redirects", "view", "error");
            }
        }
    }

    public function delete_redirect()
    {
        // method is called via ajax request
        if ($this->isPost()) {
            $validation_token = Core::make('helper/validation/token');
            if ($validation_token->validate("delete_redirect")) {
                $redirectID = intval($this->post("redirectID"));
                RedirectsHelper::deleteRedirect($redirectID);

                $json = Core::make('helper/json');
                $data = array(
                    "result" => "OK",
                    "rowID" => $redirectID,
                );
                echo $json->encode($data);
                exit;
            }
        }
    }

}
