<?php

namespace Roem\Media\Models\Relations;

trait MorphOneOrManyImage
{

    private function getImageStoragePath()
    {
        return config('roem-media.images.paths.storage');
    }

    private function getImagePath()
    {
        if (defined('NAME')) {
            $name = self::NAME;
        } else {
            $name = class_basename($this);
        }

        return "{$name}/{$this->id}";
    }
}
