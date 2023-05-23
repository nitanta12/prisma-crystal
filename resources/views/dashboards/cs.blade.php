@extends('layouts.admin')
@section('content')
<div class="content">
    
        <div class="card">

        	<div class="card-header">
           		<h4 class="pull-left"> Welcome {{Auth::user()->name}}</h4>

           		<span class="pull-right badge badge-primary">Role : CS</span>
        	</div>

        	<div class="card-body">
        		<h4>Assigned Clients</h4>

        		<table class="table">
        			<thead>
        				<th>S.N</th>
        				<th>Client Name</th>
        				<th>Client Brand</th>
        				<th>Client Phone</th>
        				<th>Client Address</th>
        				<th>Client Email</th>
        				<th>Total Campaigns</th>
        				<th>Actions</th>
        			</thead>

        			<tbody>
        				@foreach($clients as $key=>$c)
        				<tr>
        					<td>{{$key + 1}}</td>
        					<td>{{$c->client_name}}</td>
        					<td>{{$c->client_brand}}</td>
        					<td>{{$c->client_phone}}</td>
        					<td>{{$c->client_address}}</td>
        					<td>{{$c->client_email}}</td>
        					<td><span class="badge badge-light">{{$c->total_campaigns}}</span></td>
        					<td><a class="btn btn-default btn-xs" href="{{route('admin.campaigns.index')}}?client_id={{$c->id}}"><i class="fa fa-eye"></i> View Campaigns</a></td>
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