<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Traffic extends Model
{
    //
    public $fillable = [
    	'job_estimate_number',
    	'bill_number',
    	'vendor',
    	'bill_amount',
    	'status',
    	'user_id',
    	'remarks'
    ];
    public function vendors(){
    	return $this->belongsTo('App\Models\Vendors','vendor');
    }
}
