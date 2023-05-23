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
class JobEstimate extends Model
{

    public $table = 'job_estimate';



    public $fillable = [
        'campaign_id',
        'table_type',
        'je_name',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'campaign_id' => 'integer',
        'table_type' => 'string',


    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'campaign_id' => 'required',

    ];

    public function charges()
    {
        return $this->hasMany('App\Models\ChargeEstimate','je_id','id')->orderBy('sort_order','ASC');
    }
    public function request_bills(){
        return $this->hasOne('App\RequestBill','je_id','id');
    }

    public function campaign()
    {
        return $this->belongsTo('App\Models\Campaign');
    }

}
