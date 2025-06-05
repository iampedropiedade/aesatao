<?php
defined('C5_EXECUTE') or die('Access Denied.');
use Concrete\Core\Http\ResponseAssetGroup;
use Concrete\Core\Authentication\AuthenticationType;

$r = ResponseAssetGroup::get();
$r->requireAsset('javascript', 'underscore');
$r->requireAsset('javascript', 'core/events');
$form = Loader::helper('form');
if (isset($authType) && $authType) {
    $active = $authType;
    $activeAuths = array($authType);
} else {
    $active = null;
    $activeAuths = AuthenticationType::getList(true, true);
}
if (!isset($authTypeElement)) {
    $authTypeElement = null;
}
if (!isset($authTypeParams)) {
    $authTypeParams = null;
}
?>
<div class="flex flex-wrap mx-[-15px]">
    <div class="w-full md:w-2/3 lg:w-1/2 flex-[0_0_auto] px-[15px] max-w-full !mx-auto !mt-[-10rem]">
        <div class="card">
            <div class="card-body !p-12">
                <ul class="nav nav-tabs nav-tabs-basic">
                    <?php foreach ($activeAuths as $key => $auth) : ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $key === 0 ? 'active' : ''; ?>" data-bs-toggle="tab" href="#<?php echo $auth->getAuthenticationTypeHandle(); ?>">
                                <?php echo $auth->getAuthenticationTypeName(); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <div class="tab-content">
                    <?php foreach ($activeAuths as $key => $auth) : ?>
                        <div class="tab-pane fade py-8 <?php echo $key === 0 ? 'show active' : ''; ?>" id="<?php echo $auth->getAuthenticationTypeHandle(); ?>">
                            <?php $auth->renderForm($authTypeElement ?: 'form', $authTypeParams ?: array()) ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>