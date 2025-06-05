<?php
use Concrete\Core\Page\Page;
use Application\Block\CustomSitemap\Controller;

assert(isset($page, $controller, $level));
/** @var Page $page */
/** @var Controller $controller */
$children = $this->controller->getChildPages($page->getCollectionID());
$level++;
?>
<a href="<?php echo $page->getCollectionPath(); ?>" class="text-[<?php echo (1.8 - 0.3 * $level); ?>rem]"><?php echo $page->getCollectionName(); ?></a>
<?php if (count($children) > 0) : ?>
    <ul class="pl-<?php echo $level * 3; ?>">
        <?php foreach($children as $child) : ?>
            <li><?php $this->inc('elements/page.php', ['page' => $child, 'controller' => $controller, 'level' => $level]); ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>