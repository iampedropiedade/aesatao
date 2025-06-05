<?php

namespace Application\Controller\PageType;

use Application\Controller\AbstractPageController;
use Application\Service\Gallery;
use Concrete\Core\Page\Page;
use Application\Constants\Attributes;

class NewsArticle extends AbstractPageController
{
    public function view(): void
    {
        $this->set('gallery', (new Gallery())->getGalleryForPage(Page::getCurrentPage()));
    }
}
