<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\JobEstimate;
use App\Models\OnlinePortal;
use App\Models\Vendors;
use App\Models\Others;
use App\Models\NationalDaily;
use App\Models\JobDates;
use App\Models\Discounts;
use App\Models\JobDiscount;
use App\Models\Charges;
use App\Models\ChargeEstimate;
use App\Models\Magazine;
use App\Models\LocalNewspaper;
use App\Models\Tv;
use App\Models\Radio;
use App\RequestBill;
use App\Models\Program;
use App\Models\ProgramRate;
use App\Models\Movie;
use DateInterval;
use DateTime;
use DatePeriod;
use DB;
use Flash;
use Response;
use Auth;

class JobEstimateController extends AppBaseController
{

    /**
     * Display a listing of the Clients.
     *
     * @param Request $request
     *
     * @return Response
     */

    public function index($campaign_id)
    {

       $campaign = Campaign::find($campaign_id);

       $job_estimate = JobEstimate::where('campaign_id',$campaign_id)->orderBy('created_at','DESC')->get();

        return view('job_estimate.index',compact('campaign','job_estimate'));
    }

    public function create(Request $request)
    {
    	$request = $request->all();

        # --------------------------------------------
        # job estimate id now has following format:
        # useriD-timestamp-campaignId-tableTypeName
        # --------------------------------------------

        $user_id = Auth::user()->id;
        $now = \Carbon\Carbon::now()->timestamp;
        $request['je_name'] = $user_id . '-' .  $now . '-' . $request['campaign_id'] . '-' . $request['table_type'];

    	JobEstimate::create($request);

    	Flash::success('Job Estimate created successfully.');

        return redirect(route('admin.job_estimate.index',$request['campaign_id']));

    }

    public function delete($id)
    {

        $national_daily = NationalDaily::where('je_id',$id)->get();
        $online_portal = OnlinePortal::where('je_id',$id)->get();
        $others = Others::where('je_id',$id)->get();

        //dd($others);
        $job_estimate = JobEstimate::find($id);

        if( ($national_daily->count() != 0) || ($online_portal->count() != 0) || ($others->count() != 0) )
        {
            Flash::error('Some of the jobs are not deleted.');
        }
        else
        {
            $job_estimate->delete();
            ChargeEstimate::where('je_id',$id)->delete();
            Flash::success('Job Estimate Deleted successfully.');

        }

        return redirect(route('admin.job_estimate.index',$job_estimate->campaign_id));
    }

    public function jobs($table_name,$id)
    {
    	$job_estimate = JobEstimate::find($id);

        $discounts = Discounts::all();

        $charges = Charges::all();

        $programs = collect();

    	$vendors = Vendors::where('vendor_type','=',$table_name)->get();
    	if($table_name == 'online_portal')
    	{
    		$jobs = OnlinePortal::where('je_id',$id)->get();
    	}
    	else if($table_name =='others')
    	{
    		$jobs = Others::where('je_id',$id)->get();
    	}
        else if($table_name == 'national_daily')
        {
            $jobs = NationalDaily::where('je_id',$id)->get();
        }
        else if($table_name == 'magazine')
        {
            $jobs = Magazine::where('je_id',$id)->get();
        }
        else if($table_name == 'local_newspaper')
        {
            $jobs = LocalNewspaper::where('je_id',$id)->get();
        }
        else if($table_name == 'movie')
        {
            $jobs = Movie::where('je_id',$id)->get();
        }
        else if($table_name == 'tv' || $table_name =='radio')
        {

            if($table_name == 'tv')
            {
                $jobs = Tv::where('je_id',$id)->get();
                $programs = Program::whereHas('vendors', function($query) {
                            $query->where('vendor_type', '=', 'tv');
                        })->get();
            }
            else if($table_name == 'radio')
            {
                $jobs = Radio::where('je_id',$id)->get();
                 $programs = Program::whereHas('vendors', function($query) {
                            $query->where('vendor_type', '=', 'radio');
                        })->get();

            }
        }

    	return view('jobs.'. $table_name,compact('job_estimate','vendors','jobs','discounts','charges','programs'));
    }

    public function delete_jobs_ajax($id,$table_name)
    {
    	 DB::table($table_name)->where('id',$id)->delete();
         JobDiscount::where('job_id',$id)->delete();
         JobDates::where('job_id',$id)->delete();
    }

    public function create_jobs(Request $request)
    {
    	$request = $request->all();

    	if(isset($request['vendor_id']))
    	{
    		$vendor_id = $request['vendor_id'];
    	}
    	else
    	{
    		$vendor_id = 0;
    	}

    	$vendor = Vendors::find($vendor_id);



    	//create for online portal
    	if($vendor)
    	{
    		$table = $vendor->vendor_type;
    		$request['vendor_id'] = $vendor_id;

	    	if($vendor->vendor_type == 'online_portal')
	    	{
		    	$request['portal_name'] = $vendor->vendor_name;
		    	$job = OnlinePortal::create($request);
	    	}
            elseif($vendor->vendor_type == 'national_daily')
            {
                $request['publication'] = $vendor->vendor_name;
                $job = NationalDaily::create($request);
            }
            elseif($vendor->vendor_type == 'magazine' )
            {
                 $request['publication'] = $vendor->vendor_name;
                 $job = Magazine::create($request);
            }
            elseif($vendor->vendor_type == 'local_newspaper')
            {
                $request['publication'] = $vendor->vendor_name;
                $job = LocalNewspaper::create($request);
            }
            elseif($vendor->vendor_type == 'movie')
            {
                $request['movie_theatre'] = $vendor->vendor_name;
                $job = Movie::create($request);
            }
             elseif($vendor->vendor_type == 'tv')
            {
                $request['television'] = $vendor->vendor_name;
                $position = ProgramRate::find($request['position']);
                $request['program_id'] = $request['program'];
                $request['rate_id'] = $request['position'];
                $request['program'] = $position->program->program_name;
                $request['position'] = $position->position;
                $job = Tv::create($request);
            }
            elseif($vendor->vendor_type == 'radio')
            {
                $request['station'] = $vendor->vendor_name;
                $position = ProgramRate::find($request['position']);
                $request['program_id'] = $request['program'];
                $request['rate_id'] = $request['position'];
                $request['program'] = $position->program->program_name;
                $request['position'] = $position->position;
                $job = Radio::create($request);
            }

            if(isset($request['dates']))
            {
                $this->process_tv_radio_date($job->id,$request['dates'],$vendor->vendor_type);
            }

            if(isset($request['date_from_to']))
            {

                $this->process_date($job->id,$request['date_from_to'],$vendor->vendor_type);
            }

            if(isset($request['discount_array']))
            {
                 $this->process_discount($job->id,$request['discount_array'],$vendor->vendor_type);
            }
    	}
    	else
    	{
    		$table = 'others';
    		$request['vendor_id'] = $vendor_id;
    		$job = Others::create($request);

            if(isset($request['discount_array']))
            {
                 $this->process_discount($job->id,$request['discount_array'],'others');
            }

    	}

    	Flash::success('Job Added successfully.');

        return redirect(route('admin.job_estimate.jobs',['template' => $table,'id' => $request['je_id'] ] ));
    }

    public function update_jobs_ajax(Request $request,$id,$table_name)
    {
    	$request = $request->all()['data'];
        unset($request['_token']);

		if($table_name == 'online_portal')
		{
			OnlinePortal::where('id',$id)->update($request);
		}
        if($table_name =='national_daily')
        {
            NationalDaily::where('id',$id)->update($request);
        }
        if($table_name == 'magazine')
        {
            Magazine::where('id',$id)->update($request);
        }
        if($table_name == 'local_newspaper')
        {
            LocalNewspaper::where('id',$id)->update($request);
        }
        if($table_name == 'tv')
        {
            Tv::where('id',$id)->update($request);
        }
        if($table_name == 'radio')
        {
            Radio::where('id',$id)->update($request);
        }
        if($table_name == 'movie')
        {
            Movie::where('id',$id)->update($request);
        }
		if($table_name == 'others')
		{
			Others::where('id',$id)->update($request);
		}

    	echo true;
    }

    public function jobs_print($id,$table_name)
    {
    	$job_estimate = JobEstimate::find($id);

    	$campaign = Campaign::join('clients','clients.id','=','campaigns.client_id')->find($job_estimate->campaign_id);

    	if($table_name == 'online_portal')
    	{
    		$jobs = OnlinePortal::where('je_id',$id)->get();
    	}
        elseif($table_name == 'national_daily')
        {
            $jobs = NationalDaily::where('je_id',$id)->get();
        }
        elseif($table_name == 'magazine')
        {
            $jobs = Magazine::where('je_id',$id)->get();
        }
        elseif($table_name == 'local_newspaper')
        {
            $jobs = LocalNewspaper::where('je_id',$id)->get();
        }
        elseif($table_name == 'tv')
        {
            $jobs = Tv::where('je_id',$id)->get();
        }
        elseif($table_name == 'radio')
        {
            $jobs = Radio::where('je_id',$id)->get();
        }
         elseif($table_name == 'movie')
        {
            $jobs = Movie::where('je_id',$id)->get();
        }
    	else
    	{
    		$jobs = Others::where('je_id',$id)->get();
    	}


        foreach($jobs as $j)
        {

            if(isset($j->dates))
            {

              $vendor = vendors::find($j->vendor_id);
              if($vendor->vendor_type == 'tv' || $vendor->vendor_type == 'radio')
              {
                $months =  $this->group_date_month_tv_radio($j->dates);
              }
              else
              {
                $months =  $this->group_date_month($j->dates);
              }

                $j->months = $months;
            }
        }


    	return view('job_estimate.print_'. $table_name,compact('job_estimate','jobs','campaign'));
    }

    public function process_tv_radio_date($id,$date_array,$table_name)
    {
        $insert_array = [];
        $insert_array['job_id'] = $id;
        $insert_array['table_name'] = $table_name;


        foreach($date_array as $da)
        {
            $date = explode('-',$da['date']);
            $date_from = $date[0];
            $date_to = $date[1];

            $insert_array['date_from'] = date("Y-m-d", strtotime($date_from));
            $insert_array['date_to'] = date("Y-m-d", strtotime($date_to));
            $insert_array['spots'] = $da['spot'];

            JobDates::create($insert_array);
        }
    }

    public function process_date($id,$date_array,$table_name)
    {
        $insert_array = [];
        $insert_array['job_id'] = $id;
        $insert_array['table_name'] = $table_name;
        $date_array = explode(',',$date_array);

        foreach($date_array as $da)
        {
            $insert_array['date_from'] = date("Y-m-d", strtotime($da));
            $insert_array['date_to'] = date("Y-m-d", strtotime($da));
            JobDates::create($insert_array);
        }
    }

    public function process_discount($job_id,$discount_array,$table_name)
    {

        foreach($discount_array as $key=>$da)
        {
          if($da[0])
          {
                $insert_array= [];
                $insert_array['discount_id'] = $key;
                $insert_array['job_id'] = $job_id;
                $insert_array['table_name'] = $table_name;
                $insert_array['discount_percentage'] = $da[0];
                JobDiscount::create($insert_array);

          }
        }

    }

    public function process_charges(Request $request)
    {
        $request = $request->all();
        $je_id = $request['je_id'];
        $table_name = $request['table_name'];

        if(isset($request['charge_array']))
        {
             $charge_array = $request['charge_array'];

             foreach($charge_array as $key=>$da)
            {
                  if($da[0] || $da[1])
                  {
                        $insert_array= [];
                        $insert_array['charge_id'] = $key;
                        $insert_array['je_id'] = $je_id;
                        $insert_array['table_name'] = $table_name;
                        $insert_array['charge_percentage'] = $da[0];
                        $insert_array['charge_amount'] = $da[1];
                        ChargeEstimate::create($insert_array);
                  }
            }
        }


        Flash::success('Charges updated successfully.');

        return back();
    }

    public function update_date(Request $request)
    {
        $request = $request->all();

        $job_id = $request['job_id'];

        if(isset($request['dates']))
        {
            $dates = $request['dates'];

            $this->process_date($job_id,$dates,$request['table_name']);

            Flash::success('Dates updated successfully.');
        }
        else
        {
            Flash::error('No any date added.');
        }
        return back();

    }
    public function update_discount(Request $request)
    {
        $request = $request->all();

         $job_id = $request['job_id'];
        if(isset($request['discount_array']))
        {
            $date_array = $request['discount_array'];
            $table_name = $request['table_name'];
           $this->process_discount($job_id,$date_array,$table_name);

            Flash::success('Discount updated successfully.');
        }
        else
        {
            Flash::error('No any discount checked.');
        }
        return back();
    }

    public function delete_date_ajax(Request $request,$id)
    {
        JobDates::where('id',$id)->delete();
    }

    public function delete_discount_ajax(Request $request,$id)
    {
        JobDiscount::where('id',$id)->delete();
        echo true;
    }

    public function delete_charge_ajax(Request $request,$id)
    {
        ChargeEstimate::where('id',$id)->delete();
        echo true;
    }

    public function update_discount_charge_order(Request $request,$table_name)
    {
            $request = $request->all();

             $items = $request['items'];

            parse_str($items, $params);



            foreach($params['item'] as $key=>$pa)
            {
                if($table_name == 'job_discount')
                {
                    $jd = JobDiscount::find($pa);
                    $jd->sort_order = $key;
                    $jd->save();
                }
                else
                {
                    $ce = ChargeEstimate::find($pa);
                    $ce->sort_order = $key;
                    $ce->save();
                }
            }

    }

    public function group_date_month($dates)
    {
        $months = [];

        foreach($dates as $d)
        {
            $timestamp = strtotime($d->date_from);
            $month = date('F Y',$timestamp);
            $day = date('j',$timestamp);


            if (empty($months[$month])) {
                  $months[$month] = array();
            }

            $months[$month][] = $day;
        }

        $final_months = [];

        if(($months))
        {
            foreach($months as $key=>$m)
            {
                 $timestamp = strtotime($key);

                 $month_in_no = date('m',$timestamp);

                 $year_in_no = date('Y',$timestamp);

                 $dayofweek = date('w', strtotime($timestamp));

                 $total_days = cal_days_in_month(CAL_GREGORIAN, $month_in_no, $year_in_no);

                for($i=1;$i<=$total_days;$i++)
                {
                   $dayofweek = date("D", mktime(0, 0, 0,$month_in_no, $i, $year_in_no));

                    $final_months[$key][$i]['weekday']= $dayofweek;
                    $final_months[$key][$i]['day']= '';

                    if(in_array($i, $m))
                    {
                        $final_months[$key][$i]['weekday']= $dayofweek;
                        $final_months[$key][$i]['day']= $i;
                    }

                }
            }
        }

        return $final_months;
    }

    public function add_bill(Request $request){

        $id =  $request->get('je_id');
        // dd($id);

        $input['je_id'] = $id;
        $input['status'] = $request->get('status');
        $input['remarks'] = $request->get('remarks');
        $input['bill_number'] = $request->get('bill_number');
        $input['total_amount'] = $request->get('total_amount');

        $request->validate([
            'bill' => 'required|mimes:jpeg,png,jpg,pdf,doc,docx,zip',
        ]);

        if($request->file('bill')){
            $file = $request->file('bill');
            $filename = date('ymdhis').$file->getClientOriginalName();
            $path = public_path().'/bills';
            $file->move($path,$filename);
            $input['file'] = $filename;
            //dd($input);
            $job_estimate_bill = RequestBill::create($input);
            Flash::success('Bill added successfully.');
        }else{
            Flash::success('Bill add failed.');
        }
        return back();
    }
    public function update_bill(Request $request,$id){
        $job_estimate_bill = RequestBill::find($id);
        $job_estimate_bill->bill_number = $request->get('bill_number');
        $job_estimate_bill->status = $request->get('status');
        $job_estimate_bill->total_amount = $request->get('total_amount');
        $job_estimate_bill->remarks = $request->get('remarks');
        $job_estimate_bill->je_id = $request->get('je_id');
        if($request->file('bill')){
            $file = $request->file('bill');
            $filename = date('ymdhis').$file->getClientOriginalName();
            $path = public_path().'/bills';
            $file->move($path,$filename);
            $job_estimate_bill->file = $filename;
        }
        if($job_estimate_bill->save()){
            Flash::success("bill updated succesfully");
            return back();
        }else{
            Flash::success("bill updated failed");
            return back();
        }

    }

    public function group_date_month_tv_radio($dates)
    {
        $months = [];
        $all_dates = [];

        foreach($dates as $key=>$d)
        {
            $all_dates[$key]['dates'] = $this->getDatesFromRange($d->date_from, $d->date_to);
            $all_dates[$key]['spots'] = $d->spots;
        }


        foreach($all_dates as $d)
        {
            foreach($d['dates'] as $ikey=>$dd)
            {
                $timestamp = strtotime($dd);
                $month = date('F Y',$timestamp);
                $day = date('j',$timestamp);

                if (empty($months[$month])) {
                      $months[$month] = array();
                }

                 $months[$month][$day]['day'] = $day;
                 $months[$month][$day]['spots'] = $d['spots'];
            }
        }
       //dd($months);
        $final_months = [];

        if(($months))
        {
            foreach($months as $key=>$m)
            {

                 $timestamp = strtotime($key);

                 $month_in_no = date('m',$timestamp);

                 $year_in_no = date('Y',$timestamp);

                 $dayofweek = date('w', strtotime($timestamp));

                 $total_days = cal_days_in_month(CAL_GREGORIAN, $month_in_no, $year_in_no);

                for($i=1;$i<=$total_days;$i++)
                {
                   $dayofweek = date("D", mktime(0, 0, 0,$month_in_no, $i, $year_in_no));

                    $final_months[$key][$i]['weekday']= $dayofweek;
                    $final_months[$key][$i]['day']= '';

                    if(isset($m[$i]))
                    {
                        $final_months[$key][$i]['weekday']= $dayofweek;
                        $final_months[$key][$i]['day']= $m[$i]['spots'];
                    }

                }
            }
        }

        return $final_months;

    }

    public function getDatesFromRange($start, $end, $format = 'Y-m-d') {
        $array = array();
        $interval = new DateInterval('P1D');

        $realEnd = new DateTime($end);
        $realEnd->add($interval);

        $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

        foreach($period as $date) {
            $array[] = $date->format($format);
        }

        return $array;
    }

    public function update_tv_radio(Request $request,$table_type)
    {
        $request = $request->all();
       
        $vendor = Vendors::find($request['vendor_id']);
        if($table_type == 'tv')
        {
            $request['television'] = $vendor->vendor_name;
        }
        else
        {
            $request['station'] = $vendor->vendor_name;
        }
        $position = ProgramRate::find($request['position']);
        $request['program_id'] = $request['program'];
        $request['rate_id'] = $request['position'];
        $request['program'] = $position->program->program_name;
        $request['position'] = $position->position;


        $job_id = $request['job_id'];
        if(isset($request['dates']))
        {
            $dates = $request['dates'];
        }
        else
        {
            $dates = [];
        }

        unset($request['job_id']);
        unset($request['_token']);
        unset($request['dates']);

        if($table_type  == 'tv')
        {
            Tv::where('id', $job_id)->update($request);
        }
        elseif($table_type == 'radio')
        {
            Radio::where('id', $job_id)->update($request);
        }

        JobDates::where('job_id', $job_id)->delete();

        if($dates)
        {
            $this->process_tv_radio_date($job_id,$dates,$vendor->vendor_type);
        }

         Flash::success('Charges updated successfully.');

         return back();
    }


}
