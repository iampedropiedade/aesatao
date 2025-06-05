<?php
namespace Application\Controller;

use Application\Constants\Attributes;
use Concrete\Core\Page\Controller\PageController;

abstract class AbstractPageController extends PageController
{

    public function on_start()
    {
        parent::on_start();
        $mainImage = $this->c->getAttribute(Attributes::MAIN_IMAGE);
        $this->set('navbarStyle', $mainImage ? 'navbar-dark' : 'navbar-light');
    }

}
