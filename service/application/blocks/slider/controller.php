<?php
namespace Application\Block\Slider;

use Application\Blocks\Controller as BlockController;
use Application\Service\PaginatedItemsList\Builder\Pages;

class Controller extends BlockController
{
    public const ITEM_TYPE_SLIDE = 'slide';

    protected $btCacheBlockOutput = false;
    protected $btTable = 'btSlider';
    protected $btInterfaceWidth = '1280';
    protected $btInterfaceHeight = '1000';
    protected $btDefaultSet = 'application';
    protected $allowedSubItemTypes = [
        self::ITEM_TYPE_SLIDE,
    ];
    protected $searchableFields = ['title', 'subTitle'];
    protected $searchableSubFields = ['title', 'heading', 'content'];
    protected $requiredFields = [
        ['fieldName'=>'title', 'parent'=>'items'],
        ['fieldName'=>'heading', 'parent'=>'items'],
        ['fieldName'=>'content', 'parent'=>'items'],
        ['fieldName'=>'imageId', 'parent'=>'items'],
    ];

    /**
     * @return string
     */
    public function getBlockTypeDescription()
    {
        return t('Galeria / Slider');
    }

    /**
     * @return string
     */
    public function getBlockTypeName()
    {
        return t('Galeria / Slider');
    }

    public function on_start()
    {
        parent::on_start();
    }

    public function add()
    {
        $this->edit();
    }

    public function edit()
    {
        parent::edit();
        $this->set('itemsPerRowOptions', [1=>'1 item', 2=>'2 items', 3=>'3 items', 4=>'4 items', 6=>'6 items']);
    }

    public function view()
    {
        parent::view();
    }
}