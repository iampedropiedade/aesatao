<?php
namespace Application\Dto\Response;

use Concrete\Core\Entity\Attribute\Value\Value\SelectValueOption;
use Concrete\Core\Page\Page;

class Tag
{
    public int $id;
    public string $tag;
    public string $url;

    public function __construct(SelectValueOption $tag, ?Page $page = null)
    {
        $this->setId((int)$tag->getSelectAttributeOptionID());
        $this->setTag($tag->getSelectAttributeOptionDisplayValue());
        if($page) {
            $this->setUrl($page->getCollectionLink() . '?filters=' .  htmlspecialchars(json_encode(['tags' => [$this]]), ENT_QUOTES, 'UTF-8'));
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getTag(): string
    {
        return $this->tag;
    }

    public function setTag(string $tag): self
    {
        $this->tag = $tag;
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
}