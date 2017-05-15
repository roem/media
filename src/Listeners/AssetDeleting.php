<?php

namespace Roem\Media\Listeners;

use Roem\Media\Models\Asset;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Queue\InteractsWithQueue;
use Log;

class AssetDeleting implements ShouldBeQueued
{
    use InteractsWithQueue;

    /**
     * Handle the event for eloquent delete.
     *
     * @param  Asset $asset
     *
     * @return void
     */
    public function handle(Asset $asset)
    {
        if ($asset->isForceDelete()) {
            Log::notice("Force-Delete Asset: {$asset->id}");

            $asset->media()->delete();
        } else {
            Log::notice("Delete Asset: {$asset->id}");
        }
    }

}
