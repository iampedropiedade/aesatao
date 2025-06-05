<?php
namespace Application\Service;

use Concrete\Core\Cache\Level\ExpensiveCache;
use Concrete\Core\File\Filesystem;
use Concrete\Core\Tree\Node\Type\FileFolder;

class FileManagerFolders
{
    public const CACHE_KEY_ALL_FOLDERS = 'file_manager_folders_all_folders';
    protected ExpensiveCache $cache;

    public function __construct()
    {
        $this->cache = ServiceHelper::app()->make(ExpensiveCache::class);
    }

    public function getFileManagerFolderList(): array
    {
        $folderList = $this->cache->getItem(self::CACHE_KEY_ALL_FOLDERS);
        if ($folderList->isMiss() === true) {
            $folderList->lock();
            $filesystem = new Filesystem();
            $rootFolder = $filesystem->getRootFolder();
            $list = ['' => 'Please select a folder'];
            if ($rootFolder) {
                $list[$rootFolder->getTreeNodeID()] = $rootFolder->getTreeNodeDisplayName();
                $list = $list + $this->getChildFolders($rootFolder, [$rootFolder->getTreeNodeDisplayName()]);
            }
            $this->cache->save($folderList->set($list)->expiresAfter(300));
        } else {
            $list = $folderList->get();
        }
        return $list;
    }

    private function getChildFolders(FileFolder $folder, array $parentPath): array
    {
        $folders = [];
        $folder->populateDirectChildrenOnly();
        $childNodes = $folder->getChildNodes();
        foreach ($childNodes as $child) {
            if ($child instanceof FileFolder) {
                $parentPath[] = $child->getTreeNodeDisplayName();
                $folders[$child->getTreeNodeID()] = implode(' / ', $parentPath);
                $folders = $folders + $this->getChildFolders($child, $parentPath);
                array_pop($parentPath);
            }
        }
        return $folders;
    }
}