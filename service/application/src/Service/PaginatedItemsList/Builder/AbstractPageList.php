<?php
namespace Application\Service\PaginatedItemsList\Builder;

use Application\Constants\Attributes;
use Application\Dto\Response\ItemListInterface;
use Application\Dto\Response\PageList as PageListResponse;
use Concrete\Core\Entity\Attribute\Value\Value\SelectValueOption;
use Concrete\Core\Http\Request;
use Concrete\Core\Page\PageList as CorePageList;
use Concrete\Core\Search\Pagination\PaginationFactory;
use Pagerfanta\Pagerfanta;

abstract class AbstractPageList extends CorePageList
{
    public const int DEFAULT_CURRENT_PAGE = 1;
    public const int DEFAULT_ITEMS_PER_PAGE = 10;
    public const string SORT_DATE_ASC = 'date_asc';
    public const string SORT_DATE_DESC = 'date_desc';
    public const string SORT_SITEMAP = 'sitemap';
    public const string SORT_TITLE = 'title';
    public const array SORT_OPTIONS = [
        self::SORT_DATE_DESC => 'Data decrescente',
        self::SORT_DATE_ASC => 'Data crescente',
        self::SORT_SITEMAP => 'Ordenação no mapa do site',
        self::SORT_TITLE => 'Título',
    ];
    public const string PAGINATION_DISPLAY = 'display';
    public const string PAGINATION_HIDE = 'hide';
    public const array PAGINATION_DISPLAY_OPTIONS = [
        self::PAGINATION_DISPLAY => 'Mostrar',
        self::PAGINATION_HIDE => 'Não mostrar',
    ];

    protected $paginationPageParameter = 'page';

    public function __construct()
    {
        parent::__construct();
    }

    public function getResponse(Request $request): ItemListInterface
    {
        $this->handleSort($request->get('sort'));
        $this->handleFiltering(json_decode($request->get('filters', '[]'), true));
        $pagination = $this->getPaginationFactory();
        $pagination->setMaxPerPage($request->get('itemsPerPage', self::DEFAULT_ITEMS_PER_PAGE));
        $pagination->setCurrentPage($request->get('page', self::DEFAULT_CURRENT_PAGE));
        return new PageListResponse($pagination);
    }

    protected function handleFiltering(?array $filters): void
    {
        if(!empty($filters['tagsIn'])) {
            $this->filterByTags($filters['tagsIn']);
        }
        if(!empty($filters['tagsOut'])) {
            $this->filterByTags($filters['tagsOut'], false);
        }
        if(!empty($filters['pageTypes'])) {
            $this->filterByPageTypeHandle($filters['pageTypes']);
        }
        if(isset($filters['parentPageId']) && $filters['parentPageId'] > 0) {
            $this->filterByParentID($filters['parentPageId']);
        }
        if(!empty($filters['query'])) {
            $this->filterByKeywords($filters['query']);
        }
    }

    /**
     * @param string|null $sort
     * @return void
     */
    public function handleSort(?string $sort = null): void
    {
        switch ($sort) {
            case self::SORT_TITLE:
                $this->sortByName();
                break;
            case self::SORT_SITEMAP:
                $this->sortByDisplayOrder();
                break;
            case self::SORT_DATE_ASC:
                $this->sortByPublicDate();
                break;
            case self::SORT_DATE_DESC:
            default:
                $this->sortByPublicDateDescending();
        }
    }

    /**
     * @param string $keywords
     * @return void
     */
    public function filterByFulltextKeywords($keywords): void
    {
        $this->isFulltextSearch = true;
        $this->autoSortColumns[] = 'cIndexScore';
        $this->query->addSelect('match(psi.cName, psi.cDescription, psi.content) against (:fulltext) as cIndexScore');
        $this->query->andWhere('match(psi.cName, psi.cDescription, psi.content) against (:fulltext)');
        $this->query->orderBy('cIndexScore', 'desc');
        $this->query->setParameter('fulltext', $keywords);
    }

    public function filterByExcludePageTypeHandles(array $ptHandles): void
    {
        $db = \Database::get();
        $this->query->andWhere(
            $this->query->expr()->notIn('ptHandle', array_map([$db, 'quote'], $ptHandles))
        );
    }

    public function getPaginationFactory() : Pagerfanta
    {
        $factory = new PaginationFactory(Request::createFromGlobals());
        return $factory->createPaginationObject($this);
    }

    public function filterByTags(?array $tags, $include=true): void
    {
        if($tags === null || count($tags) === 0) {
            return;
        }
        $this->filterBySelectMultipleOr(Attributes::TAGS, $tags, $include);
    }

    public function filterBySelectMultipleOr($attributeHandle, array $ids, $like=true)
    {
        if(empty($ids)) {
            return;
        }
        $filter = $like ? 'like' : 'notLike';
        $expressions = array();
        $em = \Database::connection()->getEntityManager();
        $repository = $em->getRepository(SelectValueOption::class);
        foreach ($ids as $key => $selectId) {
            $option = $repository->findOneBy(['avSelectOptionID' => $selectId]);
            if($option) {
                $column = 'ak_' . $attributeHandle;
                $expressions[] = $this->query->expr()->{$filter}($column, ':option_' . $attributeHandle . '_' . $key);
                $this->query->setParameter('option_' . $attributeHandle . '_' . $key, "%\n" . $option->getSelectAttributeOptionValue(false) . "\n%");
            }
        }
        if (count($expressions)) {
            $this->query->andWhere(call_user_func_array(array($this->query->expr(), 'orX'), $expressions));
        }
    }

    public function sortByDisplayOrder()
    {
        $this->query->orderBy('p.cDisplayOrder', 'asc');
    }

    public function sortByPublicDateDescending()
    {
        $this->query->orderBy('ak_is_featured', 'desc');
        $this->query->addOrderBy('cv.cvDatePublic', 'desc');
    }

    public function sortByPublicDate()
    {
        $this->query->orderBy('ak_is_featured', 'desc');
        $this->query->addOrderBy('cv.cvDatePublic', 'asc');
    }

    public function sortByName()
    {
        $this->query->orderBy('cv.cvName', 'asc');
    }

    public function filterByPageTypeHandle($ptHandle)
    {
        $db = \Database::get();
        if (is_array($ptHandle)) {
            $ptHandle = array_filter($ptHandle);
            if(!empty($ptHandle)) {
                $this->query->andWhere(
                    $this->query->expr()->in('ptHandle', array_map([$db, 'quote'], $ptHandle))
                );
            }
        } else {
            $this->query->andWhere('pt.ptHandle = :ptHandle');
            $this->query->setParameter('ptHandle', $ptHandle);
        }
    }

}
