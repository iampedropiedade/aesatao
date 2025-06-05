<?php
namespace Application\Block\GoogleDriveFolder;

use Concrete\Core\Block\BlockController;
use Concrete\Core\Editor\LinkAbstractor;
use Application\Routes\Router;

class Controller extends BlockController
{
    protected const array DISPLAY_PERMISSIONS = [
        'public' => 'Public items only',
        'private' => 'Private and public items (requires logged in user)',
    ];

    protected const array OPEN_FOLDERS_METHODS = [
        'site' => 'Abrir no website',
        'drive' => 'Abrir na drive',
    ];

    protected const array ITEM_STYLE_OPTIONS = [
        'list' => 'List',
        'grid' => 'Grid',
    ];

    public const array SORT_OPTIONS = [
        'modifiedTime' => 'Date Ascending',
        'modifiedTime desc' => 'Date Descending',
        'name' => 'Alphabetically by file/folder name',
    ];

    public const array PAGINATION_DISPLAY_OPTIONS = [
        'display' => 'Display',
        'hide' => 'Hide',
    ];

    public const array DISPLAY_ITEM_TYPES_OPTIONS = [
        'all' => 'Files and folders',
        'folders' => 'Folders only',
        'files' => 'Files only',
    ];

    protected $btTable = 'btGoogleDriveFolder';
    protected $btInterfaceWidth = '900';
    protected $btInterfaceHeight = '600';
    protected $btDefaultSet = 'application';

    /**
     * @return string
     */
    public function getBlockTypeDescription()
    {
        return t('Renders details for a Google Drive Folder');
    }

    /**
     * @return string
     */
    public function getBlockTypeName()
    {
        return t('Google Drive Folder');
    }

    public function add()
    {
        $this->edit();
    }

    public function edit()
    {
        $this->set('sortOptions', self::SORT_OPTIONS);
        $this->set('displayPaginationOptions', self::PAGINATION_DISPLAY_OPTIONS);
        $this->set('itemStyleOptions', self::ITEM_STYLE_OPTIONS);
        $this->set('displayPermissionsOptions', self::DISPLAY_PERMISSIONS);
        $this->set('displayItemTypesOptions', self::DISPLAY_ITEM_TYPES_OPTIONS);
        $this->set('openFoldersMethodOptions', self::OPEN_FOLDERS_METHODS);
    }

    public function getContentEditMode()
    {
        return LinkAbstractor::translateFromEditMode($this->get('intro'));
    }

    public function view()
    {
        $this->set('apiUrl', Router::ROUTE_GOOGLE_DRIVE);
    }
}
