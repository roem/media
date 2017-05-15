<?php

namespace Roem\Media\Console\Commands;

use Config;
use File;
use Roem\Media\Models\Image;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class DeleteImageCacheCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'media:image:cache:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh the Image-Cache in /public/images/temp';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        try {
            $images = Image::all();
            $countImages = count($images);

            $check = $this->option('force') ? $this->option('force') : $this->confirm('Refresh Thumbnails for '.$countImages.' Images? [yes|no]');

            if ($check) {
                foreach ($images as $image) {
                    $publicBasePath = Config::get('roem/media::images.paths.public');
                    $publicPath = public_path("{$publicBasePath}/{$image->id}");

                    if ($this->option('delete')) {
                        File::deleteDirectory($publicPath);
                    }

                    $image->resized_at = null;
                    $image->save();
                }
            }
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['delete', null, InputOption::VALUE_NONE, 'Delete old Images'],
            ['force', null, InputOption::VALUE_NONE, 'Force the operation.'],
        ];
    }
}
