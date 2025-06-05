<?php
namespace Application\Block\Hero;

use Application\Constants\Attributes;
use Application\Service\Picture;
use Application\Blocks\Controller as BlockController;
use Concrete\Core\Editor\LinkAbstractor;
use Concrete\Core\File\File;
use Concrete\Core\Page\Page;

class Controller extends BlockController
{
    protected $btInterfaceWidth = 1200;
    protected $btInterfaceHeight = 900;
    protected $btTable = 'btCustomHero';
    protected $btCacheBlockOutput = true;
    protected $btCacheBlockOutputOnPost = true;
    protected $btCacheBlockOutputForRegisteredUsers = true;
    protected $btDefaultSet = 'application';
    protected $searchableFields = ['title', 'description'];

    public function getBlockTypeDescription()
    {
        return t('Hero banner');
    }

    public function getBlockTypeName()
    {
        return t('Hero');
    }

    public function edit()
    {
    }

    public function getContentEditMode(string $key): string
    {
        return LinkAbstractor::translateFromEditMode($this->get($key));
    }

    public function save($args)
    {
        $args['imageId']  = $args['imageId'] ?: 0;
        if (isset($args['description'])) {
            $args['description'] = LinkAbstractor::translateTo($args['description']);
        }
        parent::save($args);
    }

    public function view()
    {
        $c = Page::getCurrentPage();
        if($this->get('imageId')) {
            $mainImage = File::getByID($this->get('imageId'));
            if($mainImage) {
                $image = new Picture($mainImage);
                $this->set('image', $image->getSrc(2800, 1150, true));
            }
        }
        $title = $this->get('title');
        $title = str_replace('<span>', '<span class="underline-3 style-3 yellow !relative z-[1] after:content-[\'\'] after:absolute after:z-[-1] after:block after:[background-size:100%_100%] after:bg-no-repeat after:bg-bottom after:bottom-[-0.1em] after:w-[110%] after:h-[0.3em] after:-translate-x-2/4 after:left-2/4">', $title);
        $this->set('title', $title);
        $this->set('description', LinkAbstractor::translateFrom($this->get('description')));
        if($this->get('buttonLinkToSection')) {
            $this->set('buttonLinkUrl', $this->get('buttonLinkToSection'));
        }
        elseif($this->get('buttonPageId')) {
            $page = Page::getByID($this->get('buttonPageId'));
            $this->set('page', $page ?? null);
            $this->set('buttonLinkUrl', $page?->getCollectionLink());
            $this->set('buttonCaption', $this->get('buttonCaption') ?: $page?->getCollectionName());
        }
        $this->set('buttonLinkTarget', starts_with($this->get('buttonLinkUrl'), 'http') ? '_blank' : '_self');
        $navbarStyle = (string) $c->getAttribute(Attributes::NAVBAR_STYLE) ?? 'navbar-light';
        $this->set('navbarStyle', $navbarStyle);
        $this->set('textColor', $navbarStyle === 'navbar-light' ? 'dark' : 'light');
    }
}
