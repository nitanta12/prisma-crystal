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
                   {!! Form::model($vendors, ['route' => ['admin.vendors.update', $vendors->id], 'method' => 'patch']) !!}

                        @include('vendors.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
</div>
@endsection