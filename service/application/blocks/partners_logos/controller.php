<?php
namespace Application\Block\PartnersLogos;

use Concrete\Core\Block\BlockController;
use Concrete\Core\Editor\LinkAbstractor;

class Controller extends BlockController
{
    protected $btTable = 'btPartnersLogos';
    protected $btInterfaceWidth = '900';
    protected $btInterfaceHeight = '600';
    protected $btDefaultSet = 'application';

    /**
     * @return string
     */
    public function getBlockTypeDescription()
    {
        return t('Renders a section with partners logos');
    }

    /**
     * @return string
     */
    public function getBlockTypeName()
    {
        return t('Partners logos');
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
        return LinkAbstractor::translateFromEditMode($this->get('intro'));
    }

    public function view()
    {
        $this->set('intro', LinkAbstractor::translateFrom($this->get('intro')));
    }
}
