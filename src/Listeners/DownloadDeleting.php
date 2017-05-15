<?php

namespace Roem\Media\Listeners;

use Roem\Media\Models\Download;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Queue\InteractsWithQueue;
use Log;

class DownloadDeleting implements ShouldBeQueued
{
    use InteractsWithQueue;

    /**
     * Handle the event for eloquent delete.
     *
     * @param  Download $download
     *
     * @return void
     */
    public function handle(Download $download)
    {
        if ($download->isForceDelete()) {
            Log::notice("Force-Delete Download: {$download->id}");

            foreach ($download->downloadLog as $log) {
                $log->delete();
            }

            $media = $download->media;
            $media->delete();
        } else {
            Log::notice("Delete Download: {$download->id}");
        }
    }

}
