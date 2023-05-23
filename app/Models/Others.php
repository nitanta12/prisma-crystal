<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class vendors
 * @package App\Models
 * @version November 4, 2019, 8:54 am UTC
 *
 * @property string vendor_name
 * @property string vendor_type
 * @property string vendor_phone
 * @property string vendor_address
 * @property string vendor_description
 */
class Others extends Model
{

    public $table = 'others';
    


    public $fillable = [
        'description',
        'quantity',
        'rate',
        'total_amount',
        'vendor_id',
        'je_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'description' => 'string',
        'vendor_id' => 'integer',
        'je_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'description' => 'required',  
    ];

    public function discounts()
    {
        return $this->hasMany('App\Models\JobDiscount','job_id','id')->where('table_name','others')->orderBy('sort_order','ASC');
    }

    
}
