<?php

namespace Roem\Media\Commands;

use Config;
use File;

class DeleteThumbnailsCommand
{
    public function fire($job, $id)
    {
        $publicBasePath = Config::get('roem/media::images.paths.public');
        $publicPath = public_path("{$publicBasePath}/{$id}");

        if (File::isDirectory($publicPath)) {
            File::deleteDirectory($publicPath);
        }

        $job->delete();
    }
}
