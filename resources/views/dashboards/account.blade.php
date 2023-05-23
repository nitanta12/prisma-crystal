@extends('layouts.admin')
@section('content')
<div class="content">
    
        <div class="card">

        	<div class="card-header">
           		<h4 class="pull-left"> Welcome {{Auth::user()->name}}</h4>

           		<span class="pull-right badge badge-primary">Role : Account</span>
        	</div>

        	<div class="card-body">
        		<h4>Requested Bill</h4>
                @include('flash::message')
                <table class="table">
                    <thead>
                        <th>S.N</th>
                        <th>Job Estimate Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </thead>

                    <tbody>
                        @foreach($request_bills as $key=>$request_bill)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$request_bill->job_estimate->je_name}}</td>
                            <td>{{$request_bill->status}}</td>
                            <td><a href="{{route('admin.upload_bill.create',[$request_bill->id])}}" class="btn btn-primary">Upload Bill</a></td>
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