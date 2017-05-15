<?php

namespace Roem\Media\Models;

class Media extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roem_media_medias';
    
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'path' => 'string',
        'filename' => 'string',
        'extension' => 'string',
        'mimeType' => 'string',
        'size' => 'integer'
    ];
    
    /**
     * The properties on the model that are dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes for mass-assignment.
     *
     * @var array
     */
    protected $fillable = [
        'path',
        'filename',
        'extension',
        'mimeType',
        'size'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'mediaable_type', 
        'mediaable_id'
    ];
    
    /**
     * Get the model the action has been taken on.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function mediaable()
    {
        return $this->morphTo();
    }
}
