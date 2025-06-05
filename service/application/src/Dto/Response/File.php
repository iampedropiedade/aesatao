<?php
namespace Application\Dto\Response;

use Application\Constants\Attributes;
use DateTime;
use Concrete\Core\Entity\File\File as CoreFile;
use Concrete\Core\Entity\Attribute\Value\Value\SelectValue;
use Concrete\Core\Entity\Attribute\Value\Value\SelectValueOption;
use Concrete\Core\Tree\Node\Type\File as FileNode;
class File
{
    public string $title;
    public string $description;
    public string $url;
    public array $tags = [];
    public string $icon;
    public DateTime $date;

    public function __construct(CoreFile $file)
    {
        /** @var FileNode $node */
        $node = $file->getFileNodeObject();
        $version = $file->getVersion();
        $object = $node->getJSONObject();
        $this->setTitle(trim(str_replace('.'.$version->getExtension(), '', $node->getTreeNodeDisplayName()), '.'));
        $this->setIcon($version->getExtension());
        $this->setDescription($version->getDescription());
        $this->setUrl($object->url);
        $this->setDate(new \DateTime($node->getDateCreated()));
        $this->setTags($file->getAttribute(Attributes::FILE_TAGS));
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getIcon(): string
    {
        return $this->icon;
    }

    public function setIcon(string $icon): self
    {
        $this->icon = 'fa-solid fa-file-' . $icon;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function setDate(DateTime $date): self
    {
        $this->date = $date;
        return $this;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function setTags(?SelectValue $tags): self
    {
        if($tags !== null) {
            foreach ($tags as /** @var SelectValueOption $tag */$tag) {
                $this->tags[] = (string)$tag->getSelectAttributeOptionDisplayValue();
            }
        }
        return $this;
    }
}