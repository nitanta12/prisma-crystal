
@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
       
            Creative Brief
    </div>
    <div class="card-body">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'admin.creativeBriefs.store', 'files' => true]) !!}
                        <input type="hidden" name="campaign_id" value="{{$campaign_id}}">
                        @include('creative_briefs.fields')
                        
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
