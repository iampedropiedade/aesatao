<?php
namespace Application\Service;

use Concrete\Core\Application\Application as App;
use Concrete\Core\Support\Facade\Application;
use Concrete\Core\Entity\File\File;
use Concrete\Core\File\Image\Thumbnail\Type\Type;
use Concrete\Core\Entity\File\Image\Thumbnail\Type\Type as ThumbnailType;
use Concrete\Core\File\Rescanner;

class Picture
{
    protected App $app;
    protected bool $rescan = false;
    protected string $svg = '<svg id="eez8YxmDaXR1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 %s %s" shape-rendering="geometricPrecision" text-rendering="geometricPrecision"><rect width="%s" height="%s" rx="0" ry="0" opacity="0.25" fill="#0069E1" stroke-width="0"/></svg>';

    public function __construct(protected readonly ?File $file)
    {
        $this->app = Application::getFacadeApplication();
    }

    public function getSrc(int $width, int $height, bool $exact = false)
    {
        if($this->file) {
            return $this->getOrCreateThumbnail($width, $height, $exact);
        }
        return $this->getPlaceholder($width, $height);
    }

    protected function getPlaceholder(int $width, int $height): string
    {
        return 'data:image/svg+xml;base64,' . base64_encode(sprintf($this->svg, $width, $height, $width, $height));
    }

    protected function getOrCreateThumbnail(int $width, int $height, bool $exact)
    {
        if($this->file) {
            $type = $this->getOrCreateType($width, $height, $exact);
            if($this->rescan === true) {
                $fv = $this->file->getApprovedVersion();
                $scanner = $this->app->make(Rescanner::class);
                $scanner->rescanFileVersion($fv);
            }
            return $this->file->getThumbnailURL($type->getBaseVersion());
        }
        return $this->getPlaceholder($width, $height);
    }

    protected function getOrCreateType(int $width, int $height, bool $exact): ThumbnailType
    {
        $handle = sprintf('%s_%s_%s', $width, $height, $exact ? ThumbnailType::RESIZE_EXACT : ThumbnailType::RESIZE_PROPORTIONAL);
        $type = Type::getByHandle($handle);
        if ($type) {
            return $type;
        }
        $this->rescan = true;
        $type = new ThumbnailType();
        $type->setName(sprintf('%sx%s - %s', $width, $height, $exact ? ThumbnailType::RESIZE_EXACT : ThumbnailType::RESIZE_PROPORTIONAL));
        $type->setWidth($width);
        $type->setHeight($height);
        $type->setSizingMode($exact ? ThumbnailType::RESIZE_EXACT : ThumbnailType::RESIZE_PROPORTIONAL);
        $type->setHandle($handle);
        $type->save();
        return $type;
    }
}
