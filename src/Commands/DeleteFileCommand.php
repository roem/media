<?php

namespace Roem\Media\Commands;

use File;

class DeleteFileCommand
{
    public function fire($job, $storagePath)
    {
        $file = storage_path($storagePath);

        if (File::exists($file)) {
            File::delete(storage_path($storagePath));
        }

        $job->delete();
    }
}
