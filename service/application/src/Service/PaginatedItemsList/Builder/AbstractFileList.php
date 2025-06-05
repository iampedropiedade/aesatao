<?php
namespace Application\Service\PaginatedItemsList\Builder;

use Application\Dto\Response\FileList as FileListResponse;
use Concrete\Core\Http\Request;
use Concrete\Core\Search\Pagination\PaginationFactory;
use Concrete\Core\Tree\Node\Type\FileFolder;
use Pagerfanta\Pagerfanta;
use Application\Dto\Response\ItemListInterface;
use Concrete\Core\File\FileList as CoreFileList;
abstract class AbstractFileList extends CoreFileList
{
    public const DEFAULT_CURRENT_PAGE = 1;
    public const DEFAULT_ITEMS_PER_PAGE = 10;
    public const SORT_DATE_ASC = 'date_asc';
    public const SORT_DATE_DESC = 'date_desc';
    public const SORT_SITEMAP = 'sitemap';
    public const SORT_TITLE = 'title';
    public const SORT_OPTIONS = [
        self::SORT_DATE_DESC => 'Date Descending',
        self::SORT_DATE_ASC => 'Date Ascending',
        self::SORT_SITEMAP => 'Sitemap order',
        self::SORT_TITLE => 'Title',
    ];
    public const PAGINATION_DISPLAY = 'display';
    public const PAGINATION_HIDE = 'hide';
    public const PAGINATION_DISPLAY_OPTIONS = [
        self::PAGINATION_DISPLAY => 'Display',
        self::PAGINATION_HIDE => 'Hide',
    ];

    public function getResponse(Request $request): ItemListInterface
    {
        $folder = FileFolder::getByID($request->get('parentFolderId'));
        $this->getQueryObject()->andWhere('f.folderTreeNodeID = :parentFolderID')
            ->setParameter('parentFolderID', $folder->getTreeNodeID());
        $pagination = $this->getPaginationFactory();
        $pagination->setMaxPerPage($request->get('itemsPerPage', self::DEFAULT_ITEMS_PER_PAGE));
        $pagination->setCurrentPage($request->get('page', self::DEFAULT_CURRENT_PAGE));
        return new FileListResponse($pagination);
    }

    public function getPaginationFactory() : Pagerfanta
    {
        $factory = new PaginationFactory(Request::createFromGlobals());
        return $factory->createPaginationObject($this);
    }

}
