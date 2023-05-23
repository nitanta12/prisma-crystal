@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
       
            Jobs of <b>{{$job_estimate->je_name}}</b> <a class="btn btn-success btn btn-xs" href="{{route('admin.job_estimate.print',[$job_estimate->id,$job_estimate->table_type])}}" style="color:#fff" ><i class="fa fa-print"></i> Print View</a>
            <button class="btn btn-xs pull-right btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Add New Job</button>

             <button class="btn btn-xs pull-right btn-success" data-toggle="modal" data-target="#addcharge" style="margin-right:10px"><i class="fa fa-plus"></i> Charges</button>
    </div>
    <div class="card-body">
         @include('flash::message')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                 <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <th>S.N</th>
                            <th>Publication</th>
                            <th>Size(cc)</th>
                            <th>Break</th>
                            <th>Position</th>
                            <th>Type</th>
                            <th>Rate/cc</th>
                            <th>Inc.</th>
                            <th>Amount</th>
                            <th>Actions</th>
                        </thead>

                        <tbody>
                            @foreach($jobs as $key=>$pm)   
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td><input type="text" value="{{$pm->publication}}" class="form-control main_update" name="publication"></td>
                                <td><input type="number" value="{{$pm->size}}" class="form-control size_u main_update" step="0.01" name="size"></td>
                                <td><input type="text" value="{{$pm->break}}" class="form-control main_update" name="break"></td>
                                 <td><input type="text" value="{{$pm->position}}" class="form-control main_update" name="position"></td>
                                 <td><input type="text" value="{{$pm->color_type}}" class="form-control main_update" name="color_type"></td>
                                <td><input type="number" value="{{$pm->rate_per_cc}}" class="form-control rate_u main_update" step="0.01" name="rate_per_cc"></td>
                                <td><input type="number" value="{{$pm->dates->count()}}" class="form-control inc_u main_update" step="0.01" name="inc" readonly=""></td>
                                <td><input type="number" value="{{$pm->amount}}" class="form-control total_amount_u main_update" step="0.01" name="amount" readonly></td>
                                <td>
                                    <div class="btn-group">
                                      <!-- Discount -->
                                      <a class="btn btn-success btn-xs" style="color:#fff" data-toggle="modal" data-target="#discountmodal{{$key}}"><i class="fa fa-money"></i> Discount</a>
                                        <form action="{{route('admin.job_estimate.jobs.update_discount')}}" method="post">
                                        <!-- Modal -->
                                        {{csrf_field()}}
                                        <input type="hidden" name="job_id" value="{{$pm->id}}">
                                        <input type="hidden" name="table_name" value="national_daily">
                                            <div class="modal fade" id="discountmodal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Discounts</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <table class="table discount_table">
                                                      <thead>
                                                          <th>S.N</th>
                                                          <th>Discount Name</th>
                                                          <th>Discount Percentage</th>
                                                          
                                                          <th>Actions</th>
                                                      </thead>
                                                      <tbody>
                                                          @foreach($pm->discounts as $diskey=>$od)
                                                            <tr id="item_{{$od->id}}" class="discount_tr">
                                                              <td>{{$diskey + 1}}</td>
                                                              <td>{{$od->discounts->discount_name}}</td>
                                                              <td>
                                                                @if($od->discount_percentage)
                                                                  {{$od->discount_percentage}}
                                                                @else
                                                                  N/A
                                                                @endif
                                                              </td>
                                                              
                                                                <td><a class="btn btn-danger btn-xs delete_discount" style="color:#fff" did="{{$od->id}}"><i class="fa fa-trash"></i></a></td>
                                                            </tr>
                                                          @endforeach
                                                      </tbody>
                                                    </table>

                                                    @foreach($discounts as $di)

                                                    @if(!$pm->discounts->contains('discount_id',$di->id))
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                          
                                                          <label class="form-check-label" for="inlineCheckbox1">{{$di->discount_name}}</label>
                                                        </div>
                                                        <div class="col-lg-5 float-left">
                                                          <input type="number" class="form-control" step="0.01" name="discount_array[{{$di->id}}][]" placeholder="Discount  %">
                                                        </div>
                                                        <!-- <div class="col-lg-2 float-left">
                                                                  OR
                                                        </div>
                                                        <div class="col-lg-5 float-left">
                                                            <input type="number" class="form-control" step="0.01" name="discount_array[{{$di->id}}][]" placeholder="Discount Amount">
                                                        </div> -->
                                                        <div class="clearfix"></div>
                                                      </div>
                                                    @endif
                                                    @endforeach
                                                  </div>
                                                  <input type="hidden" name="table_name" value="national_daily">
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </form>
                                          <!-- End modal -->

                                      <!-- Discount ends -->

                                        <a class="btn btn-warning btn-xs" data-toggle="modal" data-target="#dateupdatemodal{{$key}}" style="color:#fff"><i class="fa fa-eye"></i> Dates</a>
                                        <a class="btn btn-primary btn-xs update_now" style="color:#fff" oid="{{$pm->id}}"><i class="fa fa-edit"></i> update</a>
                                        <a class="btn btn-danger btn-xs deletenational" style="color:#fff" oid="{{$pm->id}}"><i class="fa fa-trash"></i> </a>
                                    </div>
                                        <div class="updating">
                                            Updating . . .
                                        </div>
                                        <form action="{{route('admin.job_estimate.jobs.update_date')}}" method="post">
                                        <!-- Modal -->
                                        {{csrf_field()}}
                                        <div class="modal fade" id="dateupdatemodal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="dateupdatemodal{{$key}}" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="dateupdatemodal{{$key}}">Dates</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">
                                                  <table class="table">
                                                      <thead>
                                                        <th>
                                                          S.N
                                                        </th>
                                                        <th>
                                                          Date From
                                                        </th>
                                                        <th>
                                                          Date To
                                                        </th>
                                                        <th>Actions</th>
                                                      </thead>  
                                                      <tbody>
                                                        @foreach($pm->dates as $key1=>$pd)
                                                          <tr class="update_date_tr">

                                                            <td>{{$key1 + 1}}</td>
                                                            <td>{{$pd->date_from}}</td>
                                                            <td>{{$pd->date_to}}</td>
                                                            <td><a class="btn btn-danger btn-xs deletedateupdate" style="color:#fff" dateid="{{$pd->id}}"><i class="fa fa-trash"></i></a>
                                                              
                                                              </td>
                                                          </tr>
                                                        @endforeach
                                                      </tbody>
                                                  </table>
                                                  <input type="hidden" name="job_id" value="{{$pm->id}}">
                                                  <input type="text" class="form-control update_date_datepicker" name="dates" placeholder="Add Dates">
                                                   <input type="hidden" name="table_name" value="national_daily">
                                              </div>
                                              <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary" >Update</button>
                                                <button type="button" class="btn btn-secondary refresh_page" data-dismiss="modal">Close</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>    
                 </div>

                </div>
            </div>
        </div>
    </div>
</div>

<form action="{{route('admin.job_estimate.jobs.create_jobs')}}" method="post">
<!-- The Modal -->
    
    {{csrf_field()}}

<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add New Job</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
            

            <div class="form-group">
                <lable>Publication</lable>
                <select name="vendor_id" class="form-control select2" required>
                    <option value="">Select</option>
                    @foreach($vendors as $v)
                    <option value="{{$v->id}}">{{$v->vendor_name}}</option>
                    @endforeach

                </select>
            </div>
            <div class="form-group">
                <label>Size</label>
                <input type="number" name="size" class="form-control size" step="0.01">
            </div>
            <div class="form-group">
                <label>Break</label>
                <input type="text" name="break" class="form-control">
            </div>
            <div class="form-group">
                <label>Position</label>
                <input type="text" name="position" class="form-control">
            </div>
            <div class="form-group">
                <label>Type</label>
                <input type="text" name="color_type" class="form-control">
            </div>
             <div class="form-group">
                <label>Rate</label>
                <input type="number" name="rate_per_cc" class="form-control rate" step="0.01">
            </div>

            <div class="form-group">
              <label>Select Dates</label>
                <input type="text" name="date_from_to" class="form-control add_date_datepicker" autocomplete="off" required>
               
            </div>
          
            <div class="form-group">
                <label>Inc.</label>
                <input type="number" name="inc" class="form-control inc" step="0.01" readonly="" value="0">
            </div>
             <div class="form-group">
                <label>Amount</label>
                <input type="number" name="amount" class="form-control total_amount" step="0.01" readonly="">
            </div>

            <h3>Discounts</h3>
            <hr/>
            <div class="form-group">
              @foreach($discounts as $dkey=>$di)
                <div class="form-check">
                
                <label class="form-check-label" for="inlineCheckbox1">{{$di->discount_name}}</label>
              </div>
                <div class="col-lg-12">
                  <input type="number" class="form-control" step="0.01" name="discount_array[{{$di->id}}][]" placeholder="Discount  %">
                </div>
                <!-- <div class="col-lg-2 float-left">
                    OR
                </div>
                <div class="col-lg-5 float-left">
                  <input type="number" class="form-control" step="0.01" name="discount_array[{{$di->id}}][]" placeholder="Discount Amount">
                </div> -->
              <div class="clearfix"></div>
              @endforeach
            </div>

           <input type="hidden" name="je_id" value="{{$job_estimate->id}}">

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Create New</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

</form>

<!-- Charges Modal -->



<form action="{{route('admin.job_estimate.process_charges')}}" method="post">
<!-- The Modal -->
    
    {{csrf_field()}}
    <input type="hidden" name="je_id" value="{{$job_estimate->id}}">
    <input type="hidden" name="table_name" value="others">

<div class="modal" id="addcharge">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Charges</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
            
        <table class="table charge_table">
            <thead>
              <th>S.N</th>
              <th>Charge Name</th>
              <th>Charge %</th>
              <th>Charge Amount</th>
              <th>Actions</th>
            </thead>
            <tbody>
                @foreach($job_estimate->charges as $kjec=>$c)
                <tr id="item_{{$c->id}}" class="charge_tr">
                  <td>{{$kjec + 1}}</td>
                  <td>{{$c->charges->charge_name}}</td>
                  <td>{{$c->charge_percentage}}</td>
                  <td>{{$c->charge_amount}}</td>
                  <td><a class="btn btn-danger btn-xs delete_charge" style="color:#fff" cid="{{$c->id}}"><i class="fa fa-trash"></i> </a></td>
                </tr>
                @endforeach
            </tbody>
        </table>

         <div class="form-group">
              @foreach($charges as $key=>$ch)
               @if(!$job_estimate->charges->contains('charge_id',$ch->id))
                <div class="form-check">
                
                <label class="form-check-label" for="inlineCheckbox1">{{$ch->charge_name}}</label>
              </div>
                <div class="col-lg-5 float-left">
                  <input type="number" class="form-control" step="0.01" name="charge_array[{{$ch->id}}][]" placeholder="Charge  %">
                </div>
                <div class="col-lg-2 float-left">
                    OR
                </div>
                <div class="col-lg-5 float-left">
                  <input type="number" class="form-control" step="0.01" name="charge_array[{{$ch->id}}][]" placeholder="Charge Amount">
                </div>
              <div class="clearfix"></div>
              @endif
              @endforeach
          </div>
            
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

</form>

  
<script>
$(function()
{   

    $('.size').keyup(function()
    {
        update_total_amount();
    });
    $('.rate').keyup(function()
    {
        update_total_amount();
    });
    function update_total_amount()
    {
        var size = parseFloat($('.size').val()) || 0;
        var rate = parseFloat($('.rate').val()) || 0;
        var inc = parseFloat($('.inc').val()) || 0;
        var total = size * rate * inc;
        total = total.toFixed(2);
        $('.total_amount').val(total);
    }


    $('.size_u').keyup(function()
    {
        var size = parseFloat($(this).val()) || 0;
        var rate = parseFloat($(this).parents('td').nextAll().find('.rate_u').val()) || 0;
        var inc =  parseFloat($(this).parents('td').nextAll().find('.inc_u').val()) || 0;
        var total_amount_u = size * rate * inc;

        total_amount_u = total_amount_u.toFixed(2);

        $(this).parents('td').nextAll().find('.total_amount_u').val(total_amount_u);
    });

    $('.rate_u').keyup(function()
    {
        var rate = parseFloat($(this).val()) || 0;
        var size = parseFloat($(this).parents('td').prevAll().find('.size_u').val()) || 0;
        var inc =  parseFloat($(this).parents('td').nextAll().find('.inc_u').val()) || 0;
        var total_amount_u = size * rate * inc;

        total_amount_u = total_amount_u.toFixed(2);

        $(this).parents('td').nextAll().find('.total_amount_u').val(total_amount_u);
    });

     $('.inc_u').change(function()
    {
        var inc = parseFloat($(this).val()) || 0;
        var size = parseFloat($(this).parents('td').prevAll().find('.size_u').val()) || 0;
        var rate =  parseFloat($(this).parents('td').prevAll().find('.rate_u').val()) || 0;
        var total_amount_u = size * rate * inc;
        total_amount_u = total_amount_u.toFixed(2);

        $(this).parents('td').nextAll().find('.total_amount_u').val(total_amount_u);
    });
    


    $('.deletenational').click(function()
    {   
      var status = confirm("Are you sure?");
      if(status)
      {
        var oid = $(this).attr('oid');
        var z = $(this);
        $.ajax({
               type:'POST',
               url:'/admin/job_estimate/jobs/delete/'+ oid + '/national_daily' ,
               data:{ "_token": "{{ csrf_token() }}"},
               success:function(data) {
                  $(z).parents('tr').remove();
               }
            });
      }
    });


    $(document).on('click','.update_now',function()
    {

         var oid = $(this).attr('oid');
         var z = $(this);
         var arrayz = [];


         $(z).parents('tr').find('input.main_update').each(function(index,item)
         {
            var name = $(item).attr('name');
            var value = $(item).val();
            arrayz[name] = value;
         });

            arrayz = Object.assign({}, arrayz);

            $(z).parents('div').next().show();

          $.ajax({
               type:'POST',
               url:'/admin/job_estimate/jobs/update/'+ oid + '/national_daily' ,
               data:{ "_token": "{{ csrf_token() }}",'data' : arrayz},
               success:function(data) {
                if(data)
                {
                  $(z).parents('div').next().hide();
                }
               }
            });
    });

    //this is for date only
    
    $('.add_date_datepicker').datepicker(
    {
      multidate: true,
    });
    $('.add_date_datepicker').change(function()
    {
      $(this).datepicker({
          
      }).on('changeDate', function(e) {
           $('.inc').val(e.dates.length);
           update_total_amount();
        });

    });

    $('.update_date_datepicker').datepicker(
    {
      multidate: true,
    });
    $('.update_date_datepicker').change(function()
    {
      $(this).datepicker({
          
      }).on('changeDate', function(e) {
          
        });

    });

    $(document).on('click','.delete_date',function(e)
    {
       var ins = $('.append_date_here input').length - 1;
       $('.inc').val(ins);
        update_total_amount();
      $(this).parents('.form-group').remove();
        e.preventDefault();
    });

    $(document).on('click','.deletedateupdate',function(e)
    {
        
        var dateid = $(this).attr('dateid');
         $.ajax({
               type:'POST',
               url:'/admin/job_estimate/jobs/delete_date_ajax/'+ dateid,
               data:{ "_token": "{{ csrf_token() }}"},
               success:function(data) {
                if(data)
                {
                  $(z).parents('div').next().hide();
                }
               }
            });
         $(this).parents('tr.update_date_tr').remove();
        e.preventDefault();
    });
    
    $(document).on('click','.delete_charge',function()
    { 
      var did = $(this).attr('cid');
      var  z = $(this);
        $.ajax({
               type:'POST',
               url:'/admin/job_estimate/jobs/delete_charge_ajax/' + did,
               data:{ "_token": "{{ csrf_token() }}"},
               success:function(data) {
                if(data)
                {
                  $(z).parents('tr.charge_tr').remove();
                  location.reload();
                }
               }
            });
    });

    $(document).on('click','.delete_discount',function()
    { 
      var did = $(this).attr('did');
      var  z = $(this);
        $.ajax({
               type:'POST',
               url:'/admin/job_estimate/jobs/delete_discount_ajax/' + did,
               data:{ "_token": "{{ csrf_token() }}"},
               success:function(data) {
                if(data)
                {
                  $(z).parents('tr.discount_tr').remove();
                  location.reload();
                }
               }
            });
    });

     $( '.discount_table tbody' ).sortable({
      update: function() {
          items = $( this ).sortable( 'serialize' );

          $.ajax({
              type:'POST',
              url: '/admin/job_estimate/update_discount_charge_order/job_discount',
              type: 'post',
              data: { "_token": "{{ csrf_token() }}", items },
              error: function() {
                  console.log( 'Error' );
              }
          });
      }
    });

      $( '.charge_table tbody' ).sortable({
      update: function() {
          items = $( this ).sortable( 'serialize' );

          $.ajax({
              type:'POST',
              url: '/admin/job_estimate/update_discount_charge_order/charge_estimate',
              type: 'post',
              data: { "_token": "{{ csrf_token() }}", items },
              error: function() {
                  console.log( 'Error' );
              }
          });
      }
    });

    $('.refresh_page').click(function()
    {
      location.reload();
    })

});

</script>

<style>
.updating
{
    display: none;
}
</style>


@endsection
