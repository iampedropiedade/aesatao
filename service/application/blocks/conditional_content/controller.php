<?php
namespace Application\Block\ConditionalContent;

use Concrete\Core\Block\BlockController;
use Concrete\Core\Editor\LinkAbstractor;
use Concrete\Core\User\User;
use Concrete\Core\Page\Page;

class Controller extends BlockController
{
    protected const string VIEWED_BY_LOGGED_IN_USERS = 'logged_in_users';
    protected const string VIEWED_BY_LOGGED_OUT_USERS = 'logged_out_users';
    public const array VIEWED_BY_OPTIONS = [
        self::VIEWED_BY_LOGGED_IN_USERS => 'Utilizadores autenticados',
        self::VIEWED_BY_LOGGED_OUT_USERS => 'Utilizadores não autenticados',
    ];

    protected $btTable = 'btConditionalContent';
    protected $btInterfaceWidth = '900';
    protected $btInterfaceHeight = '600';
    protected $btDefaultSet = 'application';

    /**
     * @return string
     */
    public function getBlockTypeDescription()
    {
        return t('Renders conditional content for logged in or logged out users');
    }

    /**
     * @return string
     */
    public function getBlockTypeName()
    {
        return t('Conditional Content');
    }

    public function add()
    {
        $this->edit();
    }

    public function edit()
    {
        $this->set('viewedByOptions', self::VIEWED_BY_OPTIONS);
    }

    public function getContentEditMode()
    {
        return LinkAbstractor::translateFromEditMode($this->get('content'));
    }

    public function view()
    {
        $user = new User();
        $page = Page::getCurrentPage();
        $visible = true;
        if($this->get('viewedBy') === self::VIEWED_BY_LOGGED_IN_USERS && !$user->getUserID()) {
            $visible = false;
        }
        elseif($this->get('viewedBy') === self::VIEWED_BY_LOGGED_OUT_USERS && $user->getUserID() && !$page->isEditMode()) {
            $visible = false;
        }
        if($visible) {
            $this->set('content', LinkAbstractor::translateFrom($this->get('content')));
        }
        $this->set('visible', $visible);
    }
}
