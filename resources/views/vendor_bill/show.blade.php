@extends('layouts.admin')

@section('content')
<div class="card">
     <div class="card-header">

            Vendor Bill

   </div>
    <div class="card-body">
        <div class="box box-primary">
            <div class="box-body">
                @include('vendor_bill.show_fields')
            </div>
        <a href="{{url('/')}}" class="btn btn-default">Back</a>
        </div>
    </div>
</div>
@endsection
