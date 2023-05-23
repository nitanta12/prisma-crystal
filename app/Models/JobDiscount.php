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
class JobDiscount extends Model
{

    public $table = 'job_discount';
    


    public $fillable = [
        'discount_id',
        'job_id',
        'table_name',
        'discount_percentage',
        'discount_amount',
        'sort_order',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'job_id' => 'integer',
        'discount_id' => 'integer',
        'table_name' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'table_name' => 'required',
        'discount_id' => 'required',
    ];

    public function discounts()
    {
        return $this->belongsTo('App\Models\Discounts','discount_id','id');
    }
}
