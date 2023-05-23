@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        
            Vendors
        
    </div>
    <div class="card-body">
        <div class="box box-primary">
            <div class="box-body">
                
                    @include('vendors.show_fields')
                    <a href="{!! route('admin.vendors.index') !!}" class="btn btn-default">Back</a>
               
            </div>
        </div>
    </div>
</div>
@endsection
