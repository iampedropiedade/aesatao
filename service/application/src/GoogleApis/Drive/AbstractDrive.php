<?php
namespace Application\GoogleApis\Drive;

use Application\GoogleApis\Drive\Dtos\DriveDto;
use Application\GoogleApis\Drive\Dtos\RequestDto;
use Google\Exception;
use Google\Service\Drive as DriveService;
use Application\GoogleApis\ClientFactory;

abstract class AbstractDrive implements DriveInterface
{
    protected ClientFactory $clientFactory;

    public function __construct()
    {
        $this->clientFactory = new ClientFactory();
    }

    abstract public function getFolderContents(RequestDto $request): DriveDto;
    abstract public function find(string $query): DriveDto;

    /**
     * @throws Exception
     */
    protected function getPublicService(): DriveService
    {
        return new DriveService($this->clientFactory->getPublicClient());
    }

    protected function getUserService(): DriveService
    {
        return new DriveService($this->clientFactory->getUserClient());
    }

    protected function getItemsFromApi(RequestDto $request, DriveService $service): DriveDto
    {
        $params = [
            'q' => sprintf("'%s' in parents", $request->getParentFolderId()),
            'fields' => 'files(id, name, mimeType, webViewLink, createdTime, modifiedTime, size),nextPageToken',
            'pageSize' => $request->getItemsPerPage(),
            'pageToken' => $request->getPageToken(),
            'orderBy' => $request->getOrderBy()
        ];
        return new DriveDto($service->files->listFiles($params));
    }

    protected function findInApi(string $query, DriveService $service): DriveDto
    {
        $params = [
            'q' => "name contains 'Example'",
            'includeItemsFromAllDrives' => true,
            'supportsAllDrives' => true,
            'driveId' => '1vn6OUtSXd6Ck1eJMcT1ke5pled4Q8Z_T',
            'corpora' => 'drive',
            'fields' => 'files(id, name, mimeType, webViewLink, createdTime, modifiedTime)',
            'pageSize' => 10
        ];
        return new DriveDto($service->files->listFiles($params));
    }
}