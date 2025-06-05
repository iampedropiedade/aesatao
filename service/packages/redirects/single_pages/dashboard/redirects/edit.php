<?php
defined('C5_EXECUTE') or die(_("Access Denied."));

$nh = Loader::helper("navigation");
$validation_token = Loader::helper("validation/token");
Loader::model("file");

echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Redirects'), false, 'span16', true);

echo "<h4>Edit Redirect</h4>";

Loader::packageElement("dashboard/add_redirect", "redirects", array(
    'action' => null,
    'from' => $redirect ? $redirect['redirect_from'] : null,
    'redirect_to' => $redirect ? $redirect['redirect_to'] : null,
    'redirect_type' => $redirect ? $redirect['redirect_type'] : null,
    'isWildchar' => $redirect ? $redirect['isWildchar'] : null,
    'isRegexp' => $redirect ? $redirect['isRegexp'] : null
));

echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(true);
