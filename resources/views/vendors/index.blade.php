@extends('layouts.admin')

@section('content')
    
<div class="card">

    <div class="card-header">
        <span>Vendors</span>
        <span class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('admin.vendors.create') !!}"><i class="fa fa-plus"></i> Add New</a>
        </span>
    </div>



    <div class="card-body">
        <div class="clearfix"></div>

        <form action="{{route('admin.vendors.index')}}" method="get">
            <div class="col-lg-4 float-left">
               <div class="form-group">
                    <select class="form-control" name="is_media">
                        <option value="">Is Media?</option>
                        <option value="yes" @if(request('is_media') == 'yes') selected @endif>Yes</option>
                        <option value="no" @if(request('is_media') == 'no') selected @endif>No</option>
                    </select>
                </div>
            </div>

             <div class="col-lg-4 float-left">
               <div class="form-group">
                    <select class="form-control" name="vendor_type">
                            <option value="">Select</option>
                            <option value="national_daily" @if(request('vendor_type') == 'national_daily') selected @endif>National Daily</option>
                            <option value="tv" @if(request('vendor_type') == 'tv') selected @endif>TV</option>
                            <option value="magazine" @if(request('vendor_type') == 'magazine') selected @endif>Magazine</option>
                            <option value="local_newspaper" @if(request('vendor_type') == 'local_newspaper') selected @endif>Local Newspaper</option>
                            <option value="radio" @if(request('vendor_type') == 'radio') selected @endif>Radio</option>
                            <option value="online_portal" @if(request('vendor_type') == 'online_portal') selected @endif>Online Portal</option>
                            <option value="others" @if(request('vendor_type') == 'others') selected @endif>Others</option>
                     </select>
                </div>
            </div>

            <div class="col-lg-4 float-left">
                <button type="submit" class="btn btn-success">Filter</button>
            </div>
        </form>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('vendors.table')

                    {{$vendors->links()}}
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
</div>
@endsection

