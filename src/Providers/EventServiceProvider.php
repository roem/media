<?php namespace Roem\Media\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'eloquent.deleting: Roem\Media\Models\Image' => ['Roem\Media\Listeners\ImageDeleting'],
        'eloquent.deleting: Roem\Media\Models\Download' => ['Roem\Media\Listeners\DownloadDeleting'],
        'eloquent.deleting: Roem\Media\Models\Asset' => ['Roem\Media\Listeners\AssetDeleting'],
        'eloquent.deleting: Roem\Media\Models\Media' => ['Roem\Media\Listeners\MediaDeleting'],
    ];
}
