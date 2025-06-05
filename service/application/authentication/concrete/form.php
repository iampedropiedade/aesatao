<?php
defined('C5_EXECUTE') or die('Access denied.');

$form = Core::make('helper/form');
$session = Core::make('session');
?>
<h5 class="mb-8">
    <?php echo t('Autentique-se com email e palavra passe'); ?>
</h5>
<form class="text-left !mb-3" method="post" action="<?php echo URL::to('/login', 'authenticate', $this->getAuthenticationTypeHandle()) ?>" >
    <?php Core::make('helper/validation/token')->output('login_' . $this->getAuthenticationTypeHandle()); ?>
    <div class="form-floating !relative mb-4">
        <input type="email"
               name="uName"
               class="form-control px-4 py-[0.6rem] h-[calc(2.5rem_+_2px)] min-h-[calc(2.5rem_+_2px)] leading-[1.25] block w-full text-[12px] font-medium text-[#60697b] appearance-none bg-[#fefefe] bg-clip-padding border shadow-[0_0_1.25rem_rgba(30,34,40,0.04)] rounded-[0.4rem] border-solid border-[rgba(8,60,130,0.07)] motion-reduce:transition-none focus:text-[#60697b] focus:bg-[#fefefe] focus:shadow-[0_0_1.25rem_rgba(30,34,40,0.04),unset] focus:border-[#9fbcf0] disabled:bg-[#aab0bc] disabled:opacity-100 file:mt-[-0.6rem] file:mr-[-1rem] file:mb-[-0.6rem] file:ml-[-1rem] file:text-[#60697b] file:bg-[#fefefe] file:pointer-events-none file:transition-all file:duration-[0.2s] file:ease-in-out file:px-4 file:py-[0.6rem] file:rounded-none file:border-inherit file:border-solid file:border-0 motion-reduce:file:transition-none focus:!border-[rgba(63,120,224,0.5)] focus-visible:!border-[rgba(63,120,224,0.5)] focus-visible:!outline-0"
               placeholder="<?php echo Config::get('concrete.user.registration.email_registration') ? t('Email') : t('Nome de utilizador'); ?>"
               id="uName">
        <label
                class=" text-[#959ca9] text-[.75rem] absolute z-[2] h-full overflow-hidden text-start text-ellipsis whitespace-nowrap pointer-events-none origin-[0_0] px-4 py-[0.6rem] left-0 top-0 inline-block"
                for="uName">
            <?php echo Config::get('concrete.user.registration.email_registration') ? t('Email') : t('Nome de utilizador'); ?>
        </label>
    </div>
    <div class="form-floating !relative password-field mb-4">
        <input
                type="password"
                name="uPassword"
                class="form-control px-4 py-[0.6rem] h-[calc(2.5rem_+_2px)] min-h-[calc(2.5rem_+_2px)] leading-[1.25] block w-full text-[12px] font-medium text-[#60697b] appearance-none bg-[#fefefe] bg-clip-padding border shadow-[0_0_1.25rem_rgba(30,34,40,0.04)] rounded-[0.4rem] border-solid border-[rgba(8,60,130,0.07)] motion-reduce:transition-none focus:text-[#60697b] focus:bg-[#fefefe] focus:shadow-[0_0_1.25rem_rgba(30,34,40,0.04),unset] focus:border-[#9fbcf0] disabled:bg-[#aab0bc] disabled:opacity-100 file:mt-[-0.6rem] file:mr-[-1rem] file:mb-[-0.6rem] file:ml-[-1rem] file:text-[#60697b] file:bg-[#fefefe] file:pointer-events-none file:transition-all file:duration-[0.2s] file:ease-in-out file:px-4 file:py-[0.6rem] file:rounded-none file:border-inherit file:border-solid file:border-0 motion-reduce:file:transition-none focus:!border-[rgba(63,120,224,0.5)] focus-visible:!border-[rgba(63,120,224,0.5)] focus-visible:!outline-0"
                placeholder="<?php echo t('Password')?>"
                id="uPassword">
        <label
                class="text-[#959ca9] text-[.75rem] absolute z-[2] h-full overflow-hidden text-start text-ellipsis whitespace-nowrap pointer-events-none origin-[0_0] px-4 py-[0.6rem] left-0 top-0 inline-block"
                for="uPassword">
            <?php echo t('Password')?>
        </label>
    </div>
    <div class="form-check form-floating mb-4">
        <input id="uMaintainLogin" type="checkbox" name="uMaintainLogin" class="form-check-input">
        <label class="form-check-label" for="uMaintainLogin"><?php echo t('Manter-me autenticado'); ?></label>
    </div>
    <div class="form-floating !relative password-field mb-4">
        <input
            type="submit"
            value="<?php echo t('Login'); ?>"
            class="w-full lg:w-1/2 btn btn-primary text-white !bg-aesatao border-aesatao hover:text-white hover:bg-aesatao hover:border-aesatao focus:shadow-[rgba(92,140,229,1)] active:text-white active:bg-aesatao active:border-aesatao disabled:text-white disabled:bg-aesatao disabled:border-aesatao !rounded-[50rem] btn-login mb-2">
    </div>
    <div class="form-floating !relative password-field mb-4 mt-8">
        <a href="<?php echo URL::to('/login', 'concrete', 'forgot_password'); ?>" class="link"><?php echo t('Recuperar password'); ?></a>
    </div>
</form>