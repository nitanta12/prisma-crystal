@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
       
            Program
     
   </div>
   <div class="card-body">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($program, ['route' => ['admin.programs.update', $program->id], 'method' => 'patch']) !!}

                        @include('programs.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
</div>
@endsection