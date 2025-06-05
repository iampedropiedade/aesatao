<?php
defined('C5_EXECUTE') or die('Access Denied.');
use Concrete\Core\Page\Page;
/** @var array<Page> $pages */
$pages = $this->controller->get('pages');
if(count($pages) ===  0) {
    return;
}
$level = 0;
?>
<span class="text-[1.5rem]"></span><span class="text-[1.2rem]"></span><span class="text-[0.9rem]"></span><span class="text-[0.6rem]"></span>
<section class="wrapper !bg-[#ffffff]">
    <div class="container py-[4.5rem] xl:!py-24 lg:!py-24 md:!py-24">
        <ul class="p-0 m-0">
            <?php foreach($pages as $page) : ?>
                <li><?php $this->inc('elements/page.php', ['page' => $page, 'controller' => $this->controller, 'level' => $level]); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
