<?php

namespace Concrete\Package\Redirects;

use \Concrete\Core\Package\Package;
use Concrete\Core\Page\Single as SinglePage;
use Concrete\Package\Redirects\Helpers\RedirectsHelper;
use Concrete\Core\Entity\Package as PackageEntity;
use Concrete\Core\Page\Page;

/**
 * Class Controller
 * @package Concrete\Package\Redirects
 */
class Controller extends Package
{
    protected $pkgHandle = 'redirects';
    protected $appVersionRequired = '8.0.0';
    protected $pkgAutoloaderRegistries = ['src/' => '\Concrete\Package\Redirects'];
    protected $pkgVersion = '1.0.3';

    /**
     * Add listeners for the events we're interested in
     */
    public function on_start()
    {
        \Events::addListener(
            'on_before_dispatch',
            function () {
                RedirectsHelper::init();
            }
        );
    }

    /**
     * @return string
     */
    public function getPackageDescription()
    {
        return t('Allows the single creation and mass import of 301 redirects');
    }

    /**
     * @return string
     */
    public function getPackageName()
    {
        return t('301 Redirects');
    }

    /**
     * Register installation
     */
    public function install()
    {
        $pkg = parent::install();
        $this->installOrUpgrade($pkg);
    }

    public function upgrade()
    {
        parent::upgrade();
        $pkg = Package::getByHandle($this->pkgHandle);
        $this->installOrUpgrade($pkg);
    }

    private function installOrUpgrade(PackageEntity $package): void
    {
        $this->installSinglePages($package);
    }

    private function installSinglePages(PackageEntity $package): void
    {

        $singlePages = [
            [
                'path'  => sprintf('/dashboard/%s/', $this->pkgHandle),
                'cName' => 'Redirects',
                'excludeFromNav' => false,
            ],
            [
                'path'  => sprintf('/dashboard/%s/import', $this->pkgHandle),
                'cName' => 'Import',
                'excludeFromNav' => false,
            ],
            [
                'path'  => sprintf('/dashboard/%s/export', $this->pkgHandle),
                'cName' => 'Export',
                'excludeFromNav' => false,
            ],
            [
                'path'  => sprintf('/dashboard/%s/edit', $this->pkgHandle),
                'cName' => 'Edit',
                'excludeFromNav' => true,
            ],
        ];

        foreach ($singlePages as $singlePage) {
            $singlePageObject = Page::getByPath($singlePage['path']);
            // Check if it exists, if not, add it
            if ($singlePageObject->isError() || (!is_object($singlePageObject))) {
                $sp = SinglePage::add($singlePage['path'], $package);
                unset($singlePage['path']);
                if (!empty($singlePage)) {
                    // And make sure we update the page with the remaining values
                    $sp->update($singlePage);
                    $sp->setAttribute('exclude_nav', $singlePage['excludeFromNav']);
                }
            }
        }

    }

}
