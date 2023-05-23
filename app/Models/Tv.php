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
class Tv extends Model
{

    public $table = 'tv';
    


    public $fillable = [
        'television',
        'program',
        'position',
        'rate_type',
        'rate_per_minute',
        'rate_per_day',
        'rate_per_spot',
        'total_unit',
        'total_amount',
        'vendor_id',
        'je_id',
        'program_id',
        'rate_id',
        'is_sponsorship'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'television' => 'string',
        'program' =>'string',
        'vendor_id' => 'integer',
        'je_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'television' => 'required',
        'program' => 'required'
        
    ];


    public function dates()
    {
        return $this->hasMany('App\Models\JobDates','job_id','id')->where('table_name','tv');
    }

    public function discounts()
    {
        return $this->hasMany('App\Models\JobDiscount','job_id','id')->where('table_name','tv')->orderBy('sort_order','ASC');
    }

    public function programs()
    {
        return $this->hasMany('App\Models\Program','vendor_id','vendor_id');
    }

    public function positions()
    {
        return $this->hasMany('App\Models\ProgramRate','program_id','program_id');
    }
    
}
