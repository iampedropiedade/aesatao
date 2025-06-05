<?php
namespace Application\Block\ApiPageList;

use Application\Service\Tags;
use Application\Service\PaginatedItemsList\Builder\Pages;
use Concrete\Core\Block\BlockController;
use Concrete\Core\Http\Request;
use Concrete\Core\Page\Page;
use Concrete\Core\Page\Type\Type as PageType;

class Controller extends BlockController
{
    protected const CARD_STYLE_OPTIONS = [
        'page' => 'Página',
        'page_with_date' => 'Página com data de publicação',
        'article' => 'Artigo / Notícia',
        'horizontal' => 'Horizontal com imagem',
    ];
    protected $btTable = 'btApiPageList';
    protected $btInterfaceWidth = '1200';
    protected $btInterfaceHeight = '600';
    protected $btDefaultSet = 'application';

    /**
     * @return string
     */
    public function getBlockTypeDescription()
    {
        return t('Lista de páginas');
    }

    /**
     * @return string
     */
    public function getBlockTypeName()
    {
        return t('Lista de páginas');
    }

    public function on_start()
    {
        $this->set('filterPageTypes', json_decode($this->get('filterPageTypes')));
        $this->set('filterTagsIn', json_decode($this->get('filterTagsIn')));
        $this->set('filterTagsOut', json_decode($this->get('filterTagsOut')));
    }

    public function save($args)
    {
        $args['filterPageTypes'] = json_encode(array_values($args['filterPageTypes'] ?? []));
        $args['filterTagsIn'] = json_encode(array_values($args['filterTagsIn'] ?? []));
        $args['filterTagsOut'] = json_encode(array_values($args['filterTagsOut'] ?? []));
        $args['parentPageId']  = $args['parentPageId'] ?: 0;
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
        $this->set('tagsList', (new Tags())->getAllTags());
    }

    public function view()
    {
        if(intval($this->get('ctaLinkToPageId')) > 0) {
            $linkToPage = Page::getByID($this->get('ctaLinkToPageId'));
            if($linkToPage) {
                $this->set('ctaLinkToPageUrl', $linkToPage->getCollectionLink());
            }
        }
        $this->set('apiType', 'pages');
        $this->set('apiUrl', '/api/pages');
        $request = Request::getInstance();

        $filters = [];
        $filters['pageTypes'] = $this->get('filterPageTypes');
        $filters['tagsIn'] = $this->get('filterTagsIn');
        $filters['tagsOut'] = $this->get('filterTagsOut');
        $filters['parentPageId'] = $this->get('parentPageId', 0);
        $filters['query'] = htmlspecialchars($request->query->get('filters'), ENT_QUOTES, 'UTF-8');
        $this->set('filters', $filters);
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
