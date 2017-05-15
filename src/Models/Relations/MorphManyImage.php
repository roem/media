<?php

namespace Roem\Media\Models\Relations;

use Symfony\Component\HttpFoundation\File\UploadedFile;

trait MorphManyImage
{
    use MorphOneOrManyImage;

    public function saveImage(UploadedFile $file, $post)
    {
        $image = $this->images()->create($post);
        $image->saveMedia($file, $this->getImageStoragePath(), $this->getImagePath());

        $image->save();

        return $image;
    }

    /**
     * Get the image relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function images()
    {
        return $this->morphMany('Roem\Media\Models\Image', 'imageable');
    }
}
