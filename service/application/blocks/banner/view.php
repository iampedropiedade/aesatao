<?php
defined('C5_EXECUTE') or die('Access Denied.');
/** @var Application\Block\Hero\Controller $controller */

$page = $this->controller->get('page');

?>
<section class="wrapper">
    <div class="container pt-28">
        <div class="card !bg-[#ecf4fa] !rounded-[0.8rem] !mt-2 !mb-[4rem] xl:!mb-[7rem] lg:!mb-[7rem] md:!mb-[7rem]">
            <div class="card-body xl:!p-[2.5rem] lg:!p-[2.5rem] md:!p-[2.5rem] xl:!py-12 xl:!px-20 p-[40px]">
                <div class="flex flex-wrap mx-[-15px] xl:mx-0 lg:mx-[-20px] !mt-[-50px] items-center">
                    <div class="xl:w-6/12 lg:w-6/12 w-full flex-[0_0_auto] !px-[15px] xl:px-0 lg:!px-[20px] !mt-[50px] max-w-full xl:!order-2 lg:!order-2 flex !relative">
                        <img class="max-w-full h-auto !ml-auto !mx-auto xl:!mr-8 lg:!mr-8"
                             src="<?php echo $this->controller->get('image'); ?>"
                             alt="image"
                             data-cue="fadeIn"
                             data-show="true"
                             style="animation-name: fadeIn; animation-duration: 700ms; animation-timing-function: ease; animation-delay: 0ms; animation-direction: normal; animation-fill-mode: both;">
                        <div data-cue="slideInRight"
                             data-delay="300"
                             data-show="true"
                             style="animation-name: slideInRight; animation-duration: 700ms; animation-timing-function: ease; animation-delay: 600ms; animation-direction: normal; animation-fill-mode: both;">
                            <?php if($this->controller->get('statTitle') && $this->controller->get('statDescription')): ?>
                                <div class="card !shadow-[0_0.25rem_1.75rem_rgba(30,34,40,0.07)] !absolute" style="bottom: 10%; right: -3%;">
                                    <div class="card-body py-4 px-5">
                                        <div class="flex flex-row items-center">
                                            <div>
                                                <div class="icon btn btn-circle btn-md btn-soft-aqua pointer-events-none !mx-auto !mr-[.75rem] !w-[2.2rem] !h-[2.2rem] !inline-flex !items-center !justify-center !text-[1rem] !leading-none !p-0 !rounded-[100%]">
                                                    <i class="<?php echo $this->controller->get('statIcon'); ?>"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <h3 class="!mb-0 whitespace-nowrap" style="visibility: visible;">
                                                    <?php echo $this->controller->get('statTitle'); ?>
                                                </h3>
                                                <p class="!text-[0.7rem] leading-normal  !mb-0 whitespace-nowrap">
                                                    <?php echo $this->controller->get('statDescription'); ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="xl:w-6/12 lg:w-6/12 flex-[0_0_auto] !px-[15px] xl:px-0 lg:!px-[20px] !mt-[50px] max-w-full text-center lg:text-left xl:text-left"
                         data-cues="slideInDown"
                         data-group="page-title"
                         data-delay="600"
                         data-disabled="true">
                        <h1 class="xl:!text-[2.4rem] !text-[calc(1.365rem_+_1.38vw)] !leading-[1.15] !font-DMSerif !font-normal !tracking-normal !mb-5 [word-spacing:normal!important]"
                            data-cue="slideInDown"
                            data-group="page-title"
                            data-delay="600"
                            data-show="true"
                            style="animation-name: slideInDown; animation-duration: 700ms; animation-timing-function: ease; animation-delay: 600ms; animation-direction: normal; animation-fill-mode: both;">
                            <?php echo $controller->get('title'); ?>
                        </h1>
                        <div class="lead !mb-7 xl:!pr-10"
                           data-cue="slideInDown"
                           data-group="page-title"
                           data-delay="600"
                           data-show="true"
                           style="animation-name: slideInDown; animation-duration: 700ms; animation-timing-function: ease; animation-delay: 900ms; animation-direction: normal; animation-fill-mode: both;"
                        >
                            <?php echo $controller->get('description'); ?>
                        </div>
                        <div class="flex justify-center lg:!justify-start xl:!justify-start"
                             data-cues="slideInDown"
                             data-group="page-title-buttons"
                             data-delay="900"
                             data-cue="slideInDown"
                             data-disabled="true"
                             data-show="true"
                             style="animation-name: slideInDown; animation-duration: 700ms; animation-timing-function: ease; animation-delay: 900ms; animation-direction: normal; animation-fill-mode: both;">
                            <?php if($this->controller->get('buttonCaption') && $this->controller->get('buttonLinkUrl')): ?>
                                <span data-cue="slideInDown"
                                      data-group="page-title-buttons"
                                      data-delay="900"
                                      data-show="true"
                                      style="animation-name: slideInDown; animation-duration: 700ms; animation-timing-function: ease; animation-delay: 1200ms; animation-direction: normal; animation-fill-mode: both;">
                                    <a href="<?php echo $controller->get('buttonLinkUrl'); ?>"
                                       class="me-2 btn btn-primary text-white !bg-royalBlue border-royalBlue hover:text-white hover:bg-royalBlue hover:border-royalBlue focus:shadow-[rgba(92,140,229,1)] active:text-white active:bg-royalBlue active:border-royalBlue disabled:text-white disabled:bg-royalBlue disabled:border-royalBlue !rounded-[50rem] hover:translate-y-[-0.15rem] hover:shadow-[0_0.25rem_0.75rem_rgba(30,34,40,0.15)]">
                                        <?php echo $controller->get('buttonCaption'); ?>
                                    </a>
                                </span>
                            <?php endif; ?>
                            <?php if($this->controller->get('button2Caption') && $this->controller->get('button2LinkUrl')): ?>
                                <span data-cue="slideInDown"
                                      data-group="page-title-buttons"
                                      data-delay="900" data-show="true"
                                      style="animation-name: slideInDown; animation-duration: 700ms; animation-timing-function: ease; animation-delay: 1500ms; animation-direction: normal; animation-fill-mode: both;">
                                    <a href="<?php echo $controller->get('button2LinkUrl'); ?>"
                                       class="btn btn-outline-primary !rounded-[50rem]">
                                        <?php echo $controller->get('button2Caption'); ?>
                                    </a>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>