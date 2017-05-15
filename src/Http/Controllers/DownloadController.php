<?php

namespace Roem\Media\Http\Controllers;

use BaseController;
use Event;
use Roem\Media\Models\Download;
use Redirect;
use Response;
use Session;
use Symfony\Component\HttpFoundation\File\File as SymfonyFile;
use Whitelabel;

class DownloadController extends BaseController
{
    public function getFile($slug)
    {
        $downloads = Download::with('downloadable', 'downloadable.whitelabel', 'downloadable.whitelabel.domain')
            ->where('slug', '=', $slug)
            ->get();

        foreach ($downloads as $download) {
            if ($download->downloadable->whitelabel->domain->hostname === Whitelabel::hostname()) {
                if (Session::get('route.last') && !$download->downloadable->trashed()) {
                    $file = storage_path("{$download->media->path}/{$download->media->filename}");
                    $loadedFile = new SymfonyFile($file);

                    $extension = $loadedFile->getExtension();
                    $filename = "{$download->slug}.{$extension}";

                    Event::fire('download.downloaded', $download);

                    return Response::download($file, $filename);
                } elseif ($download->downloadable->trashed()) {
                    return Redirect::route('home');
                }
            }
        }

        return Redirect::route('home');
    }
}
