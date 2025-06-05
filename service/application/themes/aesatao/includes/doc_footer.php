<?php
defined('C5_EXECUTE') or die("Access Denied.");
use Application\Service\UiCacheBuster;
use Concrete\Core\View\View;
use Application\Service\InterfaceAssets;
$toolbar = InterfaceAssets::canViewToolbar();
?>
<div class="progress-wrap blue fixed w-[2.3rem] h-[2.3rem] cursor-pointer block shadow-[inset_0_0_0_0.1rem_rgba(128,130,134,0.25)] z-[1010] opacity-0 invisible translate-y-3 transition-all duration-[0.2s] ease-[linear,margin-right] delay-[0s] rounded-[100%] right-6 bottom-6 motion-reduce:transition-none after:absolute after:content-['\f062'] after:text-center after:leading-[2.3rem] after:text-[1.2rem] after:text-aesatao after:h-[2.3rem] after:w-[2.3rem] after:cursor-pointer after:block after:z-[1] after:transition-all after:duration-[0.2s] after:ease-linear after:left-0 after:top-0 motion-reduce:after:transition-none" style="font-family: 'Font Awesome 6 Free'; font-weight: 900;">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path class="fill-none stroke-aesatao stroke-[4] box-border transition-all duration-[0.2s] ease-linear motion-reduce:transition-none" d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
</div>

</div>

<?php View::element('footer_required'); ?>
<?php if ($toolbar) : ?>
    <script src="<?php echo $this->getThemePath() ?>/app/js/plugins/bootstrap.js?v=<?php echo UiCacheBuster::getVersion($this->getThemePath() . '/app/js/plugins/bootstrap.js'); ?>"></script>
<?php endif; ?>
<script src="<?php echo $this->getThemePath() ?>/app/js/plugins/plugins.js?v=<?php echo UiCacheBuster::getVersion($this->getThemePath() . '/app/js/plugins/plugins.js'); ?>"></script>
<script src="<?php echo $this->getThemePath() ?>/app/js/main.js?v=<?php echo UiCacheBuster::getVersion($this->getThemePath() . '/app/js/plugins/main.js'); ?>""></script>
</body>
</html>