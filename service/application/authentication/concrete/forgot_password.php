<?php
defined('C5_EXECUTE') or die('Access denied.');

?>
<form class="text-left !mb-3"  method="post" action="<?php echo URL::to('/login', 'callback', $authType->getAuthenticationTypeHandle(), 'forgot_password'); ?>">
    <?php $token->output(); ?>
    <h4><?php echo t('Forgot Your Password?') ?></h4>
    <div class="mb-4">
        <?php echo isset($intro_msg) ? $intro_msg : '' ?>
    </div>
    <div class="mb-4">
        <p><?php echo t('Enter your email address below. We will send you instructions to reset your password.'); ?></p>
    </div>
    <div class="form-floating !relative mb-4">
        <input
                name="uEmail"
                id="uEmail"
                type="email"
                placeholder="<?php echo t('Email Address') ?>"
                class="form-control px-4 py-[0.6rem] h-[calc(2.5rem_+_2px)] min-h-[calc(2.5rem_+_2px)] leading-[1.25] block w-full text-[12px] font-medium text-[#60697b] appearance-none bg-[#fefefe] bg-clip-padding border shadow-[0_0_1.25rem_rgba(30,34,40,0.04)] rounded-[0.4rem] border-solid border-[rgba(8,60,130,0.07)] motion-reduce:transition-none focus:text-[#60697b] focus:bg-[#fefefe] focus:shadow-[0_0_1.25rem_rgba(30,34,40,0.04),unset] focus:border-[#9fbcf0] disabled:bg-[#aab0bc] disabled:opacity-100 file:mt-[-0.6rem] file:mr-[-1rem] file:mb-[-0.6rem] file:ml-[-1rem] file:text-[#60697b] file:bg-[#fefefe] file:pointer-events-none file:transition-all file:duration-[0.2s] file:ease-in-out file:px-4 file:py-[0.6rem] file:rounded-none file:border-inherit file:border-solid file:border-0 motion-reduce:file:transition-none focus:!border-[rgba(63,120,224,0.5)] focus-visible:!border-[rgba(63,120,224,0.5)] focus-visible:!outline-0"
                required />
        <label
                class=" text-[#959ca9] text-[.75rem] absolute z-[2] h-full overflow-hidden text-start text-ellipsis whitespace-nowrap pointer-events-none border origin-[0_0] px-4 py-[0.6rem] border-solid border-transparent left-0 top-0 inline-block"
                for="uName">
            <?php echo t('Email Address') ?>
        </label>
    </div>
    <div class="form-floating !relative mb-4">
        <button
                name="resetPassword"
                class="w-full lg:w-1/2 btn btn-primary text-white !bg-aesatao border-aesatao hover:text-white hover:bg-aesatao hover:border-aesatao focus:shadow-[rgba(92,140,229,1)] active:text-white active:bg-aesatao active:border-aesatao disabled:text-white disabled:bg-aesatao disabled:border-aesatao !rounded-[50rem] btn-login mb-2">
            <span class="button__text">
                <?php echo t('Recuperar password'); ?>
            </span>
        </button>
    </div>
    <div class="form-floating !relative mb-4">
        <p><a href="<?php echo URL::to('/login'); ?>" class="link"><?php echo t('Voltar à página de login'); ?></a></p>
    </div>
</form>
