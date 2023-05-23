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
class Magazine extends Model
{

    public $table = 'magazine';
    


    public $fillable = [
        'publication',
        'size',
        'break',
        'position',
        'color_type',
        'rate_per_cc',
        'inc',
        'amount',
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
        'publication' => 'string',
        'vendor_id' => 'integer',
        'je_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'publication' => 'required',
        
    ];


    public function dates()
    {
        return $this->hasMany('App\Models\JobDates','job_id','id')->where('table_name','magazine');
    }

    public function discounts()
    {
        return $this->hasMany('App\Models\JobDiscount','job_id','id')->where('table_name','magazine')->orderBy('sort_order','ASC');
    }
    
}
