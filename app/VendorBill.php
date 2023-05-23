<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorBill extends Model
{
    //
    public $fillable = [
    	'job_estimate_number',
    	'bill_number',
    	'vendor',
    	'bill_amount',
    	'status',
    	'user_id',
    	'remarks',
        'file'
    ];
    public function vendors(){
    	return $this->belongsTo('App\Models\Vendors','vendor');
    }
    public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
