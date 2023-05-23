
@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
       
            Upload Bill
    </div>
    <div class="card-body">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'admin.upload_bill.store', 'files' => true]) !!}
                        <input type="hidden" name="request_bill_id" value="{{$id}}">
                        <div class="form-group col-sm-6">
                            {!! Form::label('file', 'Upload File:') !!}
                            {!! Form::file('file', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-sm-6">
                            <input class="btn btn-primary" type="submit" name="submit" value="submit">
                        </div>


                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
