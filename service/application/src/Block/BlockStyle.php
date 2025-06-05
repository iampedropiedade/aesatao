<?php

namespace Application\Block;

use Concrete\Core\Page\Page;

class BlockStyle
{
    private const array PADDING_ALL = [
        'py-[4.5rem]',
        'xl:!py-20',
        'lg:!py-20',
        'md:!py-20',
    ];

    private const array PADDING_BOTTOM = [
        'pb-[4.5rem]',
        'xl:!pb-20',
        'lg:!pb-20',
        'md:!pb-20',
    ];

    public function getPaddingClass(int $blockId): string
    {
        $page = Page::getCurrentPage();
        $blocks = $page->getBlocks();
        if(count($blocks) === 1) {
            $marginTop = true;
        }
        else {
            $marginTop = false;
            foreach($blocks as $index=>$block) {
                if($blockId === $block->getBlockID() && $index === 0) {
                    $marginTop = true;
                    break;
                }
            }
        }
        return $marginTop ? implode(' ', self::PADDING_ALL) : implode(' ', self::PADDING_BOTTOM);
    }

}
