<?php
namespace Application\Block\PageSectionAnchor;

use Concrete\Core\Block\BlockController;

class Controller extends BlockController
{
    protected $btTable = 'btPageSectionAnchor';
    protected $btInterfaceWidth = '600';
    protected $btInterfaceHeight = '300';
    protected $btDefaultSet = 'application';

    /**
     * @return string
     */
    public function getBlockTypeDescription()
    {
        return t('Adds invisible anchor on page for internal linking');
    }

    /**
     * @return string
     */
    public function getBlockTypeName()
    {
        return t('Section anchor');
    }

    public function add()
    {
        $this->edit();
    }

    public function edit()
    {
    }
}
