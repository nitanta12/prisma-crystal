<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\AppBaseController;

use Auth;
use App\VendorBill;
use App\Helper\Calculation;
class VendorBillController extends Controller
{
    //
     public function index(){

    }
    public function create(){
    	$vendors = \App\Models\Vendors::all();

    	return view('vendor_bill.create',compact('vendors'));
    }
    public function store(Request $request){
        $requestdata = $request->all();
    	$user_id = Auth::user()->id;
    	$requestdata['user_id'] = $user_id;
    	if($request->file('file'))
        {
                $file = $request->file('file');

                $filename = date('ymdhis').$file->getClientOriginalName();
                $path = public_path().'/bills';
                $file->move($path,$filename);
                $requestdata['file'] = $filename;
        }

    	// dd($request->all());
    	$traffic = VendorBill::create($requestdata);
    	return redirect(url('/'));
    }
    public function show($id){
        $vendor_bill = VendorBill::find($id);
        return view('vendor_bill.show',compact('vendor_bill'));
    }
    public function edit($id){
        $vendors = \App\Models\Vendors::all();
        $vendor_bill = VendorBill::find($id);
        return view('vendor_bill.edit',compact('vendor_bill','vendors'));
    }
    public function update(Request $request,$id){
        $user_id = Auth::user()->id;
    	$vendor_bill = VendorBill::find($id);
        $vendor_bill->job_estimate_number = $request->get('job_estimate_number');
        $vendor_bill->bill_number = $request->get('bill_number');
        $vendor_bill->vendor = $request->get('vendor');
        $vendor_bill->bill_amount = $request->get('bill_amount');
        $vendor_bill->status = $request->get('status');
        $vendor_bill->remarks = $request->get('remarks');
        $vendor_bill->user_id = $user_id;

        if($request->file('file'))
        {

                unlink(public_path().'/bills/' . $vendor_bill->file);

                $file = $request->file('file');

                $filename = date('ymdhis').$file->getClientOriginalName();
                $path = public_path().'/bills';
                $file->move($path,$filename);
                $vendor_bill->file = $filename;
        }

        $vendor_bill->save();
    	return redirect(url('/'));
    }
    public function destroy(Request $request, $id){
        $vendor_bill = VendorBill::find($id);
        $vendor_bill->delete();
        return redirect(url('/'));
    }

    public function vendor_bills(Request $request)
    {   
       $bills = VendorBill::orderBy('created_at','DESC');

        $bill_no = $request->get('bill_no');
        $je_no = $request->get('je_no');
        /*$client = $request->get('client');
        $cs = $request->get('cs');*/
        $status = $request->get('bill_status');

       if($je_no)
       {
            $bills->where('job_estimate_number',$je_no);
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

        //dd($bills);

        foreach($bills as $bill)
        {
           $bill->je_info = Calculation::calculate_total_amount_vendor_only($bill->job_estimate_number,$bill->vendor);
        }

         return view('vendor_bill.report',compact('bills'));
    }

}
