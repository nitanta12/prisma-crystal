@extends('layouts.admin')

@section('content')
<div class="card">
     <div class="card-header">
       
            Creative Brief
     
   </div>
    <div class="card-body">
        <div class="box box-primary">
            <div class="box-body">
                @include('creative_briefs.show_fields')
            </div>
            <a href="{!! route('admin.creativeBriefs.index',[$creativeBrief->campaign_id]) !!}" class="btn btn-default">Back</a>
        </div>
    </div>
</div>
@endsection
