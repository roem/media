<?php

namespace Roem\Media\Commands;

use Carbon\Carbon;
use Config;
use File;
use Roem\Media\Models\Image;
use Image as Intervention;

class CreateThumbnailsCommand
{
    public function fire($job, $id)
    {
        $image = Image::findOrFail($id);
        $imageable = strtolower(class_basename($image->imageable));
        $sizes = Config::get("roem/media::images.thumbs.{$imageable}.sizes");

        $publicBasePath = Config::get('roem/media::images.paths.public');

        $storageFile = storage_path("{$image->media->path}/{$image->media->filename}");
        $publicPath = public_path("{$publicBasePath}/{$image->id}");

        if (!File::isDirectory($publicPath)) {
            File::makeDirectory($publicPath, 0775, true);
        }

        foreach ($sizes as $size) {
            $resize = Intervention::make($storageFile);
            $resize->widen($size);
            if (Config::get('roem/media::image.debug')) {
                $resize->text($resize->width().' x '.$resize->height(), $resize->width() / 2, $resize->height() / 2, function ($font) use ($resize) {
                    $font->file(storage_path('fonts/OpenSans-Regular.ttf'));
                    $font->size($resize->height() / 5);
                    $font->color('#ff0000');
                    $font->align('center');
                    $font->valign('middle');
                    $font->angle(0);
                });
            }
            $resizeName = "{$publicPath}/{$size}.{$image->media->filename}";
            $resize->save($resizeName);
        }

        $image->resized_at = Carbon::now();
        $image->save();

        $job->delete();
    }
}
