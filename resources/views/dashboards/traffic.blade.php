@extends('layouts.admin')
@section('content')
<div class="content">

        <div class="card">

        	<div class="card-header">
           		<h4 class="pull-left"> Welcome {{Auth::user()->name}}</h4>

           		<span class="pull-right badge badge-primary">Role : Traffic</span>
        	</div>

        	<div class="card-body">
                <a href="{{route('admin.vendor_bill.add')}}" class="btn btn-primary">Add new</a>
                <br>
        		<h4>Vendor Bill</h4>
                @include('flash::message')
                <table class="table">
                    <thead>
                        <th>S.N</th>
                        <th>Job Estimate Number</th>
                        <th>Bill Number</th>
                        <th>Vendor</th>
                        <th>Bill Amount</th>
                        <th>Status</th>
                        <th>Remarks</th>
                        <th>Action</th>
                    </thead>

                    <tbody>

                     @foreach($vendor_bills as $k => $vendor_bill)
                        <tr>
                            <td>{{$k+1}}</td>
                            <td>{{$vendor_bill->job_estimate_number}}</td>
                            <td>{{$vendor_bill->bill_number}}</td>
                            <td>{{$vendor_bill->vendors->vendor_name}}</td>
                            <td>{{$vendor_bill->bill_amount}}</td>
                            <td>{{$vendor_bill->status}}</td>
                            <td>{{$vendor_bill->remarks}}</td>
                            <td>
                                {!! Form::open(['route' => ['admin.vendor_bill.destroy', $vendor_bill->id], 'method' => 'delete']) !!}

                                <div class='btn-group'>
                                    <a href="{!! route('admin.vendor_bill.show', [$vendor_bill->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-eye"></i></a>
                                    <a href="{!! route('admin.vendor_bill.edit', [$vendor_bill->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-edit"></i></a>
                                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                </div>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>

        	</div>

        </div>

</div>
@endsection
@section('scripts')
@parent

@endsection
