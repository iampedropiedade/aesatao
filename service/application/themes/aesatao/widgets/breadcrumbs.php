<?php
defined('C5_EXECUTE') or die("Access Denied.");
use Application\Navigation\Navigation;
use Concrete\Core\Page\Page;
assert(isset($c));
/** @var Page $c */
$navigation = new Navigation();
$breadcrumbs = $navigation->getBreadcrumbs();
$breadcrumbCount = count($breadcrumbs);
$linkClasses = $linkClasses ?? 'text-[#467498] underline';
$spanClasses = $spanClasses ?? 'text-[#60697b]';
?>
<nav class="inline-block mt-2" aria-label="breadcrumb">
    <ol class="breadcrumb flex flex-wrap bg-[none] mb-4 p-0 !rounded-none list-none text-[0.7rem]">
        <?php foreach($breadcrumbs as $key => $breadcrumb) : ?>
            <li class="breadcrumb-item flex text-[#60697b]">
                <?php if($breadcrumbCount > $key + 1) : ?>
                    <a class="<?php echo $linkClasses; ?>" href="<?php echo $breadcrumb->getCollectionLink(); ?>"><?php echo $breadcrumb->getCollectionName(); ?></a>
                <?php else : ?>
                    <span class="<?php echo $spanClasses; ?>"><?php echo $breadcrumb->getCollectionName(); ?></span>
                <?php endif; ?>
            </li>
            <?php if($breadcrumbCount > $key + 1) : ?>
                <li class="breadcrumb-item flex <?php echo $spanClasses; ?> mx-1"> / </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ol>
</nav>