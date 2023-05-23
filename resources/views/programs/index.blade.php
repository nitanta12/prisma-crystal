@extends('layouts.admin')

@section('content')
    
<div class="card">

    <div class="card-header">
        <span>Programs</span>
        <span class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('admin.programs.create') !!}"><i class="fa fa-plus"></i> Add New</a>
        </span>
    </div>
    <div class="card-body">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('programs.table')

                    {{$programs->links()}}
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
</div>
@endsection

