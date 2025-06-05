<?php
defined('C5_EXECUTE') or die(_("Access Denied."));
$ih = Loader::helper('concrete/ui');
$ph = Loader::helper('form/page_selector');
$al = Loader::helper("concrete/asset_library");
$form = Loader::helper('form');
?>
<form <?php print $action ? 'action="' . $action . '"' : ''; ?> method="post" id="add-redirect-form">
    <fieldset>
        <div class="form-group">
            <label class="control-label" for="redirect_from"><?php print t('Redirect from') ?></label>
            <?php print $form->text('redirect_from', $from); ?>
        </div>
        <div class="form-group">
            <label class="control-label" for="redirect_from"><?php print t('Redirect to') ?></label>
            <div class="input-group">
                <table class="redirect-type-table">
                    <tr>
                        <td>
                            <label for="redirect-type-P">
                                <input id="redirect-type-P" class="redirect-type-input" type="radio" name="redirect_type" value="P" <?php print (!$redirect_type || $redirect_type === 'P') ? 'checked="checked"' : ''; ?>>
                                <?php print t("Page"); ?>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="redirect-type-F">
                                <input id="redirect-type-F" class="redirect-type-input" type="radio" name="redirect_type" value="F" <?php print $redirect_type === 'F' ? 'checked="checked"' : ''; ?>>
                                <?php print t("File"); ?>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="redirect-type-U">
                                <input class="redirect-type-input" id="redirect-type-U" type="radio" name="redirect_type" value="U" <?php print $redirect_type === 'U' ? 'checked="checked"' : ''; ?>>
                                <?php print t("External/Static URL"); ?>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="type-M">
                            <label for="redirect-type-M">
                                <input class="redirect-type-input" id="redirect-type-M" type="radio" name="redirect_type" value="M" <?php print $redirect_type === 'M' ? 'checked="checked"' : ''; ?>>
                                <?php print t("Regular expression replacement"); ?>
                            </label>
                        </td>
                    </tr>
                </table>
                <div class="redirect-type-P-panel" <?php print $redirect_type && $redirect_type !== 'P' ? 'style="display: none;"' : ''; ?>>
                    <?php print $ph->selectPage('redirectPage', $redirect_type && $redirect_type !== 'P' ? false : $redirect_to); ?>
                </div>
                <div class="redirect-type-U-panel" <?php print $redirect_type !== 'U' ? 'style="display: none;"' : ''; ?>>
                    <input id="new-redirect-to" type="text" name="redirect_to" size="60" value="<?php print $redirect_type === 'U' ? $redirect_to : ''; ?>"/>
                    <div class="redirect-matches">
                        <?php print t("Example: ") . '/products/\1/'; ?>
                    </div>
                </div>
                <div class="redirect-type-F-panel" <?php print $redirect_type !== 'F' ? 'style="display: none;"' : ''; ?>>
                    <?php print $al->file('redirect-to-file', "redirectFile", t('Choose File'), $redirect_type === 'F' ? $redirect_to : null); ?>
                </div>
            </div>
        </div>
    </fieldset>
    <div class="ccm-dashboard-form-actions-wrapper">
        <div class="ccm-dashboard-form-actions">
            <?php print Loader::helper("form")->submit('add-redirect-form', t('Save Redirect'), array('class' => 'btn btn-primary pull-right'))?>
        </div>
    </div>
</form>
