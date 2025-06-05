<?php
namespace Application\Dto\Response;

use Application\Constants\Attributes;
use Application\Service\Picture;
use DateTime;
use Concrete\Core\Page\Page as CorePage;
use Concrete\Core\Entity\Attribute\Value\Value\SelectValue;
use Concrete\Core\Entity\Attribute\Value\Value\SelectValueOption;
use Concrete\Core\Entity\File\File;

class Page
{
    public string $title;
    public string $description;
    public string $url;
    public ?string $thumbnailUrl;
    public string $target = '_self';
    /**
     * @var array<Tag>
     */
    public array $tags;
    public DateTime $date;
    public DateTime $dateModified;

    public function __construct(CorePage $page)
    {
        if($page->isAliasPage()) {
            $aliasPage = CorePage::getByID($page->getCollectionPointerID());
            $url = $aliasPage->getCollectionLink();
        }
        else {
            $url = $page->getCollectionLink();
        }
        $this->setTarget($page->isExternalLink() ? '_blank' : '_self');
        $this->setTitle($page->getCollectionName());
        $this->setDescription($page->getCollectionDescription());
        $this->setUrl($url);
        $this->setDate($page->getCollectionDatePublicObject());
        $this->setDateModified(new DateTime($page->getCollectionDateLastModified()));
        $this->setTags($page->getAttribute(Attributes::TAGS));
        $this->setThumbnailUrl($page->getAttribute(Attributes::MAIN_IMAGE) ?? $page->getSite()->getAttribute(Attributes::WEBSITE_NEWS_ARTICLE_THUMBNAIL));
    }

    public function getTarget(): string
    {
        return $this->target;
    }

    public function setTarget(string $target): void
    {
        $this->target = $target;
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

    public function getDateModified(): DateTime
    {
        return $this->dateModified;
    }

    public function setDateModified(DateTime $dateModified): void
    {
        $this->dateModified = $dateModified;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function setTags(?SelectValue $tags): self
    {
        if($tags !== null) {
            foreach ($tags as /** @var SelectValueOption $tag */$tag) {
                $this->tags[] = new Tag($tag);;
            }
        }
        return $this;
    }

    public function getThumbnailUrl(): ?string
    {
        return $this->thumbnailUrl;
    }

    public function setThumbnailUrl(?File $thumbnail): Page
    {
        if($thumbnail !== null) {
            $image = new Picture($thumbnail);
            $this->thumbnailUrl = $image->getSrc(800, 600, true);
        }
        return $this;
    }
}