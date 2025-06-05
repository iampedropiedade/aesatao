<?php
namespace Application\Block\Stats;

use Application\Blocks\Controller as BlockController;
use Application\Constants\Icons;

class Controller extends BlockController
{
    public const ITEM_TYPE_STAT = 'stat';

    protected $btCacheBlockOutput = false;
    protected $btTable = 'btStats';
    protected $btInterfaceWidth = '1280';
    protected $btInterfaceHeight = '1000';
    protected $btDefaultSet = 'application';
    protected $allowedSubItemTypes = [
        self::ITEM_TYPE_STAT,
    ];
    protected $searchableFields = ['title', 'subTitle'];
    protected $searchableSubFields = ['title', 'subtitle', 'stat'];
    protected $requiredFields = [
        ['fieldName'=>'title', 'parent'=>'items'],
        ['fieldName'=>'subtitle', 'parent'=>'items'],
        ['fieldName'=>'stat', 'parent'=>'items'],
        ['fieldName'=>'icon', 'parent'=>'items'],
    ];

    /**
     * @return string
     */
    public function getBlockTypeDescription()
    {
        return t('Estatísticas / Factos');
    }

    /**
     * @return string
     */
    public function getBlockTypeName()
    {
        return t('Estatísticas / Factos');
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
        $this->set('iconsOptions', Icons::ICONS);
    }

    public function view()
    {
        parent::view();
    }
}