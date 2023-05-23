@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
       
            Clients
     
   </div>
   <div class="card-body">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($clients, ['route' => ['admin.clients.update', $clients->id], 'method' => 'patch']) !!}

                        @include('clients.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
</div>
@endsection