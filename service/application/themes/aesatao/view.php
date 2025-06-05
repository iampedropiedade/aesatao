<?php
defined('C5_EXECUTE') or die('Access Denied.');
use Concrete\Core\Area\Area;
use Concrete\Core\Page\Page;
/** @var Page $c */
/** @var string $innerContent */

$this->inc('includes/doc_header.php');
$this->inc('includes/header.php');
$this->inc('widgets/title.php');
$a = new Area('Top');
$a->display($c);
?>
    <section class="wrapper">
        <div class="container py-14 xl:py-24 lg:py-20 md:py-18">
            <?php
            View::element(
                'system_errors',
                [
                    'format' => 'block',
                    'success' => $success ?? null,
                    'message' => $message ?? null,
                ]
            );
            echo $innerContent;
            ?>
        </div>
    </section>
<?php
$a = new Area('Bottom');
$a->display($c);

$this->inc('includes/footer.php');
$this->inc('includes/doc_footer.php');
