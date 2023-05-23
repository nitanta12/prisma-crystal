@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
       
            Campaign
    </div>
    <div class="card-body">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'admin.campaigns.store']) !!}

                        @include('campaigns.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
