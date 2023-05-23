@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
       
            Jobs of <b>{{$job_estimate->je_name}}</b> <a class="btn btn-success btn btn-xs" href="{{route('admin.job_estimate.print',[$job_estimate->id,$job_estimate->table_type])}}" style="color:#fff" ><i class="fa fa-print"></i> Print View</a>
            <button class="btn btn-xs pull-right btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Add New Job</button>
            <a class="btn btn-warning btn-xs pull-right" href="{{URL::TO('/')}}/admin/programs" target="_blank" style="color:#fff;margin-right:10px"><i class="fa fa-plus"> New Program</i></a>
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
                            <th>Station</th>
                            <th>Program</th>
                            <th>Position</th>
                            <th>Rate Type</th>
                            <th>Rate</th>
                            <th>Total Unit</th>
                            <th>Total Amount</th>
                            <th>Actions</th>
                        </thead>

                        <tbody>
                            @foreach($jobs as $key=>$pm)   
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$pm->station}}</td>
                                <td>{{$pm->program}}</td>
                          
                                 <td>{{$pm->position}}</td>

                                 <td>@if($pm->is_sponsorship == 'yes')
                                  Sponsorship
                                  @else
                                  {{$pm->rate_type}}
                                  @endif</td>
   
                                <td>
                                @if($pm->rate_type == 'rate_per_minute')
                                  {{$pm->rate_per_minute}}
                                @elseif($pm->rate_type == 'rate_per_day')
                                  {{$pm->rate_per_day}}
                                @elseif($pm->rate_type == 'rate_per_spot')
                                  {{$pm->rate_per_spot}}
                                @endif
                                </td>

                                <td>{{$pm->total_unit}}</td>
                            
                                <td>{{$pm->total_amount}}</td>
                                <td>
                                    <div>
                                      <!-- Discount -->
                                      <a class="btn btn-success btn-xs" style="color:#fff" data-toggle="modal" data-target="#discountmodal{{$key}}"><i class="fa fa-money"></i> Discount</a>
                                        <form action="{{route('admin.job_estimate.jobs.update_discount')}}" method="post">
                                        <!-- Modal -->
                                        {{csrf_field()}}
                                        <input type="hidden" name="job_id" value="{{$pm->id}}">
                                        <input type="hidden" name="table_name" value="radio">
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

                                      
                                        <a class="btn btn-primary btn-xs edit_modal_button" data-toggle="modal" data-target="#edit_modal{{$pm->id}}" style="color:#fff" oid="{{$pm->id}}"><i class="fa fa-edit"></i> Edit</a>
                                        <a class="btn btn-danger btn-xs deletenational" style="color:#fff" oid="{{$pm->id}}"><i class="fa fa-trash"></i> </a>
                                    </div>
                                       
                                        <form action="{{URL::TO('/')}}/admin/jobs/update_tv_radio/radio" method="post">
                                          <!-- The Modal -->
                                              
                                              {{csrf_field()}}
                                            <input type="hidden" name="job_id" value="{{$pm->id}}">
                                          <div class="modal edit_modal" id="edit_modal{{$pm->id}}" pid="{{$pm->id}}">
                                            <div class="modal-dialog">
                                              <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                  <h4 class="modal-title">Edit Job</h4>
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                      

                                                      <div class="form-group">
                                                          <lable>Station</lable>
                                                          <select name="vendor_id" class="form-control select2 vendor_change_edit" required>
                                                              <option value="">Select</option>
                                                              @foreach($vendors as $v)
                                                              <option value="{{$v->id}}" @if($v->id == $pm->vendor_id) selected @endif>{{$v->vendor_name}}</option>
                                                              @endforeach

                                                          </select>
                                                      </div>
                                                       <div class="form-group program_change_div">
                                                          <label>Program</label>
                                                          <select name="program" class="form-control select2 program_change_edit">
                                                            @foreach($pm->programs as $pmp)
                                                            <option value="{{$pmp->id}}" @if($pm->program_id == $pmp->id) selected @endif>{{$pmp->program_name}}</option>
                                                            @endforeach

                                                          </select>
                                                          

                                                      </div>

                                                      <div class="form-group position_change_div">
                                                          <label>position</label>
                                                          <select name="position" class="form-control select2 position_change_edit">
                                                            @foreach($pm->positions as $pmp)
                                                            <option value="{{$pmp->id}}" @if($pm->rate_id == $pmp->id) selected @endif>{{$pmp->position}}</option>
                                                            @endforeach

                                                          </select>
                                                      </div>

                                                      <div class="form-group">
                                                        <label>Is Sponsorship?</label>
                                                          <input type="checkbox" name="is_sponsorship" value="{{$pm->is_sponsorship}}" class="is_sponsorship" @if($pm->is_sponsorship == 'yes') checked @endif>
                                                           <input type="hidden" name="is_sponsorship" value="{{$pm->is_sponsorship}}" class="is_sponsorship_text">
                                                      </div>

                                                      <div class="form-group rate_type_change">
                                                          <label>Rate Type</label>
                                                          <select class="form-control select2 rate_type_change_select_edit" name="rate_type">
                                                            <option value="">Select</option>
                                                            <option value="rate_per_minute" @if($pm->rate_type == 'rate_per_minute') selected @endif>Rate per minute</option>
                                                            <option value="rate_per_day" @if($pm->rate_type == 'rate_per_day') selected @endif>Rate per day</option>
                                                            <option value="rate_per_spot" @if($pm->rate_type == 'rate_per_spot') selected @endif>Rate per Spot</option>
                                                          </select>

                                                      </div>

                                                      

                                                      <div class="append_rates_type">
                                                          <div class="form-group rate_per_minute" style=""><label>Rate Per Minute</label><input type="number" name="rate_per_minute" class="form-control" step="0.01" value="{{$pm->rate_per_minute}}"></div>
                                                          <div class="form-group rate_per_day" style="display:none"><label>Rate Per Day</label><input type="number" name="rate_per_day" class="form-control" step="0.01" value="{{$pm->rate_per_day}}"></div>
                                                          <div class="form-group rate_per_spot" style="display:none"><label>Rate Per Spot</label><input type="number" name="rate_per_spot" class="form-control" step="0.01" value="{{$pm->rate_per_spot}}"></div>
                                                      </div>

                                                      
                                                      <div class="append_date_here_edit{{$pm->id}}">
                                                        @foreach($pm->dates as $key=>$pmd)
                                                          <div class="parent_daterangerpicker_edit">
                                                            <div class="col-lg-5 float-left">
                                                              <input type="text" name="dates[{{$key}}][date]" class="form-control daterange_field" id="dates_edit{{$key}}{{$pm->id}}" value="{{date('m/d/Y',strtotime($pmd->date_from))}} - {{date('m/d/Y',strtotime($pmd->date_to))}}">
                                                            </div>
                                                            <div class="col-lg-5 float-left">
                                                              <input type="number" class="form-control frequency_field_edit" step="0.01" name="dates[{{$key}}][spot]" placeholder="No of spots" required value="{{$pmd->spots}}">
                                                            </div>
                                                            <div class="col-lg-2 float-left">
                                                              <a class="btn btn-danger btn-xs delete_frequency_edit" style="color:#fff"><i class="fa fa-trash"></i></a>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                          </div>
                                                        @endforeach
                                                      </div>
                                                      <a class="btn btn-primary btn-xs add_new_datepicker_edit" style="color:#fff" pid="{{$pm->id}}"><i class="fa fa-plus"></i> Add Date</a>

                                                      <div class="form-group total_minute">
                                                         <label>Total Minute</label>
                                                          <input type="number" name="total_unit" class="form-control total_unit" step="0.01" value="{{$pm->total_unit}}">
                                                      </div>
                                                    
                                                       <div class="form-group">
                                                          <label>Amount</label>
                                                          <input type="number" name="total_amount" class="form-control total_amount" step="0.01" readonly="" value="{{$pm->total_amount}}">
                                                      </div>

                                                      
                                                  
                                                     <input type="hidden" name="je_id" value="{{$job_estimate->id}}">

                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                  <button type="submit" class="btn btn-primary">Save</button>
                                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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

<div class="modal add_modal" id="myModal">
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
                <lable>Station</lable>
                <select name="vendor_id" class="form-control select2 vendor_change" required>
                    <option value="">Select</option>
                    @foreach($vendors as $v)
                    <option value="{{$v->id}}">{{$v->vendor_name}}</option>
                    @endforeach

                </select>
            </div>
             <div class="form-group program_change_div" style="display: none">
                <label>Program</label>
                <select name="program" class="form-control select2 program_change">
                  

                </select>
                

            </div>

            <div class="form-group position_change_div" style="display: none">
                <label>position</label>
                <select name="position" class="form-control select2 position_change">
                  

                </select>
            </div>

            <div class="form-group">
              <label>Is Sponsorship?</label>
                <input type="checkbox" name="is_sponsorship" value="yes" class="is_sponsorship">
                <input type="hidden" name="is_sponsorship" value="no" class="is_sponsorship_text">
            </div>

            <div class="form-group rate_type_change" style="display: none">
                <label>Rate Type</label>
                <select class="form-control select2 rate_type_change_select" name="rate_type">
                  <option value="">Select</option>
                  <option value="rate_per_minute">Rate per minute</option>
                  <option value="rate_per_day">Rate per day</option>
                  <option value="rate_per_spot">Rate per Spot</option>
                </select>

            </div>

            <div class="append_rates_type">

            </div>

            
            <div class="append_date_here">
              
            </div>
            <a class="btn btn-primary btn-xs add_new_datepicker" style="color:#fff"><i class="fa fa-plus"></i> Add Date</a>

            <div class="form-group total_minute" style="display: none">
               <label>Total Minute</label>
                <input type="number" name="total_unit" class="form-control total_unit" step="0.01">
            </div>
          
             <div class="form-group">
                <label>Amount</label>
                <input type="number" name="total_amount" class="form-control total_amount" step="0.01" readonly="">
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
<!--                 <div class="col-lg-2 float-left">
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

    $('.duration').keyup(function()
    {
        update_total_amount();
    });
    $('.rate_per_days').keyup(function()
    {
        update_total_amount();
    });
    function update_total_amount()
    {
        var duration = parseFloat($('.duration').val()) || 0;
        var rate_per_days = parseFloat($('.rate_per_days').val()) || 0;
       
        var total = duration * rate_per_days;
        total = total.toFixed(2);
        $('.total_amount').val(total);
    }


    $('.duration_u').keyup(function()
    {
        var duration = parseFloat($(this).val()) || 0;
        var rate_per_days = parseFloat($(this).parents('td').nextAll().find('.rate_per_days_u').val()) || 0;

        var total_amount_u = duration * rate_per_days;

        total_amount_u = total_amount_u.toFixed(2);

        $(this).parents('td').nextAll().find('.total_amount_u').val(total_amount_u);
    });

    $('.rate_per_days_u').keyup(function()
    {
        var rate_per_days = parseFloat($(this).val()) || 0;
        var duration = parseFloat($(this).parents('td').prevAll().find('.duration_u').val()) || 0;
       
        var total_amount_u = duration * rate_per_days;

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
               url:'/admin/job_estimate/jobs/delete/'+ oid + '/radio' ,
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
               url:'/admin/job_estimate/jobs/update/'+ oid + '/radio' ,
               data:{ "_token": "{{ csrf_token() }}",'data' : arrayz},
               success:function(data) {
                if(data)
                {
                  $(z).parents('div').next().hide();
                }
               }
            });
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

      $('.vendor_change').change(function()
      {
          vendor_id = $(this).val() || 0;

           $.ajax({
              url: '/admin/get_program_by_vendor_ajax/' + vendor_id,
              type: 'get',
              data: {},
              success:function(data) {
                  $('.add_modal .rate_per_spot').hide();
                  $('.add_modal .rate_per_minute').hide();
                  $('.add_modal .rate_per_day').hide();
                if(data)
                {
                  $('.add_modal .program_change').html(data);
                  $('.add_modal .program_change_div').show();
                  $('.program_change').change();
                }
                else
                {
                  $('.add_modal .program_change_div').hide();
                  $('.add_modal .position_change_div').hide();
                  $('.add_modal .rate_type_change').hide(); 
                  $('.add_modal .total_minute').hide();
                }
              }
          });

      }).change();

      $('.vendor_change_edit').change(function()
      {
          vendor_id = $(this).val() || 0;

           $.ajax({
              url: '/admin/get_program_by_vendor_ajax/' + vendor_id,
              type: 'get',
              data: {},
              success:function(data) {
                  $('.edit_modal .rate_per_spot').hide();
                  $('.edit_modal .rate_per_minute').hide();
                  $('.edit_modal .rate_per_day').hide();
                if(data)
                {
                  $('.edit_modal .program_change_edit').html(data);
                  $('.edit_modal .program_change_div').show();
                  $('.program_change_edit').change();
                }
                else
                {
                  $('.edit_modal .program_change_div').hide();
                  $('.edit_modal .position_change_div').hide();
                  $('.edit_modal .rate_type_change').hide(); 
                  $('.edit_modal .total_minute').hide();
                }
              }
          });

      });


      $('.program_change').change(function()
      {
          program_id = $(this).val() || 0;

           $.ajax({
              url: '/admin/get_position_by_program_ajax/' + program_id,
              type: 'get',
              data: {},
              success:function(data) {
                if(data)
                {
                  $('.add_modal .position_change').html(data);
                  $('.add_modal .rate_per_spot').hide();
                  $('.add_modal .rate_per_minute').hide();
                  $('.add_modal .rate_per_day').hide(); 
                  $('.add_modal .position_change_div').show();
                  $('.position_change').change();
                }
                else
                {
                  $('.add_modal .position_change_div').hide();
                  $('.add_modal .rate_type_change').hide(); 
                  $('.add_modal .rate_per_minute').hide();
                   $('.add_modal .total_minute').hide();
                }


                  
              }
          });

      }).change();

       $('.program_change_edit').change(function()
      {
          program_id = $(this).val() || 0;

           $.ajax({
              url: '/admin/get_position_by_program_ajax/' + program_id,
              type: 'get',
              data: {},
              success:function(data) {
                if(data)
                {
                  $('.edit_modal .position_change_edit').html(data);
                  $('.edit_modal .rate_per_spot').hide();
                  $('.edit_modal .rate_per_minute').hide();
                  $('.edit_modal .rate_per_day').hide(); 
                  $('.edit_modal .position_change_div').show();
                  $('.position_change_edit').change();
                }
                else
                {
                  $('.edit_modal .position_change_div').hide();
                  $('.edit_modal .rate_type_change').hide(); 
                  $('.edit_modal .rate_per_minute').hide();
                   $('.edit_modal .total_minute').hide();
                }


                  
              }
          });

      });

        $(document).on('change','.position_change',function()
      {
          pid = $(this).val() || 0;

           $.ajax({
              url: '/admin/get_rate_by_position_ajax/' + pid,
              type: 'get',
              data: {},
              success:function(data) {
                console.log(data);
                if(data)
                {
                  $('.add_modal .rate_type_change').show();
                  $('.add_modal .append_rates_type').html(data);
                  $('.add_modal .rate_type_change').show(); 
                  $('.rate_type_change_select').change();
                }
                else
                {
                  $('.add_modal .rate_type_change').hide(); 
                  $('.add_modal .rate_per_minute').hide();
                   $('.add_modal .total_minute').hide();
                }
              }
          });

      });

      $(document).on('change','.position_change_edit',function()
      {
          pid = $(this).val() || 0;

           $.ajax({
              url: '/admin/get_rate_by_position_ajax/' + pid,
              type: 'get',
              data: {},
              success:function(data) {
                console.log(data);
                if(data)
                {
                  $('.edit_modal .rate_type_change').show();
                  $('.edit_modal .append_rates_type').html(data);
                  $('.edit_modal .rate_type_change').show(); 
                   $('.rate_type_change_select_edit').change();
                }
                else
                {
                  $('.edit_modal .rate_type_change').hide(); 
                  $('.edit_modal .rate_per_minute').hide();
                   $('.edit_modal .total_minute').hide();
                }
              }
          });

      });



      $(document).on('change','.rate_type_change_select',function()
      {

        var rate_type = $(this).val();
        $('.add_modal .rate_per_spot').hide();
        $('.add_modal .rate_per_minute').hide();
        $('.add_modal .rate_per_day').hide(); 
        $('.add_modal .total_minute').hide();
        if(rate_type == 'rate_per_day')
        {
          $('.add_modal .rate_per_day').show();
        }
        else if(rate_type == 'rate_per_minute')
        {
          $('.add_modal .rate_per_minute').show();
          $('.add_modal .total_minute').show();
        }
        else if(rate_type == 'rate_per_spot')
        {
          $('.add_modal .rate_per_spot').show();
        }

      });

      $(document).on('change','.rate_type_change_select_edit',function()
      {
      
        var rate_type = $(this).val();

        var z = $(this).parents('.edit_modal');

        $(z).find('.rate_per_spot').hide();
       $(z).find('.rate_per_minute').hide();
        $(z).find('.rate_per_day').hide(); 
        $(z).find('.total_minute').hide();
        if(rate_type == 'rate_per_day')
        {
          $(z).find('.rate_per_day').show();
        }
        else if(rate_type == 'rate_per_minute')
        {

          $(z).find('.rate_per_minute').show();
          $(z).find('.total_minute').show();
        }
        else if(rate_type == 'rate_per_spot')
        {
          $(z).find('.rate_per_spot').show();
        }

      });


     


      $('.add_new_datepicker').click(function()
      {
        var length = $('.add_modal .append_date_here input').length;

          var input = '<div class="parent_daterangerpicker"><div class="col-lg-5 float-left"><input type="text" name="dates['+length+'][date]" class="form-control daterange_field" id="dates'+length+'"></div><div class="col-lg-5 float-left"><input type="number" class="form-control frequency_field" step="0.01" name="dates['+length+'][spot]" placeholder="No of spots" required></div><div class="col-lg-2 float-left"><a class="btn btn-danger btn-xs delete_frequency" style="color:#fff"><i class="fa fa-trash"></i></a></div><div class="clearfix"></div></div>';
            $('.add_modal .append_date_here').append(input);
            $('#dates' + length).daterangepicker({ 

            })

            $('#dates' + length).on('change', function (e) { 
              
                      calculate_total_frequency_days();
              });
      });

      $('.add_new_datepicker_edit').click(function()
      {
        var pid = $(this).attr('pid');
        var length = $('.parent_daterangerpicker_edit').length;

          var input = '<div class="parent_daterangerpicker_edit"><div class="col-lg-5 float-left"><input type="text" name="dates['+length+'][date]" class="form-control daterange_field" id="dates_edit'+length+pid+'"></div><div class="col-lg-5 float-left"><input type="number" class="form-control frequency_field_edit" step="0.01" name="dates['+length+'][spot]" placeholder="No of Spots" required></div><div class="col-lg-2 float-left"><a class="btn btn-danger btn-xs delete_frequency_edit" style="color:#fff"><i class="fa fa-trash"></i></a></div><div class="clearfix"></div></div>';

            $('.append_date_here_edit' + pid).append(input);
            $('#dates_edit' + length + pid).daterangepicker({ 

            });



            $('#dates_edit' + length + pid).on('change', function (e) { 
                    
                    var pid = $(this).parents('.edit_modal').attr('pid');

                      calculate_total_frequency_days_edit(pid);
              });
      });

      $('.edit_modal_button').click(function()
      {
      
        $('.rate_type_change_select_edit').change();

        $('.edit_modal .parent_daterangerpicker_edit .daterange_field').each(function()
        {
            $(this).daterangepicker();
        });

        var is_sponsorship = $(this).parent().next().find('.is_sponsorship').val();


       if(is_sponsorship == 'yes')
        {
            $('.rate_type_change').hide();
            $('.rate_per_day').hide();
            $('.rate_per_spot').hide();
            $('.rate_per_minute').hide();
            $('.total_minute').hide();

            $('.total_amount').removeAttr('readonly');
        }

      });

      $('.modal').on('hidden.bs.modal', function () {
          // do something…
          window.location.reload();
        });
      $(document).on('click','.applyBtn',function()
      {
        calculate_total_frequency_days();
      });

      $(document).on('click','.delete_frequency',function()
      {
        $(this).parents('.parent_daterangerpicker').remove();
        calculate_total_frequency_days();
      });

      $(document).on('click','.delete_frequency_edit',function()
      {
        $(this).parents('.parent_daterangerpicker_edit').remove();
        calculate_total_frequency_days();
      });

      $(document).on('keyup','.frequency_field',function()
      {
          calculate_total_frequency_days();
      });

       $(document).on('keyup','.frequency_field_edit',function()
      {
        var pid = $(this).parents('.edit_modal').attr('pid');
          calculate_total_frequency_days_edit(pid);
      });


      $('.add_modal .total_unit').keyup(function()
      {
        calculate_total_frequency_days();
      });

      $('.edit_modal .total_unit').keyup(function()
      {
         var pid = $(this).parents('.edit_modal').attr('pid');
         calculate_total_frequency_days_edit(pid);
      });


      function calculate_total_frequency_days()
      {
        var total = 0;

        var rate_type = $('.add_modal .rate_type_change_select').val();



        $('.add_modal .parent_daterangerpicker').each(function(index,item)
        {
            var frequency = parseFloat($(this).find('.frequency_field').val()) || 0;
            var date = $(this).find('.daterange_field').val();
            date = date.split('-');
            var a = new Date(date[0]);
            var b = new Date(date[1]);
            var c = new Date(b - a);
            diffDays = c/1000/60/60/24;
            diffDays = diffDays + 1;
           if(rate_type == 'rate_per_minute')
           {

              total+= (diffDays * frequency);
           }
           else if(rate_type == 'rate_per_day')
           {
              total+= diffDays;
           }
           else if(rate_type == 'rate_per_spot')
           {
              total+= (diffDays * frequency);
           }
          
        });
              var total_frequency_days = total;
             
              var final_total = 0;
        
          if(rate_type == 'rate_per_minute')
          {
              var rate = parseFloat($('.add_modal .rate_per_minute').find('input').val()) || 0;
              var total_minute = parseFloat($('.add_modal .total_minute').find('input').val()) || 0;
               final_total = rate * total_frequency_days * total_minute;
          }

          if(rate_type == 'rate_per_spot')
          {
              var rate = parseFloat($('.add_modal .rate_per_spot').find('input').val()) || 0;
              
               final_total = rate * total_frequency_days;
          }

          if(rate_type == 'rate_per_day')
          {
              var rate = parseFloat($('.add_modal .rate_per_day').find('input').val()) || 0;
              final_total = rate * total_frequency_days;
          }

              final_total = final_total.toFixed(2);
              $('.add_modal .total_amount').val(final_total);
        
      }


      function calculate_total_frequency_days_edit(id)
      {
        var total = 0;
       
        var rate_type = $('#edit_modal'+id+' .rate_type_change_select_edit').val();

  

        $('#edit_modal'+id+' .parent_daterangerpicker_edit').each(function(index,item)
        {
            var frequency = parseFloat($(this).find('.frequency_field_edit').val()) || 0;
            var date = $(this).find('.daterange_field').val();
            date = date.split('-');
            var a = new Date(date[0]);
            var b = new Date(date[1]);
            var c = new Date(b - a);
            diffDays = c/1000/60/60/24;
            diffDays = diffDays + 1;
           if(rate_type == 'rate_per_minute')
           {

              total+= (diffDays * frequency);
           }
           else if(rate_type == 'rate_per_day')
           {
              total+= diffDays;
           }
           else if(rate_type == 'rate_per_spot')
           {
              total+= (diffDays * frequency);
           }
          
        });
              var total_frequency_days = total;
             
              var final_total = 0;
        
          if(rate_type == 'rate_per_minute')
          {
              var rate = parseFloat($('#edit_modal'+id+' .rate_per_minute').find('input').val()) || 0;
              var total_minute = parseFloat($('#edit_modal'+id+' .total_minute').find('input').val()) || 0;
               final_total = rate * total_frequency_days * total_minute;
          }

          if(rate_type == 'rate_per_spot')
          {
              var rate = parseFloat($('#edit_modal'+id+' .rate_per_spot').find('input').val()) || 0;
              
               final_total = rate * total_frequency_days;
          }

          if(rate_type == 'rate_per_day')
          {
              var rate = parseFloat($('#edit_modal'+id+' .rate_per_day').find('input').val()) || 0;
              final_total = rate * total_frequency_days;
          }

              final_total = final_total.toFixed(2);
              $('#edit_modal'+id+' .total_amount').val(final_total);
        
      }

      $(document).on('keyup','.add_modal .rate_per_minute input',function()
      {
          calculate_total_frequency_days();
      });

       $(document).on('keyup','.add_modal .rate_per_spot input',function()
      {
          calculate_total_frequency_days();
      });

      $(document).on('keyup','.add_modal .rate_per_day input',function()
      {
          calculate_total_frequency_days();
      });


      $('.edit_modal .rate_per_minute input').keyup(function()
      {
       var pid = $(this).parents('.edit_modal').attr('pid');
      
        calculate_total_frequency_days_edit(pid);
      });

       $('.edit_modal .rate_per_spot input').keyup(function()
      {
       var pid = $(this).parents('.edit_modal').attr('pid');
      
        calculate_total_frequency_days_edit(pid);
      });

       $('.edit_modal .rate_per_day input').keyup(function()
      {
       var pid = $(this).parents('.edit_modal').attr('pid');
      
       calculate_total_frequency_days_edit(pid);
      });


       $('.is_sponsorship').click(function()
       {
        var checked = $(this).is(":checked");

        if(checked)
        {
            $('.rate_type_change').hide();
            $('.rate_per_day').hide();
            $('.rate_per_spot').hide();
            $('.rate_per_minute').hide();
            $('.total_minute').hide();

            $('.is_sponsorship_text').val('yes');

            $('.total_amount').removeAttr('readonly');
        }
        else
        {
           $('.rate_type_change').show();
           $('.rate_per_day').show();
           $('.rate_per_spot').show();
           $('.rate_per_minute').show();
           $('.total_unit').show();

           $('.total_amount').attr('readonly','readonly');
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
