<?php
/**
 * Created by PhpStorm.
 * User: pedropiedade
 * Date: 2019-02-28
 * Time: 17:13
 */
use \Concrete\Core\File\File;
use Concrete\Core\Application\Service\FileManager;
use \Concrete\Core\Form\Service\Widget\PageSelector;
assert(isset($data, $code, $controller, $type, $form));

if($data && isset($data['image_id'])) {
    $image = File::getByID($data['image_id']);
}
$al = new FileManager();
$ps = new PageSelector();
?>
<div class="list_item sortable_item">
    <?php echo $controller->getItemTitle('Image', $code, $type); ?>
    <div class="list_item-main">
        <fieldset>
            <h4>Slide</h4>
            <div class="form-group">
                <?php echo $form->label('items[' . $code . '][heading]', t('Título principal')); ?>
                <?php echo $form->text('items[' . $code . '][heading]', $data['heading'] ?? ''); ?>
            </div>
            <div class="form-group">
                <?php echo $form->label('items[' . $code . '][title]', t('Título')); ?>
                <?php echo $form->text('items[' . $code . '][title]', $data['title'] ?? '', ['required'=>'required']); ?>
            </div>
            <div class="form-group">
                <?php echo \Core::make('editor')->outputStandardEditor('items[' . $code . '][content]', $data['content'] ?? '', ['required'=>'required']); ?>
            </div>
            <div class="form-group">
                <?php echo $form->label('items_' . $code . '_image_id', t('Image')); ?>
                <?php echo $al->image('items_' . $code . '_image_id', 'items[' . $code . '][image_id]', 'Select an image', $image ?? null); ?>
            </div>
        </fieldset>
        <hr />
        <fieldset class="mt-8">
            <h4>CTA</h4>
            <div class="form-group">
                <?php echo $form->label('items[' . $code . '][cta_page_id]', t('CTA link to page')); ?>
                <?php echo $ps->selectPage('items[' . $code . '][cta_page_id]', $data['cta_page_id'] ?? false); ?>
            </div>
            <div class="form-group">
                <?php echo $form->label('items[' . $code . '][cta_caption]', t('CTA caption')); ?>
                <?php echo $form->text('items[' . $code . '][cta_caption]', $data['cta_caption'] ?? ''); ?>
            </div>
        </fieldset class="mt-8">
        <hr />
        <fieldset>
            <h4>Slider navigation</h4>
            <div class="form-group">
                <?php echo $form->label('items[' . $code . '][nav_title]', t('Nav title')); ?>
                <?php echo $form->text('items[' . $code . '][nav_title]', $data['nav_title'] ?? ''); ?>
            </div>
            <div class="form-group">
                <?php echo $form->label('items[' . $code . '][nav_icon]', t('Nav icon')); ?>
                <?php echo $form->text('items[' . $code . '][nav_icon]', $data['nav_icon'] ?? ''); ?>
            </div>
        </fieldset>

    </div>
</div>