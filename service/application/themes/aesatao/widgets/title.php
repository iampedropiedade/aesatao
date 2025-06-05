<?php
defined('C5_EXECUTE') or die("Access Denied.");
use Application\Navigation\Navigation;
use Application\Service\Picture;
use Concrete\Core\Page\Page;
use Application\Constants\Attributes;
assert(isset($c));
/** @var Page $c */
$hideTitle = $c->getAttribute(Attributes::HIDE_TITLE);
if($hideTitle) {
    return;
}
$navigation = new Navigation();
$breadcrumbs = $navigation->getBreadcrumbs();
$breadcrumbCount = count($breadcrumbs);
$mainImage = $c->getAttribute(Attributes::MAIN_IMAGE);
$imageSrc = null;
if($mainImage) {
    $image = new Picture($mainImage);
    $imageSrc = $image->getSrc(2800, 1150, true);
}
?>
<?php if($imageSrc !== null) : ?>
    <section
            class="wrapper image-wrapper bg-image bg-overlay text-white bg-no-repeat bg-[center_center] bg-cover relative z-0 !bg-fixed before:content-[''] before:block before:absolute before:z-[1] before:w-full before:h-full before:left-0 before:top-0 before:bg-[rgba(30,34,40,.5)]"
            data-image-src="<?php echo $imageSrc; ?>">
        <div class="container pt-36 xl:pt-[12.5rem] lg:pt-[12.5rem] md:pt-[12.5rem] pb-32 xl:pb-40 lg:pb-40 md:pb-40 !text-center">
            <div class="flex flex-wrap mx-[-15px]">
                <div class="md:w-10/12 lg:w-8/12 xl:w-7/12 xxl:w-6/12 w-full flex-[0_0_auto] px-[15px] max-w-full !mx-auto">
                    <h1 class="text-[calc(1.365rem_+_1.38vw)] font-bold leading-[1.2] xl:text-[2.4rem] text-white !mb-3">
                        <?php echo $c->getCollectionName(); ?>
                    </h1>
                    <p class="lead text-[1.05rem] leading-[1.6] font-medium md:!px-3 lg:!px-7 xl:!px-9 xxl:!px-10">
                        <?php echo $c->getCollectionDescription(); ?>
                    </p>
                </div>
            </div>
            <?php $this->inc('widgets/breadcrumbs.php', ['linkClasses' => 'text-white underline', 'spanClasses' => 'text-white']); ?>
            <?php $this->inc('widgets/publish_date.php', ['displayDate' => $displayDate ?? false]); ?>
            <?php $this->inc('widgets/tags.php', ['hideTags' => $hideTags ?? false]); ?>
        </div>
    </section>
<?php else : ?>
    <section class="relative flex wrapper bg-soft-primary !bg-white"
             style="background-image: url(<?php echo $this->getThemePath() ?>/app/img/patterns/subtle-prism.svg); background-repeat: repeat; background-position: center center; background-size: cover; ">
        <div class="h-full w-full absolute top-0 left-0">
        </div>
        <div class="z-10 container pt-[4rem] xl:pt-[8rem] lg:pt-[6rem] md:pt-[4rem] pb-[2rem] xl:pb-[6rem] lg:pb-[4rem] md:pb-[2rem] !text-center">
            <div class="flex flex-wrap mx-[-15px]">
                <div class="md:w-10/12 lg:w-8/12 xl:w-7/12 xxl:w-6/12 w-full flex-[0_0_auto] px-[15px] max-w-full !mx-auto">
                    <h1 class="text-[calc(1.365rem_+_1.38vw)] font-bold leading-[1.2] xl:text-[2.4rem] !mb-3"><?php echo $c->getCollectionName(); ?></h1>
                    <p class="lead text-[1.05rem] leading-[1.6] font-medium md:!px-3 lg:!px-7 xl:!px-9 xxl:!px-10">
                        <?php echo $c->getCollectionDescription(); ?>
                    </p>
                </div>
            </div>
            <?php $this->inc('widgets/breadcrumbs.php'); ?>
            <?php $this->inc('widgets/publish_date.php', ['displayDate' => $displayDate ?? false]); ?>
            <?php $this->inc('widgets/tags.php', ['hideTags' => $hideTags ?? false]); ?>
        </div>
    </section>
<?php endif; ?>

