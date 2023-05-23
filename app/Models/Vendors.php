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
class Vendors extends Model
{

    public $table = 'vendors';
    


    public $fillable = [
        'vendor_name',
        'vendor_type',
        'vendor_phone',
        'vendor_address',
        'vendor_description',
        'is_media'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'vendor_name' => 'string',
        'vendor_type' => 'string',
        'vendor_phone' => 'string',
        'vendor_address' => 'string',
        'vendor_description' => 'string',
        'is_media' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'vendor_name' => 'required',
        'vendor_type' => 'required',
        
    ];

    public function traffic(){
        return $this->hasMany('App\Traffic');
    }
    
}
