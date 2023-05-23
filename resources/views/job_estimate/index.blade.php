    @extends('layouts.admin')

@section('content')

@php
    $role = Auth::user()->roles[0]->title;

@endphp

<div class="card">
    <div class="card-header">

            Job Estimates of <b>{{$campaign->campaign_name}}</b>
            @if(Auth::user()->roles[0]->title != 'Executive')
            <button class="btn btn-xs pull-right btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Add New Estimate</button>
            @endif
    </div>
    <div class="card-body">
         @include('flash::message')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    <table class="table">
                        <thead>
                            <th>
                                S.N
                            </th>
                            <th>
                                Job estimate
                            </th>
                            <th>Type</th>

                            <th>Create At</th>
                            <th>
                                Actions
                            </th>
                        </thead>

                        <tbody>

                            @foreach($job_estimate as $key=>$je)

                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$je->je_name}}</td>
                                <td>{{str_replace('_',' ',Str::title($je->table_type))}}</td>

                                <td>{{date("F jS, Y H:i:s", strtotime($je->created_at))}}</td>
                                <td>
                                    @if($role == 'Executive')
                                    <a class="btn btn-default btn-xs" href="{{URL::TO('/')}}/admin/job_estimate/print/{{$je->id}}/{{$je->table_type}}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    @else
                                    <a class="btn btn-default btn-xs" href="{{route('admin.job_estimate.jobs',[$je->table_type,$je->id])}}"><i class="fa fa-eye"></i></a>
                                    <a class="btn btn-danger btn-xs deletesure" href="{{route('admin.job_estimate.delete',[$je->id])}}" style="color:#fff"><i class="fa fa-trash"></i></a>
                                    @if($je->request_bills)
                                    <a href="" class="btn btn-primary btn-xs view_bill" data-toggle="modal" data-target="#viewBillModal{{$je->id}}" data-item-id="{{$je->id}}">View Bill</a>
                                    <form method="post" action="{{route('admin.job_estimate.update_bill',[$je->request_bills->id])}}" enctype="multipart/form-data">
                                        @csrf
                                <div class="modal fade" id="viewBillModal{{$je->id}}" tabindex="-1" role="dialog" aria-labelledby="billModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="billModalLabel">View/Update Client Bill</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">


                                            <label for="bill">Upload Bill:</label>
                                        <a target="_blank" href="{{asset('bills').'/'.$je->request_bills->file}}">Click for file</a>
                                            <input name="bill" type="file" class="form-control" value="">
                                            <label for="bill_number">Bill Number:</label>
                                        <input type="text" name="bill_number" class="form-control" id="bill_number" value="{{$je->request_bills->bill_number}}">
                                            <label for="status">Status:</label>
                                            <select name="status" class="form-control" id="status">
                                            <option value="pending" @if($je->request_bills->status == 'pending') selected @endif>Pending</option>
                                              <option value="processing" @if($je->request_bills->status == 'processing') selected @endif>processing</option>
                                                <option value="completed" @if($je->request_bills->status == 'completed') selected @endif>completed</option>
                                                <option value="cancelled" @if($je->request_bills->status == 'cancelled') selected @endif>cancelled</option>
                                            </select>
                                            <label for="total_amount">Total Amount:</label>
                                            <input type="text" name="total_amount" class="form-control" id="total_amount" value="{{$je->request_bills->total_amount}}">
                                            <label for="remarks">Remarks:</label>
                                            <textarea name="remarks" id="remarks" class="form-control">{{$je->request_bills->remarks}}
                                            </textarea>
                                            <input type="hidden" name="je_id" value="{{$je->id}}">
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  </form>
                                @else
                                        <a href="" class="btn btn-primary btn-xs add_bill" data-toggle="modal" data-target="#billModal" data-item-id="{{$je->id}}">Add Bill</a>
                                    @endif
                                    <!-- Modal for bill view -->
                                    @endif
                                    </td>
                            </tr>

                            @endforeach

                        </tbody>
                    </table>

<form method="post" action="{{route('admin.job_estimate.add_bill')}}" enctype="multipart/form-data">
    @csrf
  <!-- Modal for bill add -->
  <div class="modal fade" id="billModal" tabindex="-1" role="dialog" aria-labelledby="billModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="billModalLabel">Add Client Bill</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <label for="bill">Upload Bill:</label>
            <input name="bill" type="file" class="form-control">
            <label for="bill_number">Bill Number:</label>
            <input type="text" name="bill_number" class="form-control">
            <label for="status">Status:</label>
            <select name="status" class="form-control">
                <option value="pending">Pending</option>
                <option value="processing">Processing</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
            </select>
            <label for="total_amount">Total Amount:</label>
            <input type="text" name="total_amount" class="form-control">
            <label for="remarks">Remarks:</label>
            <textarea name="remarks" id="remarks" class="form-control"></textarea>
            <input type="hidden" name="je_id" id="je_id" value="">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>

                    </div>
                </div>
            </div>
        </div>
    </div>

<form action="{{route('admin.job_estimate.create')}}" method="post">
<!-- The Modal -->

    {{csrf_field()}}

<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add New Job Estimate</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
            <div class="form-group">
                <label>Template Type</label>
                <select class="form-control select_job_estimate" name="table_type" required="">
                    <option value="">Select</option>
                    <option value="national_daily">National Daily</option>
                    <option value="tv" >TV</option>
                    <option value="magazine" >Magazine</option>
                    <option value="local_newspaper" >Local Newspaper</option>
                    <option value="radio" >Radio</option>
                    <option value="online_portal">Online Portal</option>
                    <option value="movie">Movie Theatre</option>
                     <option value="others">Others</option>
                </select>
                <input type="hidden" name="campaign_id" value="{{$campaign->id}}">
            </div>
            <div class="other_name_box">

            </div>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Create New</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

</form>

<script>
$(function()
{
    $('.select_job_estimate').change(function()
    {
        var name = $(this).val();
        var input = '<input type="text" name="je_name" class="form-control" placeholder="Job estimate name" pattern="[A-Za-z0-9]+" required>';
        if(name == 'others')
        {
            $('.other_name_box').html(input);
        }
        else
        {
             $('.other_name_box').html('');

        }
    });
});
function verify(){
    return confirm("Are you sure?");
}
$(".add_bill").on('click',function(){
    var billId = $(this).data('itemId');
    // console.log("hello");
    // console.log(billId);
    $("#je_id").val(billId);
});

</script>


@endsection
