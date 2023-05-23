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
                   {!! Form::model($campaign, ['route' => ['admin.campaigns.update', $campaign->id], 'method' => 'patch']) !!}

                        @include('campaigns.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
</div>
@endsection