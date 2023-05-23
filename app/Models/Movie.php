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
class Movie extends Model
{

    public $table = 'movie';
    


    public $fillable = [
        'movie_theatre',
        'auditorium',
        'total_show',
        'seat_capacity',
        'weekend_occ',
        'weekday_occ',
        'duration',
        'position',
        'rate_per_month',
        'vendor_id',
        'je_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'movie_theatre' => 'string',
        'vendor_id' => 'integer',
        'je_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'movie_theatre' => 'required',  
    ];

    public function discounts()
    {
        return $this->hasMany('App\Models\JobDiscount','job_id','id')->where('table_name','movie')->orderBy('sort_order','ASC');
    }

    
}
