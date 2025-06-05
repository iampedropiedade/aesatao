<?php defined('C5_EXECUTE') or die('Access denied.'); ?>

<div class="forgotPassword">
    <h4><?= t('Reset Instructions Sent') ?></h4>
    <div class="ccm-message"><?= isset($intro_msg) ? $intro_msg : '' ?></div>
    <div class="py-5">
        <?= t('If there is an account associated with this email, instructions for resetting your password have been sent.') ?>
    </div>
    <a href="<?= URL::to('/login') ?>" class="btn btn-primary py-3 px-5">Voltar para a página de login</a>
</div>
