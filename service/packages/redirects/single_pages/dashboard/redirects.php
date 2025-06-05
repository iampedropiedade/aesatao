<?php
defined('C5_EXECUTE') or die(_("Access Denied."));

use \Concrete\Core\File\File;

$nh = Loader::helper("navigation");
$validation_token = Loader::helper("validation/token");
Loader::model("file");

echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Redirects'), false, 'span16', true);
?>

<?php if ($errorMessage) : ?>
    <div class="ccm-ui" id="ccm-dashboard-result-message">
        <div class="row">
            <div class="span12">
                <div class="alert alert-danger alert-dismissible">
                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button> <?php echo $errorMessage[0]; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if ($successMessage) : ?>
    <div class="ccm-ui" id="ccm-dashboard-result-message">
        <div class="row">
            <div class="span12">
                <div class="alert alert-success alert-dismissible">
                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button> <?php echo $successMessage[0]; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<form name="redirect_search" id="redirect_search" action="/dashboard/redirects" method="get" style="padding-bottom: 10px">
    <div class="form-group">
        <?php echo $form->search('redirect_search[search]', $lastSearch, ["placeholder"=>"Search for redirect"]); ?>
    </div>
</form>

<?php if (empty($redirects)) : ?>
    <p><?php echo t("There are no redirects to display."); ?></p>
<?php else : ?>
    <div id="validation-token-wrapper" style="display: none;">
        <?php $validation_token->output("delete_redirect"); ?>
        <a href="<?php echo $this->url("/dashboard/redirects", "delete_redirect"); ?>">submit</a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><span>Redirect From</span></th>
                    <th><span>Redirect To</span></th>
                    <th><span>Actions</span></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($redirects as $k => $redirect) : ?>
                    <?php
                        $redirect_to = $redirect["redirect_to"];
                    if ($redirect["redirect_type"] == "P") {
                        $rpage = Page::getByID($redirect_to);
                        $rpage = Page::getByID($redirect_to);
                        $redirect_to = $nh->getLinkToCollection($rpage);
                    }
                    elseif ($redirect["redirect_type"] == "F") {
                        $rfile = File::getByID($redirect_to);
                        $redirect_to = View::url('/download_file', $redirect_to);
                    }
                    ?>
                    <tr id="redirect-row-<?php echo $redirect["ID"]; ?>">
                        <td>
                            <?php if ($redirect["isRegexp"] == "N") : ?>
                                <a href="/<?php echo $redirect["redirect_from"]; ?>" target="_blank">/<?php echo $redirect["redirect_from"]; ?></a>
                            <?php else : ?>
                                <?php echo t('REGEXP:') . " " . htmlspecialchars($redirect["redirect_from"]); ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($redirect["redirect_type"] == "M") : ?>
                                <?php echo t("REGEXP REPLACEMENT: "); ?>
                                <?php echo htmlspecialchars($redirect_to); ?>
                            <?php else : ?>
                                <a href="<?php echo $redirect_to; ?>" target="_blank">
                                    <?php if ($redirect["redirect_type"] == "F") : ?>
                                        <?php echo $rfile ? $rfile->getApprovedVersion()->getFileName() : "No file found"; ?>
                                    <?php else : ?>
                                        <?php echo $redirect_to; ?>
                                    <?php endif; ?>
                                </a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a class="del-button btn btn-xs btn-danger">Delete</a>
                            <a class="btn btn-xs btn-info" href="/dashboard/redirects/edit/<?php echo $redirect["ID"]; ?>">Edit</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
<?php if ($total_pages > 1) : ?>
    <?php $uh = \Loader::helper("url"); ?>
        <div class="redirects-pagination">
        <?php echo t("Pages:"); ?>
        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
            <?php if ($i == $current_page) : ?>
                <strong><?php echo $i; ?></strong>
            <?php else : ?>
                <a href="<?php echo $uh->setVariable("page", $i); ?>"><?php echo $i; ?></a>
            <?php endif; ?>
        <?php endfor; ?>
    </div>
<?php endif; ?>
<hr />
<h4>Add Redirect</h4>
<?php
Loader::packageElement("dashboard/add_redirect", "redirects", array(
    'action' => $view->action('add_redirect'),
    'from' => null,
    'redirect_to' => null,
    'redirect_type' => null,
    'isWildchar' => null,
    'isRegexp' => null
));

echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(true);
