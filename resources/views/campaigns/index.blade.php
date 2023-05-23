@extends('layouts.admin')

@section('content')
    
<div class="card">

    <div class="card-header">
        <span>Campaigns</span>
        <span class="pull-right">
            @if(Auth::user()->roles[0]->title != 'Executive')
           <a class="btn btn-primary pull-right btn-xs" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('admin.campaigns.create') !!}"><i class="fa fa-plus"></i> Add New</a>
           @endif
        </span>
    </div>
    <div class="card-body">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('campaigns.table')
            </div>
            {{$campaigns->links()}}
        </div>
        <div class="text-center">
        
        </div>
    </div>
</div>
@endsection

