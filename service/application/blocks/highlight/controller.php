<?php
namespace Application\Block\Highlight;

use Application\Service\Picture;
use Application\Blocks\Controller as BlockController;
use Concrete\Core\Editor\LinkAbstractor;
use Concrete\Core\File\File;
use Concrete\Core\Page\Page;

class Controller extends BlockController
{
    protected $btTable = 'btHighlight';
    protected $btInterfaceWidth = '900';
    protected $btInterfaceHeight = '600';
    protected $btDefaultSet = 'application';
    protected $searchableFields = ['title', 'subTitle', 'content'];

    /**
     * @return string
     */
    public function getBlockTypeDescription()
    {
        return t('Renders a block with a highlight section');
    }

    /**
     * @return string
     */
    public function getBlockTypeName()
    {
        return t('Highlight');
    }

    public function add()
    {
        $this->edit();
    }

    public function edit()
    {
    }

    public function getContentEditMode()
    {
        return LinkAbstractor::translateFromEditMode($this->get('content'));
    }

    public function save($args)
    {
        $args['backgroundImageId']  = $args['backgroundImageId'] ?: 0;
        if (isset($args['content'])) {
            $args['content'] = LinkAbstractor::translateTo($args['content']);
        }
        parent::save($args);
    }

    public function view()
    {
        if($this->get('backgroundImageId')) {
            $mainImage = File::getByID($this->get('backgroundImageId'));
            if($mainImage) {
                $image = new Picture($mainImage);
                $this->set('backgroundImage', $image->getSrc(2800, 1150, true));
            }
        }
        $content = LinkAbstractor::translateFrom($this->get('content'));
        $content = str_replace('<ul>', '<ul class="m-0 p-0">', $content);
        $content = str_replace('<li>', '<li class="flex flex-row mb-6"><div><i class="fa-solid fa-check !w-[2.6rem] !h-[2.6rem] text-[#343f52] text-[1.5rem] mr-5 mt-1"></i></div><div>', $content);
        $content = str_replace('</li>', '</div></li>', $content);
        $content = str_replace('<h3>', '<h3 class="text-[1rem] tracking-[-0.03em]">', $content);
        $content = str_replace('<h2>', '<h2 class="text-[1rem] tracking-[-0.03em]">', $content);
        $content = str_replace('<h4>', '<h4 class="text-[1rem] tracking-[-0.03em]">', $content);
        $this->set('content', $content);

        if($this->get('buttonLinkToSection')) {
            $this->set('buttonLinkUrl', $this->get('buttonLinkToSection'));
        }
        elseif($this->get('buttonPageId')) {
            $page = Page::getByID($this->get('buttonPageId'));
            $this->set('page', $page ?? null);
            $this->set('buttonLinkUrl', $page?->getCollectionLink());
            $this->set('buttonCaption', $this->get('buttonCaption') ?: $page?->getCollectionName());
        }
    }
}
