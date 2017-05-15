<?php

namespace Roem\Media\Models\Relations;

trait HasManyDownloadLog
{
    /**
     * Get the downloadLog relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function downloadLog()
    {
        return $this->hasMany('Roem\Media\Models\DownloadLog');
    }
}
