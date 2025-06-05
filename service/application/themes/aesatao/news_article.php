<?php
defined('C5_EXECUTE') or die('Access Denied.');
use Concrete\Core\Area\Area;
use Concrete\Core\Page\Page;
assert(isset($c, $gallery));

/** @var array $gallery */
/** @var Page $c */
$this->inc('includes/doc_header.php');
$this->inc('includes/header.php');
$this->inc('widgets/title.php', ['displayDate' => true]);
$a = new Area('Main');
$a->display($c);
?>
    <?php if($gallery) : ?>
        <section class="wrapper">
            <div class="container pb-1‹4 xl:pb-24 lg:pb-20 md:pb-18">
                <div class="flex flex-wrap mx-[-15px] mt-[-30px]">
                    <?php foreach ($gallery as $galleryImage) : ?>
                        <div class="item md:w-6/12 lg:w-4/12 xl:w-4/12 w-full flex-[0_0_auto] px-[15px] max-w-full mt-[30px]">
                            <figure class="overlay overlay-1 hover-scale rounded group">
                                <a href="<?php echo $galleryImage['image']; ?>" data-glightbox data-gallery="gallery-image">
                                    <img class="!transition-all !duration-[0.35s] !ease-in-out group-hover:scale-105" src="<?php echo $galleryImage['thumbnail']; ?>" srcset="<?php echo $galleryImage['thumbnail']; ?>" alt="image">
                                </a>
                            </figure>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php
$a = new Area('Secondary');
$a->display($c);
$this->inc('includes/footer.php');
$this->inc('includes/doc_footer.php');
