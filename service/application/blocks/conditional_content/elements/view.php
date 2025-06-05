<?php
defined('C5_EXECUTE') or die('Access Denied.');
use Concrete\Core\Page\Page;
use Application\Block\ConditionalContent\Controller;
$c = Page::getCurrentPage();
?>
<?php if(is_object($c) && $c->isEditMode()) : ?>
    <div class="!text-left flex">
        <div class="!px-3 !py-1 !text-white !border-0 !bg-opacity-60 !bg-aesatao !border-aesatao !rounded-full text-[0.7rem]">
            Conteúdos para <?php echo Controller::VIEWED_BY_OPTIONS[$this->controller->get('viewedBy')]; ?>
        </div>
    </div>
<?php endif; ?>
<?php if ($this->controller->get('content')) : ?>
    <div class="wysiwyg">
        <?php echo $this->controller->get('content'); ?>
    </div>
<?php endif; ?>
