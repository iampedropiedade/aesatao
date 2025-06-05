<?php
namespace Application\GoogleApis\Drive;

use Application\GoogleApis\Drive\Dtos\RequestDto;

class DriveFactory
{
    public function getDrive(string $driveType): DriveInterface
    {
        if($driveType === RequestDto::DRIVE_TYPE_PRIVATE) {
            return new UserDrive();
        }
        return new PublicDrive();
    }
}