<?php

namespace App\Http\Controllers\Admin;
use App\Models\Clients;
use App\Models\ClientUsers;
use App\Models\Campaign;
use App\Helper\Calculation;
use App\RequestBill;
use Auth;

class HomeController
{
    public function dashboard()
    {
    	if(Auth::user()->roles[0]->title == 'Admin')
    	{
        	return view('dashboards.admin');

    	}
    	elseif(Auth::user()->roles[0]->title == 'CS')
    	{
    		$user_id = Auth::user()->id;

    		$clients = ClientUsers::join('clients','client_users.client_id','=','clients.id')->where('client_users.user_id','=',$user_id)->get();

    		foreach($clients as $c)
    		{
    			$c->total_campaigns = Campaign::where('client_id',$c->id)->count();
    		}

    		return view('dashboards.cs',compact('clients'));

        }
        elseif (Auth::user()->roles[0]->title == 'Traffic') {
            $vendor_bills = \App\VendorBill::all();
            return view('dashboards.traffic',compact('vendor_bills'));
        }
        elseif (Auth::user()->roles[0]->title == 'Creative') {
            $creative_briefs = \App\Models\CreativeBrief::where('creative_user_id',Auth::user()->id)->get();
            return view('dashboards.creative',compact('creative_briefs'));
        }
        elseif (Auth::user()->roles[0]->title == 'Executive') {
            $je_bills = RequestBill::orderBy('created_at','DESC')->paginate(10);
            $je_bills = Calculation::get_total_all($je_bills);

            return view('dashboards.executive',compact('je_bills'));
        }

    }





}
