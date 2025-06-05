<?php

namespace Concrete\Package\Redirects\Controller\SinglePage\Dashboard\Redirects;

use Concrete\Core\Page\Controller\DashboardSitePageController;
use Concrete\Package\Redirects\Helpers\ImportHelper;
use Core;

/**
 * Class Import
 * @package Concrete\Package\Redirects\Controller\SinglePage\Dashboard\Redirects
 */
class Import extends DashboardSitePageController
{
    public function view($msg = false)
    {
        $html = Core::make('helper/html');
        $this->addHeaderItem($html->css("dashboard.css", "redirects"));

        if ($msg == "import_complete") {
            $this->set("message", t("Import complete"));
            if (isset($_SESSION["csv_import_errors"])) {
                unset($_SESSION["csv_import_errors"]);
            }
        }
        elseif ($msg == "import_error") {
            $this->set("message", t("Errors detected. Import canceled. Please correct the csv file and retry."));
            $errors = $_SESSION["csv_import_errors"];
            $this->set("import_errors", $errors);
        }
        elseif ($msg == "import_init_error") {
            $this->set("message", t("Please select a file before you begin the import."));
        }
    }

    public function do_import()
    {
        if ($this->isPost()) {

            $errors = array();
            $rows = array();

            $filepath = $_FILES["csv_file"]["tmp_name"];

            if ($filepath) {

                $rows = ImportHelper::readCSV($filepath, ",");

                foreach ($rows as $rowIndex => $row) {
                    $err = ImportHelper::validateRow($row);
                    if (!empty($err)) {
                        $errors[$rowIndex] = $err;
                    }
                }

                if (empty($errors)) {
                    ImportHelper::importData($rows, $this->site->getSiteID());
                }
                else {
                    $_SESSION["csv_import_errors"] = $errors;
                    $this->redirect("/dashboard/redirects/import", "import_error");
                }

                $this->redirect("/dashboard/redirects/import", "import_complete");
            }
            else {
                $this->redirect("/dashboard/redirects/import", "import_init_error");
            }
        }

        $this->redirect("/dashboard/redirects/import");
    }

}
