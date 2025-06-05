<?php
defined('C5_EXECUTE') or die('Access Denied.');
use Concrete\Core\Area\Area;
use Concrete\Core\Page\Page;
/** @var Page $c */
/** @var string $innerContent */

$this->inc('includes/doc_header.php');
$this->inc('includes/header.php');

$a = new Area('Main');
$a->display($c);

$this->inc('includes/footer.php');
$this->inc('includes/doc_footer.php');
