<?php
defined('C5_EXECUTE') or die('Access Denied.');
use \Concrete\Core\Form\Service\Widget\PageSelector;
use Concrete\Core\Application\Service\FileManager;
assert(isset($form, $controller));

?>
<fieldset>
    <div class="form-group">
        <?php echo $form->label('title', t('Title')); ?>
        <?php echo $form->text('title', $controller->get('title')); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label('intro', t('Intro')); ?>
        <?php echo \Core::make('editor')->outputStandardEditor('intro', $controller->getContentEditMode()); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label('embedCode', t('Embed URL')); ?>
        <small><?php echo t('Please paste the URL only, to allow proper styling of the iframe'); ?></small>
        <?php echo $form->text('embedCode', $controller->get('embedCode'), ['placeholder'=>'https://calendar.google.com/calendar/appointments/schedules/AcZssZ3odPBL4_wd-xuu9ckPYgDVCmVS6txEGrdYYIyV9lXTv74qMIfev2Cd0tZjMHQee6QF-ZB_0G30?gv=true']); ?>
    </div>
</fieldset>