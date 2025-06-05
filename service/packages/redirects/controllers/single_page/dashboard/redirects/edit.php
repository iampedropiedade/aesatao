<?php

namespace Concrete\Package\Redirects\Controller\SinglePage\Dashboard\Redirects;

use Concrete\Core\Http\Request;
use Concrete\Core\Page\Controller\DashboardPageController;
use Concrete\Package\Redirects\Helpers\RedirectsHelper;
use Core;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;

/**
 * Class Edit
 * @package Concrete\Package\Redirects\Controller\SinglePage\Dashboard\Redirects
 */
class Edit extends DashboardPageController
{
    public function on_start()
    {
        parent::on_start();
        
        $html = Core::make('helper/html');
        $this->addHeaderItem($html->css('dashboard.css', 'redirects'));
        $this->addFooterItem($html->javascript('redirects.js', 'redirects'));
    }

    public function view($id = null)
    {
        $request = Request::getInstance();

        if ($request->isMethod('POST')) {
            $this->addRedirect($id);
            /**
             * @var FlashBag $session
             */
            $session = \Session::getFlashBag();
            $session->set('success', 'Redirect updated.');

            $this->redirect("/dashboard/redirects");
        }

        $redirect = RedirectsHelper::getByRedirectId($id);
        if ($redirect == false) {
            /**
             * @var FlashBag $session
             */
            $session = \Session::getFlashBag();
            $session->set('error', 'Unable to find redirect to edit.');
            $this->redirect('/dashboard/redirects');
        }

        $this->set('redirect', $redirect);
    }

    private function addRedirect($id)
    {
        $redirect_type = $this->post("redirect_type");
        if (!in_array($redirect_type, array("P", "U", "F", "M"))) {
            $redirect_type = "U";
        }

        if ($redirect_type == "U") {
            $redirect_to = $this->post("redirect_to");
            if (strpos($redirect_to, "http://") !== 0 && strpos($redirect_to, "https://") !== 0 && strpos($redirect_to, "/") !== 0) {
                $redirect_to = "/" . $redirect_to;
            }
        } elseif ($redirect_type == "F") {
            $redirect_to = $this->post("redirectFile");
        } elseif ($redirect_type == "M") {
            $redirect_to = $this->post("redirect_to");
        } else {
            $redirect_to = $this->post("redirectPage");
        }

        $is_preg = false;
        if ($this->post("redirect_from_type") == "regexp") {
            $is_preg = true;
        }

        $data = array(
            "ID" => $id,
            "redirect_from" => $this->post("redirect_from"),
            "redirect_to" => $redirect_to,
            "redirect_type" => $redirect_type,
            "is_preg" => $is_preg,
        );

        RedirectsHelper::updateRedirect($data);
    }
}
