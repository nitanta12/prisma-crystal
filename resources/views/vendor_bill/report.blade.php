
@extends('layouts.admin')

@section('content')
    
<div class="card">

    <div class="card-header">
        <span>Vendor Bills</span>
       
    </div>
    <div class="content">
        <div class="clearfix"></div>

        <br/>
                <form action = "">
                    <div class="form-row">
                        <div class="col">
                          <input type="text" class="form-control" name="bill_no" placeholder="Bill No." value="{{request('bill_no')}}">
                        </div>

                        <div class="col">
                          <input type="text" class="form-control" name="je_no" placeholder="JE No." value="{{request('je_no')}}">
                        </div>


                        <div class="col">
                            <select name="bill_status" class="form-control">
                                <option value="">Select Bill Status</option>
                                <option value="pending" @if(request('bill_status') == 'pending') selected @endif>Pending</option>
                                <option value="processing" @if(request('bill_status') == 'processing') selected @endif>Processing</option>
                                <option value="completed" @if(request('bill_status') == 'completed') selected @endif>Completed</option>
                                <option value="cancelled" @if(request('bill_status') == 'cancelled') selected @endif>Cancelled</option>
                            </select>
                        </div>
                        <div class="col">
                            <input type="submit" class="btn btn-success" value="Search">
                        </div>
                        <br/><br/>
                    </div>
                </form>

        <table class="table">
            <thead>
                <th>JE No.</th>
                <th>Vendor</th>
                <th>Date Open</th>
                <th>Created By</th>
                <th>Total Amount</th>
                <th>Total Discount</th>
                <th>Status</th>
                <th>Invoice No.</th>
                <th>Invoice Amount</th>
                <th>File</th>
            </thead>

            <tbody>
                @foreach($bills as $bill)
                    <tr>
                        <td>{{$bill->job_estimate_number}}</td>
                        <td>{{$bill->vendors->vendor_name}}</td>
                        <td>{{ date('j F Y',strtotime($bill->created_at)) }}</td>
                        <td>{{$bill->users->name}}</td>
                        <td>{{$bill->je_info['total_amount']}}</td>
                        <td>{{$bill->je_info['total_discount']}}</td>
                        <td>{{$bill->status}}</td>
                        <td>{{$bill->bill_number}}</td>
                        <td>{{$bill->bill_amount}}</td>
                        <td>
                            @if($bill->file)
                            <a href="{{asset('bills')}}/{{$bill->file}}" target="_blank">Click for file</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
         {{$bills->appends($_GET)->links()}}
    </div>
</div>
@endsection



