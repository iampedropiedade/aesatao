<?php
defined('C5_EXECUTE') or die(_("Access Denied."));
$ih = Loader::helper('concrete/ui');

$pageUp = Page::getByPath("/dashboard/redirects");
echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('CSV Import'), false, 'span12 offset2', false, array(), $pageUp);

?>
<form action="<?php echo $view->action('do_import')?>" class="form-horizontal" method="post" id="csv-import-form" enctype="multipart/form-data">
    <div class="ccm-pane-body">

        <?php
        if (!empty($import_errors)) {
            ?>
        <div class="csv-import-errors">
            <?php
            foreach ($import_errors as $line => $err) {
                echo '<div class="error-item">';
                echo '<strong>';
                echo t("Line ");
                echo ($line+1);
                echo ": ";
                echo '</strong>';
                echo '<br />';
                echo implode('<br />', $err);
                echo '</div>'; // error-item
            }
            ?>
        </div>
            <?php
        }
        ?>

        <div class="csv-import-description">
            <p><?php echo t("This section allows you to import redirects from a csv file. The structure of the csv file should be the following:"); ?></p>
            <p><?php echo t("It must have 3 columns:"); ?>
            <ol>
            <li><?php echo t("source link, i.e. the URL you want the redirect to be made from, for example: /products.html or just products.html;"); ?></li>
            <li><?php echo t("destination type: PAGE, FILE or URL; other values are not allowed;"); ?></li>
            <li><?php echo t("destination point:"); ?>
            <ul>
            <li><?php echo t("if the destination type is PAGE, you should either specify the page ID number, or the page path, like this: /products/;"); ?></li>
            <li><?php echo t("if the destination type is FILE, you should specify the file ID number;"); ?></li>
            <li><?php echo t("if the destination type is URL, you should specify the destination location as it is, for example: http://www.rawnet.com/"); ?></li>
            </ul>
            </li></ol>
        </div>

        <div class="csv-import-example" style="padding-bottom:30px;">
            <strong><?php echo t("Example"); ?></strong>
            <pre>/products.html,PAGE,/products/<br />/about.html,PAGE,/about/<br />/products2.html,URL,/products/?page=2</pre>
        </div>

        <fieldset>
            <legend>CSV Import</legend>

            <div class="row">
                <div class="form-group">
                    <label class="control-label col-sm-3" for="csv_file"><?php echo t('CSV File') ?></label>
                    <div class="col-sm-7">
                        <div class="input-group">
                            <input type="file" name="csv_file" class="import-file btn btn-secondary"/>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>

    </div>

    <div class="ccm-dashboard-form-actions-wrapper">
        <div class="ccm-dashboard-form-actions">
            <?php echo Loader::helper("form")->submit('csv-import-form', t('Import'), array('class' => 'btn btn-primary pull-right'))?>
        </div>
    </div>

</form>
<?php
echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(false);
?>
