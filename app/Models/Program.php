<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class Program
 * @package App\Models
 * @version December 5, 2019, 5:38 am UTC
 *
 * @property string program_name
 * @property integer vendor_id
 */
class Program extends Model
{

    public $table = 'programs';
    


    public $fillable = [
        'program_name',
        'vendor_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'program_name' => 'string',
        'vendor_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'program_name' => 'required',
        'vendor_id' => 'required'
    ];


    public function vendors()
    {
        return $this->belongsTo('App\Models\Vendors','vendor_id','id');
    }

    public function rates()
    {
        return $this->hasMany('App\Models\ProgramRate','program_id','id');
    }
    
}
