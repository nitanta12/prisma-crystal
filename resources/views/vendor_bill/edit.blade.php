
@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">

            Vendor Bill

   </div>
   <div class="card-body">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($vendor_bill, ['route' => ['admin.vendor_bill.update', $vendor_bill->id], 'method' => 'patch', 'files' => true]) !!}
                        @include('vendor_bill.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
