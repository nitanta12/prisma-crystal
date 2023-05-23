<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class Clients
 * @package App\Models
 * @version October 20, 2019, 6:25 am UTC
 *
 * @property string client_name
 * @property string client_phone
 * @property string client_address
 * @property string client_company
 * @property string client_description
 * @property string client_email
 */
class Clients extends Model
{

    public $table = 'clients';
    


    public $fillable = [
        'client_name',
        'client_phone',
        'client_address',
        'client_brand',
        'client_description',
        'client_email',
        'representative'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'client_name' => 'string',
        'client_phone' => 'string',
        'client_address' => 'string',
        'client_brand' => 'string',
        'client_description' => 'string',
        'client_email' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'client_name' => 'required',
        'client_email' => 'email'
    ];    
}
