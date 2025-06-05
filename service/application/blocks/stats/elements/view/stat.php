<?php
defined('C5_EXECUTE') or die('Access Denied.');
use Concrete\Core\File\File;
use Concrete\Core\Page\Page;
use Application\Service\Picture;

assert(isset($item, $index));
?>
<div class="w-full flex-[0_0_auto] !px-[15px] max-w-full !mt-[30px]">
    <div class="card">
        <div class="card-body flex-[1_1_auto] p-1">
            <div class="flex flex-col items-center">
                <div class="mb-3">
                    <div class="icon btn btn-circle btn-lg !bg-[#467498] pointer-events-none !mx-auto lg:!mb-3 xl:!mb-0 xl:!text-[1.3rem] w-12 h-12 !text-[calc(1.255rem_+_0.06vw)] !inline-flex !items-center !justify-center !leading-none !p-0 !rounded-[100%]">
                        <i class="<?php echo $item['icon']; ?> !text-[#f7e837] text-[1.4rem]"></i>
                    </div>
                </div>
                <div>
                    <h2 class="!mb-1 text-[3rem]"><?php echo $item['stat']; ?></h2>
                    <h5 class="!mb-2"><?php echo $item['title']; ?></h5>
                    <p><?php echo $item['subtitle']; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>