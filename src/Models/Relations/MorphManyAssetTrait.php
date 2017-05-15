<?php

namespace Roem\Media\Models\Relations;

trait MorphManyAssetTrait
{
    /**
     * Get the asset relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function assets()
    {
        return $this->morphMany('Roem\Media\Models\Asset', 'assetable');
    }
}
