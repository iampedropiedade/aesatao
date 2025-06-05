<?php
namespace Application\Service;

class UiCacheBuster
{
    public static function getVersion(string $filename): int
    {
        try {
            return filemtime('/var/www/html' . $filename);
        } catch (\Exception $e) {
            return 0;
        }
    }
}
