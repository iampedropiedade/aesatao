<?php
use Concrete\Core\Page\Page;
use Application\Service\Tags;

if(isset($hideTags) && $hideTags === true) {
    return;
}
$tags = (new Tags())->getTags(Page::getCurrentPage());
if(empty($tags)) {
    return;
}
?>
<div class="mt-4">
    <?php foreach($tags as $tag): ?>
        <a class="badge bg-brightGray !text-royalBlue rounded-full py-1 mr-2" href="<?php echo $tag->getUrl(); ?>">
            <?php echo $tag->getTag(); ?>
        </a>
    <?php endforeach; ?>
</div>
