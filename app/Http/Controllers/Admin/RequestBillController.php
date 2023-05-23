<?php


namespace App\Http\Controllers\Admin;

use App\RequestBill;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Helper\Calculation;
use App\Models\Clients;
use App\User;
use Auth;
use Flash;
use Response;
class RequestBillController extends AppBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $job_estimate = \App\Models\JobEstimate::where('id',$id)->get()->toArray();
        $campaign_id = $job_estimate[0]['campaign_id'];
        $input['je_id'] = $id;
        $input['status'] = 'pending';
        $request_bill =  \App\RequestBill::create($input);
        return redirect(route('admin.job_estimate.index',[$campaign_id]));
        Flash::success('Bill requested successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        return view('request_bill.create',compact('id'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        $request->validate([
            'file' => 'required|mimes:jpeg,png,jpg',
        ]);
        $request_bill_id = $request->get('request_bill_id');
        $request_bill = \App\RequestBill::find($request_bill_id);
        if($request->file('file'))
        {
            $file = $request->file('file');
            $filename = date('ymdhis').$file->getClientOriginalName();
            $path = public_path().'/bills';
            $file->move($path,$filename);
            $request_bill->file = $filename;
        }
        $request_bill->status = 'account verified';
        $request_bill->save();
        Flash::success('Bill added successfully.');
        return redirect(route('admin.home'));
    }

    public function verify($id){
        $request_bill = \App\RequestBill::find($id);
        $job_estimate = \App\Models\JobEstimate::where('id',$request_bill->je_id)->get()->toArray();
        $campaign_id = $job_estimate[0]['campaign_id'];
        $request_bill->status = 'completed';
        $request_bill->save();
        return redirect(route('admin.job_estimate.index',[$campaign_id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RequestBill  $requestBill
     * @return \Illuminate\Http\Response
     */
    public function show(RequestBill $requestBill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RequestBill  $requestBill
     * @return \Illuminate\Http\Response
     */
    public function edit(RequestBill $requestBill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RequestBill  $requestBill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RequestBill $requestBill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RequestBill  $requestBill
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequestBill $requestBill)
    {
        //
    }

    public function client_bill_report(Request $request)
    {   

        $bills = RequestBill::orderBy('created_at','DESC');

        $bill_no = $request->get('bill_no');
        $je_no = $request->get('je_no');
        /*$client = $request->get('client');
        $cs = $request->get('cs');*/
        $status = $request->get('bill_status');

       if($je_no)
       {
            $bills->whereHas('job_estimate', function($query) use($je_no) {
                $query->where('je_name', '=', $je_no);
            });
       }
       if($bill_no)
       {
            $bills->where('bill_number',$bill_no);
       }
       if($status)
       {
             $bills->where('status',$status);
       }

        $bills = $bills->paginate(10);


        $je_bills = Calculation::get_total_all($bills);
        $clients = Clients::all();
        $cs= User::with('roles')->whereHas('roles', function($query) {
                 $query->where('title', '=', 'CS');
                })->get();


        return view('request_bill.report',compact('je_bills','clients','cs'));
    }
}
