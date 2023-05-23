
@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
      @if(Auth::user()->roles[0]->title != 'Executive')
        <button class="btn btn-xs pull-right btn-primary add_file" data-toggle="modal" data-target="#addFileModal" data-item-id="{{$campaign_id}}"><i class="fa fa-plus"></i> Add New Creative Ads</button>
      @endif
    </div>
    <div class="card-body">

         @include('flash::message')

        <div class="box box-primary">
            <div class="box-body">
                @foreach($creative_ads as $creative_ad)
                  <div class="col-lg-2 pull-left borderbox file">
                      @if(Auth::user()->roles[0]->title != 'Executive')
                        {!! Form::open(['route' => ['admin.creativeAds.destroy', $creative_ad->id], 'method' => 'delete']) !!}
                        <button type="submit" class=" pull-right close" aria-label="Close" onclick="return confirm('Are you sure?');">
                            <span aria-hidden="true">&times;</span>
                          </button>
                       {!! Form::close() !!}
                      @endif
                  <a target="_blank" href="{{asset('creative_ads').'/'.$creative_ad->file}}"><img style="height:150px; width:150px" src="{{asset('creative_ads').'/'.$creative_ad->file}}" alt="">
                  <p><span>{{$creative_ad->file_name}}</span></p>
                  </a>
                  </div>
                 
                @endforeach
                <div class="clearfix"></div>


            </div>
        </div>
    </div>
</div>
<form method="post" action={{route('admin.creativeAds.store')}} enctype="multipart/form-data">
    @csrf
  <!-- Modal for bill add -->
  <div class="modal fade" id="addFileModal" tabindex="-1" role="dialog" aria-labelledby="billModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="billModalLabel">Add File</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <label for="file">Upload File:</label>
            <input name="file" type="file" class="form-control">
            <label for="file_name">File Name:</label>
            <input type="text" name="file_name" class="form-control" required="">
            <input type="hidden" name="campaign_id" value="" id="campaign_id">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</form>


<script>

$(function()
{


     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });




});

$(".add_file").on("click",function(){
    var campaign_id = $(this).data('itemId');
    console.log(campaign_id);
    $("#campaign_id").val(campaign_id);
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



