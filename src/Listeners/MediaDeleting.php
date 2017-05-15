<?php

namespace Roem\Media\Listeners;

use File;
use Roem\Media\Models\Media;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Queue\InteractsWithQueue;
use Log;

class MediaDeleting implements ShouldBeQueued
{
    use InteractsWithQueue;

    /**
     * Handle the event for eloquent delete.
     *
     * @param Media $media
     *
     * @return void
     */
    public function handle(Media $media)
    {
        Log::notice("Delete Media: {$media->id}");

        $storageBasePath = config('roem-media.images.paths.storage');
        $file = "{$storageBasePath}/{$media->path}/{$media->filename}";

        if (File::exists($file)) {
            File::delete($file);
        }
    }
}
