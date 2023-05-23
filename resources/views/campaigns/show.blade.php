@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">

            Campaign Name : {{$campaign->campaign_name}}



    </div>
    <div class="card-body">

         @include('flash::message')

        <div class="box box-primary">
            <div class="box-body">

                  <div class="col-lg-2 pull-left borderbox">
                    <a href="{{route('admin.job_estimate.index',[$campaign->id])}}">
                      <i class="fa fa-briefcase"></i>
                      <br/>
                      Job Estimates
                    </a>
                  </div>

                  <div class="col-lg-2 pull-left borderbox">
                    <a href="{{route('admin.creativeBriefs.index',[$campaign->id])}}">
                     <i class="fa fa-briefcase" ></i>
                      <br/>Creative Brief
                    </a>
                  </div>

                  <div class="col-lg-2 pull-left borderbox">
                    <a href="{{route('admin.creativeAds.index',[$campaign->id])}}">
                     <i class="fa fa-briefcase" ></i>
                      <br/>Creative Ads
                    </a>
                  </div>

                  {{-- <div class="col-lg-2 pull-left borderbox">
                    <a href="">
                     <i class="fa fa-briefcase" ></i>
                      <br/>Bills
                    </a>
                  </div> --}}

                    <div class="clearfix"></div>
                    <br/><br/>
                    <a href="{!! route('admin.campaigns.index') !!}" class="btn btn-default">Back</a>

            </div>
        </div>
    </div>
</div>




<script>

$(function()
{


     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });




});

</script>

<style>
.borderbox
{
  border:1px #ddd solid;
  padding:10px;
  margin:5px;
  text-align: center;
}
.borderbox i
{
  color:#54a9db;
  font-size:50px;
}

</style>

@endsection
