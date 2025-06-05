<?php
defined('C5_EXECUTE') or die('Access Denied.');
assert(isset($form, $controller, $view));
?>
<?php echo $this->controller->getEditAssets($view); ?>
<fieldset>
    <div class="form-group">
        <?php echo $form->label('title', t('Section title')); ?>
        <?php echo $form->text('title', $controller->get('title')); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label('subTitle', t('Section subtitle')); ?>
        <?php echo $form->text('subTitle', $controller->get('subTitle')); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label('anchor', t('Section anchor')); ?>
        <?php echo $form->text('anchor', $controller->get('anchor')); ?>
    </div>
</fieldset>
<fieldset>
    <div class="form-group">
        <h4><?php echo t('Items'); ?></h4>
    </div>
    <div class="form-group" data-behaviour="item-list-block">
        <div class="card-item-list-block">
            <div data-target="list-container">
                <?php if ($controller->get('items')) : ?>
                    <?php foreach($controller->get('items') as $key => $value) : ?>
                        <?php echo $controller->action_load_list_item($value, false); ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <div>
            <?php echo $this->controller->getEditButtons(); ?>
        </div>
    </div>
</fieldset>