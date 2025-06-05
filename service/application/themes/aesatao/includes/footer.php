<?php
defined('C5_EXECUTE') or die("Access Denied.");
use Concrete\Core\Page\Page;
assert(isset($c));
/** @var Page $c */
?>
<?php $this->inc('widgets/ai_agent_modal.php'); ?>
</main>
<footer class=" bg-aesataoAlt-900 opacity-100  !text-[#cacaca]">
    <div class="container pt-18 xl:pt-24 lg:pt-24 md:pt-24 pb-8 xl:pb-10 lg:pb-10 md:pb-10">
        <div class="flex flex-wrap mx-[-15px] !mt-[-30px] xl:!mt-0 lg:!mt-0">
            <div class="md:w-4/12 w-full flex-[0_0_auto] !px-[15px] max-w-full xl:!mt-0 lg:!mt-0 !mt-[30px]">
                <div class="widget !text-[#cacaca]">
                    <img class="!mb-4 h-12" src="<?php echo $this->getThemePath(); ?>/app/img/logo-aesatao-light.png" alt="image">
                    <nav class="nav social social-white">
                        <a class="!text-[#cacaca] text-[1rem] transition-all duration-[0.2s] ease-in-out translate-y-0 motion-reduce:transition-none hover:translate-y-[-0.15rem] m-[0_.7rem_0_0]"
                           href="https://www.facebook.com/aesatao">
                            <i class="fa-brands fa-facebook !text-white text-[1rem]"></i>
                        </a>
                        <a class="!text-[#cacaca] text-[1rem] transition-all duration-[0.2s] ease-in-out translate-y-0 motion-reduce:transition-none hover:translate-y-[-0.15rem] m-[0_.7rem_0_0]"
                           href="https://www.instagram.com/aesatao/?igshid=ZDdkNTZiNTM%3D#">
                            <i class="fa-brands fa-instagram !text-white text-[1rem]"></i>
                        </a>
                    </nav>
                </div>
            </div>
            <div class="md:w-4/12 w-full flex-[0_0_auto] !px-[15px] max-w-full xl:!mt-0 lg:!mt-0 !mt-[30px]">
                <div class="widget !text-[#cacaca]">
                    <h4 class="widget-title !text-white !mb-3 !text-[1rem] !leading-[1.45]">Links úteis</h4>
                    <ul class="pl-0 list-none   !mb-0">
                        <li>
                            <a class="!text-[#cacaca] hover:!text-aesatao" href="/informacao-legal/rgpd-e-politica-de-privacidade">RGPD e política de privacidade</a>
                        </li>
                        <li class="!mt-[0.35rem]">
                            <a class="!text-[#cacaca] hover:!text-aesatao" href="/informacao-legal/regime-geral-de-prevencao-da-corrupcao">Regime geral de prevenção da corrupção</a>
                        </li>
                        <li class="!mt-[0.35rem]">
                            <a class="!text-[#cacaca] hover:!text-aesatao" href="/sitemap">Mapa do site</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="md:w-4/12 w-full flex-[0_0_auto] !px-[15px] max-w-full xl:!mt-0 lg:!mt-0 !mt-[30px]">
                <div class="widget !text-[#cacaca]">
                    <h4 class="widget-title !text-white !mb-3 !text-[1rem] !leading-[1.45]">Contactos</h4>
                    <address class="xl:!pr-20 xxl:!pr-28 not-italic !leading-[inherit] block !mb-4">
                        R. Luís de Camões 29,
                        <br>
                        3560-184 Sátão
                    </address>
                    <a class="!text-[#cacaca] hover:!text-aesatao" href="mailto:geral@escolasdesatao.pt">geral@escolasdesatao.pt</a>
                    <br>
                    <a class="!text-[#cacaca] hover:!text-aesatao" href="tel:+351232980100">(+351) 232 980 100</a>
                </div>
            </div>
        </div>
        <div class="mt-8 text-center text-[0.6rem]">
            © <?php echo (new \DateTime())->format('Y'); ?> Agrupamento de Escolas de Sátão.
        </div>
    </div>
</footer>
