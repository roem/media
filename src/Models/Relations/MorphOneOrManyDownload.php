<?php

namespace Roem\Media\Models\Relations;

use Config;

trait MorphOneOrManyDownload
{
    public function saveDownload($file, $post)
    {
        if (!isset($post['icon']) || strlen($post['icon']) === 0) {
            $icons = Config::get('roem-media.downloads.icons');
            $post['icon'] = $icons[$file->getClientMimeType()] ? $icons[$file->getClientMimeType()] : $icons['default'];
        }

        $download = $this->downloads()->create($post);
        $download->saveMedia($file, $this->getDownloadStoragePath(), $this->getDownloadPath());
        
        $download->save();
    }

    private function getDownloadStoragePath()
    {
        return Config::get('roem-media.downloads.paths.storage');
    }

    private function getDownloadPath()
    {
        if (defined('NAME')) {
            $name = self::NAME;
        } else {
            $name = get_class($this);
        }

        return "{$name}/{$this->id}";
    }

}
