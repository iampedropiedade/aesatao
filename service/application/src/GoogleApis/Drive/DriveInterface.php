<?php
namespace Application\GoogleApis\Drive;

use Application\GoogleApis\Drive\Dtos\DriveDto;
use Application\GoogleApis\Drive\Dtos\RequestDto;

interface DriveInterface
{
    public function getFolderContents(RequestDto $request): DriveDto;
    public function find(string $query): DriveDto;
}