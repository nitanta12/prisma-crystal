<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class TrafficController extends Controller
{
    //

    public function index(){

    }
    public function create(){
    	$vendors = \App\Models\Vendors::all();

    	return view('vendor_bill.create',compact('vendors'));
    }
    public function store(Request $request){
    	$user_id = Auth::user()->id;
    	$request['user_id'] = $user_id;
    	unset($request['_token']);
    	// dd($request->all());
    	$traffic = \App\Traffic::create($request->all());
    	return redirect(url('/'));
    }

}
