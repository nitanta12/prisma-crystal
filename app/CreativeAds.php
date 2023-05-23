<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreativeAds extends Model
{
    //
    public $fillable = [
        'file',
        'file_name',
        'campaign_id'
    ];
}
