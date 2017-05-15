<?php

namespace Roem\Media\Commands;

use File;

class DeletePathCommand
{
    public function fire($job, $storagePath)
    {
        $path = storage_path($storagePath);

        if (File::isDirectory($path)) {
            File::deleteDirectory($path);
        }

        $job->delete();
    }
}
