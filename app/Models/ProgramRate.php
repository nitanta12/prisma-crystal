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
class ProgramRate extends Model
{

    public $table = 'program_rates';
    


    public $fillable = [
        'program_id',
        'position',
        'rate_per_day',
        'rate_per_minute',
        'rate_per_spot',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'position' => 'string',
        'program_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'program_id' => 'required',
        'position' => 'required'
    ];


    public function program()
    {
        return $this->belongsTo('App\Models\Program','program_id','id');
    }
    
}
