
@extends('layouts.admin')

@section('content')
    
<div class="card">

    <div class="card-header">
        <span>Creative Briefs</span>
        <span class="pull-right">
           <a class="btn btn-primary pull-right btn-xs" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('admin.creativeBriefs.create',[$campaign_id]) !!}"><i class="fa fa-plus"></i> Add New</a>
        </span>
    </div>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('creative_briefs.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
</div>
@endsection



