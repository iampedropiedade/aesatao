<?php

declare(strict_types=1);

namespace Application\Navigation;

use Concrete\Core\Cache\Level\ExpensiveCache;

abstract class AbstractNavigation
{
    protected ExpensiveCache $cache;
    protected const TTL = 600;

    public function __construct()
    {
        $this->cache = new ExpensiveCache();
    }

    /**
     * @param array<string> $elements
     * @return string
     */
    protected function generateCacheKey(array $elements): string
    {
        return implode('/', $elements);
    }
}
