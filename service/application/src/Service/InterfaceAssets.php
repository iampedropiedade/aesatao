<?php
namespace Application\Service;

use Concrete\Core\Permission\Checker;
use Concrete\Core\Page\Page;


class InterfaceAssets
{
    private static ?bool $canViewToolbar = null;

    public static function canViewToolbar(): bool
    {
        if(self::$canViewToolbar === null) {
            $page = Page::getCurrentPage();
            self::$canViewToolbar = (new Checker($page))->canViewToolbar();
        }
        return self::$canViewToolbar;
    }
}
