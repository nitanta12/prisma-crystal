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
class OnlinePortal extends Model
{

    public $table = 'online_portal';
    


    public $fillable = [
        'portal_name',
        'category',
        'cost_per_month',
        'duration',
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
        'portal_name' => 'string',
        'vendor_id' => 'integer',
        'je_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'portal_name' => 'required',
        
    ];
    public function discounts()
    {
        return $this->hasMany('App\Models\JobDiscount','job_id','id')->where('table_name','online_portal')->orderBy('sort_order','ASC');
    }
    
}
