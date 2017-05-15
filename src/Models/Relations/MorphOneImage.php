<?php

namespace Roem\Media\Models\Relations;

use Symfony\Component\HttpFoundation\File\UploadedFile;

trait MorphOneImage
{
    use MorphOneOrManyImage;

    public function saveImage(UploadedFile $file, $post)
    {
        $image = $this->image()->create($post);
        $image->saveMedia($file, $this->getImageStoragePath(), $this->getImagePath());

        $image->save();

        return $image;
    }

    /**
     * Get the image relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function image()
    {
        return $this->morphOne('Roem\Media\Models\Image', 'imageable');
    }
}
