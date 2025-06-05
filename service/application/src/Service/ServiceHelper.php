<?php

declare(strict_types=1);

namespace Application\Service;

use Application\Services\RedirectService;
use Concrete\Core\Application\Application;
use Concrete\Core\Application\Service\FileManager;
use Concrete\Core\Application\Service\UserInterface;
use Concrete\Core\Config\Repository\Repository;
use Concrete\Core\Database\Connection\Connection;
use Concrete\Core\Database\DatabaseManager;
use Concrete\Core\Editor\CkeditorEditor;
use Concrete\Core\Entity\Site\Site;
use Concrete\Core\File\Image\BasicThumbnailer;
use Concrete\Core\File\Service\Application as FileServiceApplication;
use Concrete\Core\Form\Service\Widget\Color;
use Concrete\Core\Form\Service\Widget\DateTime;
use Concrete\Core\Form\Service\Widget\PageSelector;
use Concrete\Core\Html\Service\Html;
use Concrete\Core\Http\Service\Ajax;
use Concrete\Core\Legacy\Loader;
use Concrete\Core\Mail\Service as MailService;
use Concrete\Core\User\UserInfoRepository;
use Concrete\Core\Utility\Service\Identifier;
use Concrete\Core\Utility\Service\Text;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use Symfony\Component\HttpFoundation\Session\Session;
use Concrete\Core\Site\Service;

class ServiceHelper
{
    /**
     * @return Application
     */
    public static function app(): Application
    {
        return \Concrete\Core\Support\Facade\Application::getFacadeApplication();
    }

    /**
     * @return Site|null
     * @throws BindingResolutionException
     */
    public static function site(): ?Site
    {
        $service = self::app()->make('site');
        if ($service instanceof Service) {
            return $service->getSite();
        }
        return null;
    }

    /**
     * @return FlashBag
     * @throws BindingResolutionException
     */
    public static function flashBag(): FlashBag
    {
        return self::app()->make('session')->getFlashBag();
    }

    /**
     * @return Session
     * @throws BindingResolutionException
     */
    public static function session(): Session
    {
        return self::app()->make('session');
    }

    /**
     * @return EntityManager
     * @throws BindingResolutionException
     */
    public static function entityManager(): EntityManager
    {
        return self::app()->make(EntityManagerInterface::class);
    }

    /**
     * @return FileManager
     * @throws BindingResolutionException
     */
    public static function fileManager(): FileManager
    {
        return self::app()->make('helper/concrete/file_manager');
    }

    /**
     * @return FileServiceApplication
     * @throws BindingResolutionException
     */
    public static function file(): FileServiceApplication
    {
        return self::app()->make('helper/concrete/file');
    }

    /**
     * @return DateTime
     * @throws BindingResolutionException
     */
    public static function date(): DateTime
    {
        return self::app()->make('helper/form/date_time');
    }

    /**
     * @return Repository
     * @throws BindingResolutionException
     */
    public static function config(): Repository
    {
        return self::app()->make('config');
    }

    /**
     * @return DatabaseManager
     * @throws BindingResolutionException
     */
    public static function database(): DatabaseManager
    {
        return self::app()->make('database');
    }

    /**
     * @return Connection
     * @throws BindingResolutionException
     */
    public static function connection(): Connection
    {
        return self::app()->make('database')->connection();
    }

    /**
     * @return CkeditorEditor
     * @throws BindingResolutionException
     */
    public static function editor(): CkeditorEditor
    {
        return self::app()->make('editor');
    }

    /**
     * @return UserInterface
     */
    public static function userInterface(): UserInterface
    {
        return Loader::helper('concrete/ui');
    }

    /**
     * @return PageSelector
     */
    public static function page(): PageSelector
    {
        return Loader::helper('form/page_selector');
    }

    /**
     * @return Html
     * @throws BindingResolutionException
     */
    public static function htmlHelper(): Html
    {
        return self::app()->make('helper/html');
    }

    /**
     * @return MailService
     * @throws BindingResolutionException
     */
    public static function mail(): MailService
    {
        return self::app()->make('mail');
    }

    /**
     * @return Ajax
     * @throws BindingResolutionException
     */
    public static function ajax(): Ajax
    {
        return static::app()->make(Ajax::class);
    }

    /**
     * @return Color
     * @throws BindingResolutionException
     */
    public static function colourPicker(): Color
    {
        return self::app()->make('helper/form/color');
    }

    /**
     * @return Text
     * @throws BindingResolutionException
     */
    public static function text(): Text
    {
        return self::app()->make('helper/text');
    }

    /**
     * @param string $url
     * @param Cookie|null $cookie
     * @throws BindingResolutionException
     */
    public static function redirect(string $url = '/', Cookie $cookie = null): void
    {
        self::app()->make(RedirectService::class)->redirect($url, $cookie);
    }

    /**
     * @return Identifier
     * @throws BindingResolutionException
     */
    public static function identifier(): Identifier
    {
        return self::app()->make(Identifier::class);
    }

    /**
     * @return UserInfoRepository
     * @throws BindingResolutionException
     */
    public static function userInfo(): UserInfoRepository
    {
        return self::app()->make(UserInfoRepository::class);
    }

    /**
     * @return BasicThumbnailer
     * @throws BindingResolutionException
     */
    public static function imageService(): BasicThumbnailer
    {
        return self::app()->make('helper/image');
    }
}
