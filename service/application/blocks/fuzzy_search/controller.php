<?php
namespace Application\Block\FuzzySearch;

use Concrete\Core\Block\BlockController;
use Concrete\Core\Http\Request;

class Controller extends BlockController
{
    protected const array SEARCH_DOMAINS_OPTIONS = [
        'pages' => ['title' => 'Páginas'],
        'documents' => ['title' => 'Documentos'],
        'events' => ['title' => 'Eventos'],
    ];
    protected $btTable = 'btFuzzySearch';
    protected $btInterfaceWidth = '1200';
    protected $btInterfaceHeight = '600';
    protected $btDefaultSet = 'application';

    /**
     * @return string
     */
    public function getBlockTypeDescription()
    {
        return t('Renders a search widget');
    }

    /**
     * @return string
     */
    public function getBlockTypeName()
    {
        return t('Fuzzy search');
    }

    public function on_start()
    {
        parent::on_start();
        $this->set('searchDomains', explode(',' , $this->get('searchDomains', '[]')));
    }

    public function add()
    {
        $this->edit();
    }

    public function edit()
    {
        $this->set('searchDomainsOptions', self::SEARCH_DOMAINS_OPTIONS);
    }

    public function save($args)
    {
        $args['searchDomains'] = implode(',', $args['searchDomains'] ?? []);
        parent::save($args);
    }

    public function view()
    {
        $request = Request::getInstance();
        $this->set('allowedSearchDomains', array_intersect_key(self::SEARCH_DOMAINS_OPTIONS, array_flip($this->get('searchDomains'))));
        $this->set('query', $request->get('query'));
    }
}
