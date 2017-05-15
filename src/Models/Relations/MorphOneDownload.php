<?php

namespace Roem\Media\Models\Relations;

trait MorphOneDownload
{
    use MorphOneOrManyDownload;

    /**
     * Get the download relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function download()
    {
        return $this->morphOne('Roem\Media\Models\Download', 'downloadable');
    }
}
