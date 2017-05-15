<?php

namespace Roem\Media\Http\Controllers;

use Spatie\Glide\Controller\GlideImageController;
use Spatie\Glide\GlideApiFactory;

class ImageController extends GlideImageController
{
    /**
     * Output a generated Glide-image.
     */
    public function index()
    {
        $this->validateSignature();

        $this->writeIgnoreFile();

        $api = GlideApiFactory::create();

        $server = $this->setGlideServer($this->setImageSource(), $this->setImageCache(), $api);

        $server->outputImage($this->request->getPathInfo(), $this->request->all());
    }
}
