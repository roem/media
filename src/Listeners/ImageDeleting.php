<?php

namespace Roem\Media\Listeners;

use Roem\Media\Models\Image;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Queue\InteractsWithQueue;
use Log;

class ImageDeleting implements ShouldBeQueued
{
    use InteractsWithQueue;

    /**
     * Handle the event for eloquent delete.
     *
     * @param Image $image
     *
     * @return void
     */
    public function handle(Image $image)
    {
        if ($image->isForceDelete()) {
            Log::notice("Force-Delete Image: {$image->id}");

            $image->media->delete();
        } else {
            Log::notice("Delete Image: {$image->id}");
        }
    }
}
