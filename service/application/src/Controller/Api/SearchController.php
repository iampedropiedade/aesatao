<?php
namespace Application\Controller\Api;

use Application\GoogleApis\AbstractApiController;
use Application\GoogleApis\Drive\Dtos\RequestDto;
use Application\Service\PaginatedItemsList\Builder\Pages;
use Application\Service\PaginatedItemsList\PaginatedItemsList;
use Concrete\Core\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Application\GoogleApis\Drive\DriveFactory;
use Symfony\Component\HttpFoundation\Response;

class SearchController extends AbstractApiController
{
    public function index(): JsonResponse
    {
        $request = Request::getInstance();

        $query = $request->query->get('query');
        $searchDomains = array_keys(json_decode($request->query->get('searchDomains', '[]'), true));

        if(in_array('documents', $searchDomains)) {
            /*
            $driveService = (new DriveFactory())->getDrive('public');
            $drive = $driveService->find($query);
            var_dump($drive);
            exit;
            */
        }

        if(in_array('pages', $searchDomains)) {
            $builder = new Pages();
            $builder->filterByFulltextKeywords($query);
            try {
                $data = (new PaginatedItemsList($builder, $request))->getResponse();
            }
            catch (\Exception $e) {
            }
            return new JsonResponse($data);
        }

        return new JsonResponse('No results found', Response::HTTP_NOT_FOUND);
    }

}