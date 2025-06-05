<?php
namespace Application\Block\CardSingle;

use Application\Service\Picture;
use Application\Blocks\Controller as BlockController;
use Concrete\Core\Editor\LinkAbstractor;
use Concrete\Core\File\File;
use Concrete\Core\Page\Page;

class Controller extends BlockController
{
    protected const array CARD_STYLE_OPTIONS = [
        'image_left' => 'Imagem do lado esquerdo',
        'image_right' => 'Imagem do lado direito',
    ];
    protected $btTable = 'btCardSingle';
    protected $btInterfaceWidth = '900';
    protected $btInterfaceHeight = '600';
    protected $btDefaultSet = 'application';
    protected $searchableFields = ['title', 'subTitle', 'content'];

    /**
     * @return string
     */
    public function getBlockTypeDescription()
    {
        return t('Card');
    }

    /**
     * @return string
     */
    public function getBlockTypeName()
    {
        return t('Card');
    }

    public function add()
    {
        $this->edit();
    }

    public function edit()
    {
        $this->set('cardStyleOptions', self::CARD_STYLE_OPTIONS);
    }

    public function getContentEditMode()
    {
        return LinkAbstractor::translateFromEditMode($this->get('content'));
    }

    public function view()
    {
        $this->set('content', LinkAbstractor::translateFrom($this->get('content')));
        if($this->get('imageId')) {
            $mainImage = File::getByID($this->get('imageId'));
            if($mainImage) {
                $image = new Picture($mainImage);
                $this->set('image', $image->getSrc(800, 600, true));
            }
        }
        if($this->get('ctaPageId')) {
            $page = Page::getByID($this->get('ctaPageId'));
            if($page) {
                $this->set('ctaUrl', $page->getCollectionLink());
                if(!$this->get('ctaCaption')) {
                    $this->set('ctaCaption', $page->getCollectionName());
                }
            }
        }
    }
}
