<?php

namespace Roem\Media\Models\Relations;

trait BelongsToDownload
{
    /**
     * Get the download relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function download()
    {
        return $this->belongsTo('Roem\Media\Models\Download');
    }
}
