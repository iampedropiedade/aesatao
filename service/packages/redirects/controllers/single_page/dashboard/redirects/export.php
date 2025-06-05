<?php

namespace Concrete\Package\Redirects\Controller\SinglePage\Dashboard\Redirects;

use Concrete\Core\Page\Controller\DashboardSitePageController;
use Concrete\Package\Redirects\Helpers\RedirectsHelper;
use Concrete\Package\Redirects\DataTransformers\Redirect as RedirectTransformer;
use Concrete\Package\Redirects\Exporters\Csv as Exporter;
use Core;

/**
 * Class Export
 * @package Concrete\Package\Redirects\Controller\SinglePage\Dashboard\Redirects
 */
class Export extends DashboardSitePageController
{
    public function view($msg = false)
    {
        $html = Core::make('helper/html');
        $this->addHeaderItem($html->css("dashboard.css", "redirects"));

        if ($msg == "export_complete") {
            $this->set("message", t("Export complete"));
            if (isset($_SESSION["csv_export_errors"])) {
                unset($_SESSION["csv_export_errors"]);
            }
        }
        elseif ($msg == "export_error") {
            $this->set("message", t("Errors detected. Export canceled."));
            $errors = $_SESSION["csv_export_errors"];
            $this->set("export_errors", $errors);
        }
        elseif ($msg == "export_init_error") {
            //$this->set("message", t("Please select a file before you begin the import."));
        }
    }

    public function do_export()
    {
        if ($this->isPost()) {

            $redirectsHelper = new RedirectsHelper();
            $redirectsHelper->setItemsPerPage(200);
            $filename = sprintf('Redirects Export %s.csv', date('Y-m-d H_i_s'));
            $redirectsData = [];
            $redirectTransformer = new RedirectTransformer();
            $redirectsHelper->setSiteId($this->site->getSiteID());
            $redirects = $redirectsHelper->getRedirects();
            foreach ($redirects as $redirect) {
                $redirectsData[] = $redirectTransformer->transform($redirect);
            }
            $totalPages = $redirectsHelper->getTotalPages();

            for ($i = 2; $i <= $totalPages; $i++) {
                $redirectsHelper->setPage($i);
                $redirects = $redirectsHelper->getRedirects();
                foreach ($redirects as $redirect) {
                    $redirectsData[] = $redirectTransformer->transform($redirect);
                }
            }

            $headers = isset($redirectsData[0]) ? array_keys($redirectsData[0]) : [];
            $exporter = new Exporter();
            $exporter->stream($headers, $redirectsData, $filename);

            $this->redirect("/dashboard/redirects/export", "export_complete");

        }
    }

}
