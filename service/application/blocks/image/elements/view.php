<?php
defined('C5_EXECUTE') or die('Access Denied.');
use Concrete\Core\Support\Facade\Application;
use HtmlObject\Image as HtmlImage;
$app = Application::getFacadeApplication();

if (!is_object($f)) {
    return;
}
$imageTag = new HtmlImage();
$fallbackSrc = $f->getRelativePath();
$image = new \Application\Service\Picture($f);
$imageSrc = $image->getSrc(1200, 1200);
?>
<div class="content-center text-center">
    <img src="<?php echo $imageSrc; ?>" class="inline max-w-full" />
</div>
