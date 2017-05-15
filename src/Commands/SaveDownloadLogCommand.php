<?php

namespace Roem\Media\Commands;

use Roem\Media\Models\Download;

class SaveDownloadLogCommand
{
    public function fire($job, $input)
    {
        $download = Download::findOrFail($input['download']);
        $download->downloadLog()->create([
            'ip_address' => $input['ip'],
        ]);
        $download->save();

        $job->delete();
    }
}
