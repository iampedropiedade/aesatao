<?php
namespace Application\Block\ApiFileList;

use Application\Service\FileManagerFolders;
use Application\Service\PaginatedItemsList\Builder\Pages;
use Concrete\Core\Block\BlockController;
use Concrete\Core\Http\Request;
use Concrete\Core\Page\Page;
use Concrete\Core\Page\Type\Type as PageType;

class Controller extends BlockController
{
    protected const CARD_STYLE_OPTIONS = [
        'file' => 'Ficheiro',
    ];
    protected $btTable = 'btApiFileList';
    protected $btInterfaceWidth = '1200';
    protected $btInterfaceHeight = '600';
    protected $btDefaultSet = 'application';

    /**
     * @return string
     */
    public function getBlockTypeDescription()
    {
        return t('Lista de ficheiros');
    }

    /**
     * @return string
     */
    public function getBlockTypeName()
    {
        return t('Lista de ficheiros');
    }

    public function save($args)
    {
        $args['parentFolderId']  = $args['parentFolderId'] ?: 0;
        parent::save($args);
    }

    public function add()
    {
        $this->edit();
    }

    public function edit()
    {
        $this->set('sortOptions', Pages::SORT_OPTIONS);
        $this->set('displayPaginationOptions', Pages::PAGINATION_DISPLAY_OPTIONS);
        $this->set('cardStyleOptions', self::CARD_STYLE_OPTIONS);
        $this->set('pageTypeOptions', $this->getPageTypeList());
        $this->set('fileManagerFolderOptions', (new FileManagerFolders())->getFileManagerFolderList());
    }

    public function view()
    {
        if(intval($this->get('ctaLinkToPageId')) > 0) {
            $linkToPage = Page::getByID($this->get('ctaLinkToPageId'));
            if($linkToPage) {
                $this->set('ctaLinkToPageUrl', $linkToPage->getCollectionLink());
            }
        }
        $this->set('apiType', 'files');
        $this->set('parentPageId', $this->get('parentPageId', 0));
        $this->set('apiUrl', '/api/files');

        $request = Request::getInstance();
        $this->set('filters', htmlspecialchars($request->query->get('filters'), ENT_QUOTES, 'UTF-8'));
    }

    protected function getPageTypeList(): array
    {
        $pageTypes = PageType::getList();
        $list = ['' => t('Please select a page type')];
        foreach ($pageTypes as $pageType) {
            $list[$pageType->getPageTypeHandle()]  = $pageType->getPageTypeName();
        }
        return $list;
    }
}
