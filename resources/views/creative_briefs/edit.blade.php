
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
                   {!! Form::model($creativeBrief, ['route' => ['admin.creativeBriefs.update', $creativeBrief->id], 'method' => 'patch', 'files' => true]) !!}
                        <input type="hidden" name="campaign_id" value="{{$creativeBrief->campaign_id}}">
                        @include('creative_briefs.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
</div>
@endsection