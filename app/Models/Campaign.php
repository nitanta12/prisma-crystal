<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class Campaign
 * @package App\Models
 * @version October 22, 2019, 10:29 am UTC
 *
 * @property string campaign_name
 * @property integer client_id
 * @property string campaign_description
 */
class Campaign extends Model
{

    public $table = 'campaigns';
    


    public $fillable = [
        'campaign_name',
        'client_id',
        'campaign_description',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'campaign_name' => 'string',
        'client_id' => 'integer',
        'campaign_description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'campaign_name' => 'required',
        'client_id' => 'required'
    ];


    public function client()
    {
        return $this->belongsTo('App\Models\Clients');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
}
