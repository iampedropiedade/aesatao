<?php
namespace Application\Controller\Api;

use Application\GoogleApis\AbstractApiController;
use Application\GoogleApis\Drive\Dtos\RequestDto;
use Concrete\Core\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Application\GoogleApis\Drive\DriveFactory;

class GoogleDriveController extends AbstractApiController
{
    public function index(): JsonResponse
    {
        $request = Request::getInstance();
        $requestDto = new RequestDto($request->query->all());
        $driveService = (new DriveFactory())->getDrive($requestDto->getDisplayPermissions());
        $drive = $driveService->getFolderContents($requestDto);
        return JsonResponse::fromJsonString($this->serializer->serialize($drive, 'json'));
    }
}