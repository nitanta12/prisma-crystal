@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
       
            Vendors
    </div>
    <div class="card-body">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'admin.vendors.store']) !!}

                        @include('vendors.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
