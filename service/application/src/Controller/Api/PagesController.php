<?php
namespace Application\Controller\Api;

use Application\Constants\PageTypes;
use Application\Service\PaginatedItemsList\Builder\Highlights;
use Application\Service\PaginatedItemsList\Builder\NewsArticles;
use Application\Service\PaginatedItemsList\Builder\Pages;
use Application\Service\PaginatedItemsList\PaginatedItemsList;
use Concrete\Core\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PagesController extends AbstractApiController
{
    public function index(): JsonResponse
    {
        $request = Request::getInstance();
        $builder = new Pages();
        try {
            return new JsonResponse((new PaginatedItemsList($builder, $request))->getResponse());
        }
        catch (\Exception $e) {
            return new JsonResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
