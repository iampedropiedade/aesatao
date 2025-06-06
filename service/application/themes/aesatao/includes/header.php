<?php
defined('C5_EXECUTE') or die("Access Denied.");
use Application\Navigation\Navigation;
use Concrete\Core\Page\Page;
use Application\Constants\Attributes;

assert(isset($c));
$navigation = new Navigation();
$navigationPages = $navigation->getNavigation();
$site = $c->getSite() ?? Page::getByID(1)->getSite();
$phone = $site->getAttribute(Attributes::WEBSITE_PHONE);
$email = $site->getAttribute(Attributes::WEBSITE_EMAIL);
$address = $site->getAttribute(Attributes::WEBSITE_ADDRESS);
if((string)$c->getAttribute(Attributes::NAVBAR_STYLE)) {
    $navbarStyle = ((string)$c->getAttribute(Attributes::NAVBAR_STYLE) === 'navbar-dark' ? 'navbar-dark' : 'navbar-light');
}
$navbarStyle = $navbarStyle ?? 'navbar-light';
$logoLight = $navbarStyle === 'navbar-light' ? 'logo-aesatao-dark.png' : 'logo-aesatao-light.png';
?>
<header class="relative wrapper !bg-[#ffffff]">
    <nav class="navbar navbar-expand-lg classic transparent !absolute !bg-opacity-5 <?php echo $navbarStyle; ?>">
        <div class="container xl:!flex-row lg:!flex-row !flex-nowrap items-center">
            <div class="navbar-brand w-full">
                <a href="/">
                    <img class="logo-dark h-12" src="<?php echo $this->getThemePath(); ?>/app/img/logo-aesatao-dark.png" alt="logo">
                    <img class="logo-light h-12" src="<?php echo $this->getThemePath(); ?>/app/img/<?php echo $logoLight; ?>" alt="logo">
                </a>
            </div>
            <div class="navbar-collapse offcanvas offcanvas-nav offcanvas-start">
                <div class="offcanvas-header xl:!hidden lg:!hidden flex items-center justify-between flex-row p-6">
                    <h3 class="!text-white xl:!text-[1.5rem] !text-[calc(1rem_+_0.3vw)] !mb-0">Agrupamento de Escolas de Sátão</h3>
                    <button type="button" class="!w-8 !h-8 rounded-full bg-gray-700 px-3 ml-2" data-bs-dismiss="offcanvas" aria-label="Close">
                        <i class="fa-solid fa-xmark text-white text-[0.7rem]"></i>
                    </button>
                </div>
                <div class="offcanvas-body xl:!ml-auto lg:!ml-auto flex flex-col !h-full">
                    <ul class="navbar-nav">
                        <?php foreach ($navigationPages as $page) : ?>
                            <?php
                            $children = $navigation->getNavigation($page);
                            $hasChildren = count($children) > 0;
                            ?>
                            <li class="nav-item <?php if($hasChildren) : ?>dropdown<?php endif; ?>">
                                <a class="nav-link !flex items-center font-bold <?php if($hasChildren) : ?>dropdown-toggle<?php endif; ?>"
                                   href="<?php echo $page->getCollectionPath(); ?>"
                                   <?php if($hasChildren) : ?>
                                       data-bs-toggle="dropdown"
                                   <?php endif; ?>
                                >
                                    <div class="grow">
                                        <?php echo $page->getCollectionName(); ?>
                                    </div>
                                    <?php if($hasChildren) : ?>
                                        <i class="fa-solid fa-chevron-down text-[0.5rem] ml-1"></i>
                                    <?php endif; ?>
                                </a>
                                <?php if($hasChildren) : ?>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item mb-1 b">
                                            <a class="dropdown-item hover:!text-aesatao !font-bold" href="<?php echo $page->getCollectionPath(); ?>">Explorar: <?php echo $page->getCollectionName(); ?></a>
                                        </li>
                                        <?php foreach ($children as $child) : ?>
                                            <li class="nav-item">
                                                <a class="dropdown-item hover:!text-aesatao !font-medium" href="<?php echo $child->getCollectionPath(); ?>"><?php echo $child->getCollectionName(); ?></a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="offcanvas-footer xl:!hidden lg:!hidden">
                        <div>
                            <div><a class="link-inverse" href="mailto:direcao@agrupaesatao.com">direcao@agrupaesatao.com</a></div>
                            <div><a class="link-inverse" href="tel:+351 234 841 704">+351 234 841 704/5</a></div>
                            <nav class="nav social social-white mt-4">
                                <a class="text-[#cacaca] text-[1rem] transition-all duration-[0.2s] ease-in-out translate-y-0 motion-reduce:transition-none hover:translate-y-[-0.15rem] m-[0_.7rem_0_0]" href="#">
                                    <i class="fa-brands fa-facebook text-[1rem] !text-white"></i>
                                </a>
                                <a class="text-[#cacaca] text-[1rem] transition-all duration-[0.2s] ease-in-out translate-y-0 motion-reduce:transition-none hover:translate-y-[-0.15rem] m-[0_.7rem_0_0]" href="#">
                                    <i class="fa-brands fa-instagram text-[1rem] !text-white"></i>
                                </a>
                                <a class="text-[#cacaca] text-[1rem] transition-all duration-[0.2s] ease-in-out translate-y-0 motion-reduce:transition-none hover:translate-y-[-0.15rem] m-[0_.7rem_0_0]" href="#">
                                    <i class="fa-brands fa-youtube text-[1rem] !text-white"></i>
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="navbar-other lg:!ml-4 xl:!ml-4">
                <ul class="navbar-nav !flex-row !items-center !ml-auto">
                    <li class="nav-item dropdown">
                        <span
                           class="!text-[0.55rem] md:!text-[0.6rem] lg:!text-[0.7rem] btn btn-sm btn-aqua !text-white !border-0 !bg-opacity-70 !bg-aesatao-600 !border-aesatao-600 hover:text-white hover:bg-aesatao-600 hover:!border-aesatao-600 active:text-white active:bg-aesatao-600 active:border-aesatao-600 disabled:text-white disabled:bg-aesatao-600 disabled:border-aesatao-600 !rounded-[50rem]"
                           data-bs-toggle="dropdown"
                           aria-expanded="false"
                        >
                           Links
                            <i class="fa-solid fa-chevron-down text-[0.5rem] ml-1"></i>
                        </span>
                        <ul class="dropdown-menu dropdown-menu-right !mt-4 !absolute !ml-[-100%]">
                            <li class="nav-item mb-1 b">
                                <a class="dropdown-item hover:!text-aesatao-600 !font-medium" href="https://programas.escolasdesatao.pt/inovarsase/Inicial.wgx" target="_blank">
                                    Inovar SASE
                                    <sup><i class="fa-solid fa-arrow-up-right-from-square text-[0.45rem] ml-1"></i></sup>
                                </a>
                            </li>
                            <li class="nav-item mb-1 b">
                                <a class="dropdown-item hover:!text-aesatao-600 !font-medium" href="https://programas.escolasdesatao.pt/inovarconsulta/app/index.html#/login" target="_blank">
                                    Inovar Consulta
                                    <sup><i class="fa-solid fa-arrow-up-right-from-square text-[0.45rem] ml-1"></i></sup>
                                </a>
                            </li>
                            <li class="nav-item mb-1 b">
                                <a class="dropdown-item hover:!text-aesatao-600 !font-medium" href="https://programas.escolasdesatao.pt/PortalUnicard" target="_blank">
                                    Portal SIGE
                                    <sup><i class="fa-solid fa-arrow-up-right-from-square text-[0.45rem] ml-1"></i></sup>
                                </a>
                            </li>
                            <li class="nav-item mb-1 b">
                                <a class="dropdown-item hover:!text-aesatao-600 !font-medium" href="https://siga.edubox.pt/" target="_blank">
                                    SIGA
                                    <sup><i class="fa-solid fa-arrow-up-right-from-square text-[0.45rem] ml-1"></i></sup>
                                </a>
                            </li>
                            <li class="nav-item mb-1 b">
                                <a class="dropdown-item hover:!text-aesatao-600 !font-medium" href="http://mail.google.com/a/escolasdesatao.pt" target="_blank">
                                    Email institucional
                                    <sup><i class="fa-solid fa-arrow-up-right-from-square text-[0.45rem] ml-1"></i></sup>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="!w-[42px] !h-[42px] !p-[0.4rem_0.3rem] btn btn-sm btn-aqua !text-white !border-0 !bg-opacity-70 !bg-aesatao-600 !border-aesatao-600 hover:text-white hover:bg-aesatao-600 hover:!border-aesatao-600 active:text-white active:bg-aesatao-600 active:border-aesatao-600 disabled:text-white disabled:bg-aesatao-600 disabled:border-aesatao-600 !rounded-full"
                           data-bs-toggle="offcanvas"
                           data-bs-target="#offcanvas-search">
                            <i class="fa-solid fa-magnifying-glass m-1 !text-[0.6rem] md:!text-[0.65rem] lg:!text-[0.8rem]"></i>
                        </a>
                    </li>
                    <li class="nav-item xl:!hidden lg:!hidden">
                        <button class="hamburger offcanvas-nav-btn"><span></span></button>
                    </li>
                </ul>
            </div>
        </div> 
    </nav>
    <div class="offcanvas offcanvas-top !bg-[#ffffff] " id="offcanvas-search" data-bs-scroll="true">
        <div class="container flex flex-row py-6">
            <form class="search-form relative before:block w-full focus:!outline-offset-0 focus:outline-0" method="get" action="/pesquisa" id="search-form">
                <input type="text"
                       name="query"
                       class="form-control text-[0.8rem] !shadow-none pl-[1.75rem] !pr-[.75rem] border-0 bg-inherit m-0 block w-full font-medium leading-[1.7] text-[#60697b] px-4 py-[0.6rem] rounded-[0.4rem] focus:!outline-offset-0 focus:outline-0"
                       placeholder="Digite os termos de pesquisa e pressione a tecla Enter" />
            </form>
            <button type="button" class="leading-none text-[#343f52] transition-all duration-[0.2s] ease-in-out p-0 border-0 motion-reduce:transition-none hover:no-underline bg-inherit focus:outline-0" data-bs-dismiss="offcanvas" aria-label="Close">
                <i class="fa-solid fa-xmark !text-[1.1rem] pl-4"></i>
            </button>
        </div>
    </div>
</header>
<main class="grow <?php echo $c->isEditMode() ? 'mt-[80px]' : ''; ?>" <?php if(!$c->isEditMode()) : ?>id="website-app"<?php endif; ?>>
