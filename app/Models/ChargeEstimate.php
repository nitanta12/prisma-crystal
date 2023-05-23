<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class Campaign
 * @package App\Models
 * @version October 22, 2019, 10:29 am UTC
 *
 * @property string campaign_name
 * @property integer client_id
 * @property string campaign_description
 */
class ChargeEstimate extends Model
{

    public $table = 'charge_estimate';
    


    public $fillable = [
        'charge_id',
        'je_id',
        'table_name',
        'charge_percentage',
        'charge_amount',
        'sort_order'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'je_id' => 'integer',
        'charge_id' => 'integer',
        'table_name' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'table_name' => 'required',
        'charge_id' => 'required',
    ];

    public function charges()
    {
        return $this->belongsTo('App\Models\Charges','charge_id','id');
    }
}
