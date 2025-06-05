<?php
namespace Application\Controller\Api;

use Application\Controller\Api\AbstractApiController;
use Application\Service\PaginatedItemsList\Builder\Files;
use Application\Service\PaginatedItemsList\PaginatedItemsList;
use Concrete\Core\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FilesController extends AbstractApiController
{
    public function index(): JsonResponse
    {
        $request = Request::getInstance();
        $builder = new Files();
        try {
            return new JsonResponse((new PaginatedItemsList($builder, $request))->getResponse());
        }
        catch (\Exception $e) {
            return new JsonResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
