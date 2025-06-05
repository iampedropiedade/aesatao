<?php
namespace Application\Service;


use Application\Constants\Attributes;
use Concrete\Core\Page\Page;

class Gallery
{

    public function getGalleryForPage(Page $page): array
    {
        $gallery = [];
        $galleryObjects = $page->getAttribute(Attributes::GALLERY_IMAGES)?->getFileObjects();
        if ($galleryObjects) {
            foreach ($galleryObjects as $galleryImage) {
                $image = new Picture($galleryImage);
                $gallery[] = [
                    'thumbnail' => $image->getSrc(460, 460, true),
                    'image' => $image->getSrc(1200, 1200)
                ];
            }
        }
        return $gallery;
    }
}