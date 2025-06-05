<?php
use Concrete\Core\Page\Page;

if(!isset($displayDate) || $displayDate !== true) {
    return;
}
$c = Page::getCurrentPage();

$formatter = (new IntlDateFormatter('pt_PT', IntlDateFormatter::LONG, IntlDateFormatter::SHORT));
$formatter->setPattern('d \'de\' MMMM \'de\' y');
?>
<div class="mt-4">
    <span class="px-4 py-2 rounded-full bg-[#467498] bg-opacity-25 text-[0.6rem]">
        <i class="fa-regular fa-calendar pr-2"></i><span>Publicado <?php echo $formatter->format($c->getCollectionDatePublicObject()); ?></span>

    </span>
</div>
