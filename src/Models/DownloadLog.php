<?php

namespace Roem\Media\Models;

use Roem\Media\Models\Relations\BelongsToDownload;
use Request;

class DownloadLog extends Model
{
    use BelongsToDownload;

    protected $revisionEnabled = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roem_media_download_logs';

    /**
     * The properties on the model that are dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes for mass-assignment.
     *
     * @var array
     */
    protected $fillable = ['ip_address'];

    /**
     * The "booting" method of the model.
     */
    protected static function boot()
    {
        parent::boot();

        /**
         * Attach to the 'creating' Model Event to provide the IP-Address
         * for the `id` field (provided by $model->getKeyName()).
         */
        static::creating(function ($model) {
            $model->ip_address = $model->ip_address ? $model->ip_address : Request::getClientIp();
        });
    }

    public function getIpAddressAttribute($value)
    {
        return inet_ntop($value);
    }

    public function setIpAddressAttribute($value)
    {
        $this->attributes['ip_address'] = inet_pton($value);
    }
}
