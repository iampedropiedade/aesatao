<?php
namespace Application\Service;

use Application\Constants\Attributes;
use Application\Dto\Response\Tag;
use Concrete\Attribute\Select\Controller as SelectController;
use Concrete\Core\Entity\Attribute\Key\Key;
use Concrete\Core\Page\Page;
use Doctrine\ORM\EntityManager;
use Concrete\Core\Support\Facade\DatabaseORM;

class Tags
{
    protected EntityManager $em;

    public function __construct()
    {
        $this->em = DatabaseORM::entityManager();
    }

    public function getAllTags(): array
    {
        $attributeKey = $this->em->getRepository(Key::class)->findOneBy(['akHandle' => Attributes::TAGS]);;
        if (!$attributeKey) {
            return [];
        }
        $controller = $attributeKey->getController();
        if (!($controller instanceof SelectController)) {
            return [];
        }
        $list = [];
        $optionList = $controller->getOptions();
        foreach ($optionList as $item) {
            $list[$item->getSelectAttributeOptionID()] = $item->getSelectAttributeOptionValue();
        }
        asort($list);
        return $list;
    }

    public function getTags(Page $page): array
    {
        $parent = Page::getByID($page->getCollectionParentID());
        /** @var array<Tag> $tags */
        $tags = [];
        $tagsObjects = $page->getAttribute(Attributes::TAGS);
        if(empty($tagsObjects)) {
            return $tags;
        }
        foreach ($tagsObjects as $tagObject) {
            $tags[] = new Tag($tagObject, $parent);
        }
        return $tags;
    }

}
