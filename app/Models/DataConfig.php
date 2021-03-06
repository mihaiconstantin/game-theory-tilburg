<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed config
 */
class DataConfig extends Model
{

   protected $fillable = ['config'];


    /**
     * Relationship with parent DataParticipant.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function data_participant()
    {
        return $this->belongsTo('App\Models\DataParticipant');
    }
}
