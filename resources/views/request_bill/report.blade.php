@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="card">

    	

        	<div class="card-body table-responsive">

        		<h3>Client Bills</h3>
        		<br/>
        		<form action = "">
		    		<div class="form-row">
					    <div class="col">
					      <input type="text" class="form-control" name="bill_no" placeholder="Bill No." value="{{request('bill_no')}}">
					    </div>

					    <div class="col">
					      <input type="text" class="form-control" name="je_no" placeholder="JE No." value="{{request('je_no')}}">
					    </div>

					   <!--  <div class="col">
					     	<select name="cs" class="form-control select2">
					     			<option value="">Select CS</option>
					     			@foreach($cs as $c)
					     				<option value="{{$c->id}}" @if(request('cs') == $c->id) selected @endif>{{$c->name}}</option>
					     			@endforeach
					     	</select>
					    </div>
					    <div class="col">
					      	<select name="client" class="form-control select2">
					     			<option value="">Select Client</option>
					     			@foreach($clients as $cli)
					     				<option value="{{$cli->id}}" @if(request('client') == $cli->id) selected @endif>{{$cli->client_name}}</option>
					     			@endforeach
					     	</select>
					    </div> -->
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
	        			<th>Date Open</th>
	        			<th>CS Name</th>
	        			<th>Client</th>
	        			<th>Brand</th>
	        			<th>Description</th>
	        			<th>Amount</th>
	        			<th>Vendor Discount</th>
	        			<th>Agency Discount</th>
	        			<th>Charges</th>
	        			<th>Total</th>
	        			<th>VAT</th>
	        			<th>Total With VAT</th>
	        			<th>Invoice No.</th>
	        			<th>Invoice Date</th>
	        			<th>Invoice Amount</th>
	        			<th>Status</th>
	        			<th>File</th>
	        		</thead>

	        		<tbody>
	        			@foreach($je_bills as $jb)
	        			<tr>
	        				<td>{{$jb->job_estimate->je_name}}</td>
	        				<td>{{ date('j F Y',strtotime($jb->job_estimate->created_at)) }}</td>
	        				<td>{{$jb->job_estimate->campaign->user->name}}</td>
	        				<td>{{$jb->job_estimate->campaign->client->client_name}}</td>
	        				<td>{{$jb->job_estimate->campaign->client->client_brand}}</td>
	        				<td>{{$jb->job_estimate->campaign->campaign_name}}</td>
	        				<td>{{$jb->all_calculation['total_amount']}}</td>
	        				<td>{{$jb->all_calculation['total_discount']}}</td>
	        				<td>{{$jb->all_calculation['agency_discount']}}</td>
	        				<td>{{$jb->all_calculation['total_charges']}}</td>
	        				<td>{{$jb->all_calculation['total_before_vat']}}</td>
	        				<td>{{$jb->all_calculation['vat']}}</td>
	        				<td>{{$jb->all_calculation['final_total']}}</td>
	        				<td>{{$jb->bill_number}}</td>
	        				<td>{{ date('j F Y',strtotime($jb->created_at)) }}</td>
	        				<td>{{ $jb->total_amount }}</td>
	        				<td>{{$jb->status}}</td>
	        				<td><a href="{{asset('bills').'/'.$jb->file}}">Click for file</a></td>
	        			</tr>	
	        			@endforeach
	        		</tbody>

        		</table>

        		{{$je_bills->appends($_GET)->links()}}

        	</div>
    </div>
</div>
@endsection
@section('scripts')
@parent

@endsection
