<?php
defined('C5_EXECUTE') or die(_("Access Denied."));
$ih = Loader::helper('concrete/ui');

$pageUp = Page::getByPath("/dashboard/redirects");
echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('CSV Export'), false, 'span12 offset2', false, array(), $pageUp);

?>
<form action="<?php echo $view->action('do_export')?>" class="form-horizontal" method="post" id="csv-export-form" enctype="multipart/form-data">
    <div class="ccm-pane-body">

        <?php
        if (!empty($export_errors)) {
            ?>
        <div class="csv-export-errors">
            <?php
            foreach ($export_errors as $line => $err) {
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

        <div class="csv-export-description">
            <p><?php echo t("Please click button to export all redirects."); ?></p>
        </div>

    </div>

    <div class="ccm-dashboard-form-actions-wrapper">
        <div class="ccm-dashboard-form-actions">
            <?php echo Loader::helper("form")->submit('csv-export-form', t('Export'), array('class' => 'btn btn-primary pull-right'))?>
        </div>
    </div>

</form>
<?php
echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(false);
?>
