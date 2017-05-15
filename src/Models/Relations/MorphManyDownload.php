<?php

namespace Roem\Media\Models\Relations;

trait MorphManyDownload
{
    use MorphOneOrManyDownload;

    /**
     * Get the download relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function downloads()
    {
        return $this->morphMany('Roem\Media\Models\Download', 'downloadable');
    }
}
