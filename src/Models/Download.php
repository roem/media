<?php

namespace Roem\Media\Models;

use Roem\Media\Models\Relations\HasManyDownloadLog;
use Roem\Media\Models\Relations\MorphOneImage;
use Roem\Media\Models\Relations\MorphOneMedia;
use Roedel\Model\SoftDeletes;

class Download extends Model
{
    use SoftDeletes;
    use HasManyDownloadLog;
    use MorphOneMedia;
    use MorphOneImage;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roem_media_downloads';

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'slug' => 'string',
        'icon' => 'string',
        'description' => 'string',
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
        'icon',
        'description'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'downloadable_type',
        'downloadable_id',
    ];

    /**
     * Get the model the action has been taken on.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function downloadable()
    {
        return $this->morphTo()->withTrashed();
    }
}
