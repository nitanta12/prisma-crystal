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
class Charges extends Model
{

    public $table = 'charges';
    


    public $fillable = [
        'charge_name',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'charge_name' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'charge_name' => 'required',
    ];

    
}
