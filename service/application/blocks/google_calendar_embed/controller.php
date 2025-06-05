<?php
namespace Application\Block\GoogleCalendarEmbed;

use Concrete\Core\Block\BlockController;
use Concrete\Core\Editor\LinkAbstractor;

class Controller extends BlockController
{
    protected $btTable = 'btGoogleCalendarEmbed';
    protected $btInterfaceWidth = '900';
    protected $btInterfaceHeight = '600';
    protected $btDefaultSet = 'application';

    /**
     * @return string
     */
    public function getBlockTypeDescription()
    {
        return t('Renders an embedded Google Calendar');
    }

    /**
     * @return string
     */
    public function getBlockTypeName()
    {
        return t('Google Calendar Embed');
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
