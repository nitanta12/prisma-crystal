<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestBill extends Model
{
    //
    protected $table = 'job_estimate_bills';
    public $fillable = [
    	'je_id',
    	'status',
        'file',
        'bill_number',
        'remarks',
        'total_amount'
    ];

    public function job_estimate(){
    	return $this->belongsTo('App\Models\JobEstimate','je_id');
    }
}
