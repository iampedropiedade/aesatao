<?php
defined('C5_EXECUTE') or die('Access denied.');
use Concrete\Core\User\User;
use Concrete\Core\Support\Facade\Url;

assert(isset($user) && $user instanceof User);
?>
<?php if (isset($error)) : ?>
    <p class="text-red-400 mb-8">
        <?php echo ($error); ?>
    </p>
<?php endif; ?>
<?php if (!$user->isRegistered()) : ?>
    <h5 class="mb-8">Autentique-se com a sua conta institucional Google</h5>
    <a
            href="<?php echo URL::to('/ccm/system/authentication/oauth2/google/attempt_auth'); ?>"
            class="flex w-full lg:w-1/2 btn btn-primary text-white !bg-aesatao border-aesatao hover:text-white hover:bg-aesatao hover:border-aesatao focus:shadow-[rgba(92,140,229,1)] active:text-white active:bg-aesatao active:border-aesatao disabled:text-white disabled:bg-aesatao disabled:border-aesatao !rounded-[50rem] mb-2">
        <i class="fa-brands fa-google mr-2"></i>
        <span class="grow">Autenticar</span>
    </a>
<?php endif; ?>