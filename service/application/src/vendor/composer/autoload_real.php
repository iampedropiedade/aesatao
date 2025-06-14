<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInite71c6a1e9408de4b0d5900054cf350cb
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInite71c6a1e9408de4b0d5900054cf350cb', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInite71c6a1e9408de4b0d5900054cf350cb', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInite71c6a1e9408de4b0d5900054cf350cb::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
