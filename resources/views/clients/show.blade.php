@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        
            Clients
        
    </div>
    <div class="card-body">
        <div class="box box-primary">
            <div class="box-body">
               
                    @include('clients.show_fields')
                    <a href="{!! route('admin.clients.index') !!}" class="btn btn-default">Back</a>
               
            </div>
        </div>
    </div>
</div>
@endsection
