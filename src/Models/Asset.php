<?php

namespace Roem\Media\Models;

use Roem\Media\Models\Relations\MorphOneMedia;
use Roedel\Model\SoftDeletes;

class Asset extends Model
{
    use MorphOneMedia;
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roem_media_assets';

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'slug' => 'string',
        'description' => 'string'
    ];

    /**
     * The properties on the model that are dates.
     *
     * @var array
     */
    protected $dates = [
        'published_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * The attributes for mass-assignment.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'description'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'assetable_type',
        'assetable_id'
    ];

    /**
     * Get the model the action has been taken on.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function assetable()
    {
        return $this->morphTo();
    }
}
