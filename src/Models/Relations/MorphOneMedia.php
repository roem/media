<?php

namespace Roem\Media\Models\Relations;

use File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

trait MorphOneMedia
{
    public function saveMedia(UploadedFile $file, $storageBasePath, $filePath)
    {
        $storagePath = "{$storageBasePath}/{$filePath}";

        if (!File::isDirectory($storagePath)) {
            File::makeDirectory($storagePath, 0775, true);
        }

        $file->move($storagePath, $file->getClientOriginalName());

        $media = $this->media()->create([
            'path' => $filePath,
            'filename' => $file->getClientOriginalName(),
            'extension' => $file->getClientOriginalExtension(),
            'mimeType' => $file->getClientMimeType(),
            'size' => $file->getClientSize(),
        ]);

        return $media;
    }
    
    public function getFilePath()
    {
        return "{$this->media->path}/{$this->media->filename}";
    }

    /**
     * Get the media relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function media()
    {
        return $this->morphOne('Roem\Media\Models\Media', 'mediaable');
    }
}
