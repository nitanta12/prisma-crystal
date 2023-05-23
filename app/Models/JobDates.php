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
class JobDates extends Model
{

    public $table = 'job_dates';
    


    public $fillable = [
        'id',
        'job_id',
        'date_from',
        'date_to',
        'table_name',
        'spots'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'job_id' => 'string',
        
        
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];

    
}
