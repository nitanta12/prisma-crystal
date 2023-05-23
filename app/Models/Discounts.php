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
class Discounts extends Model
{

    public $table = 'discounts';
    


    public $fillable = [
        'discount_name',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'discount_name' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'discount_name' => 'required',
    ];

    
}
