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
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Rate</th>
                            <th>Amount</th>
                            <th>Actions</th>
                        </thead>

                        <tbody>
                            @foreach($jobs as $key=>$oj)   
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td><input type="text" value="{{$oj->description}}" class="form-control update_only_field" name="description"></td>
                                
                                <td><input type="number" value="{{$oj->quantity}}" class="form-control quantity_u update_only_field" step="0.01" name="quantity"></td>
                                <td><input type="number" value="{{$oj->rate}}" class="form-control rate_u update_only_field" step="0.01" name="rate"></td>
                                <td><input type="number" value="{{$oj->total_amount}}" class="form-control total_amount_u update_only_field" step="0.01" name="total_amount" readonly></td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-success btn-xs" style="color:#fff" data-toggle="modal" data-target="#discountmodal{{$key}}"><i class="fa fa-money"></i> Discount</a>
                                        <form action="{{route('admin.job_estimate.jobs.update_discount')}}" method="post">
                                        <!-- Modal -->
                                        {{csrf_field()}}
                                        <input type="hidden" name="job_id" value="{{$oj->id}}">
                                        <input type="hidden" name="table_name" value="others">
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
                                                          @foreach($oj->discounts as $diskey=>$od)
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

                                                    @if(!$oj->discounts->contains('discount_id',$di->id))
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
                                        <a class="btn btn-primary btn-xs update_now" style="color:#fff" oid="{{$oj->id}}"><i class="fa fa-edit"></i> update</a>
                                        <a class="btn btn-danger btn-xs deleteother" style="color:#fff" oid="{{$oj->id}}"><i class="fa fa-trash"></i> </a>
                                    </div>
                                        <div class="updating">
                                            Updating . . .
                                        </div>
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
                <label>Description</label>
                <input type="text" name="description" class="form-control">
            </div>
            <div class="form-group">
                <label>Quantity</label>
                <input type="number" name="quantity" class="form-control quantity" step="0.01">
            </div>
             <div class="form-group">
                <label>Rate</label>
                <input type="number" name="rate" class="form-control rate" step="0.01">
            </div>
             <div class="form-group">
                <label>Total Amount</label>
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
               <!--  <div class="col-lg-2 float-left">
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
        <button type="submit" class="btn btn-success">Create New</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

</form>



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
    $('.quantity').keyup(function()
    {
        update_total_amount();
    });
    $('.rate').keyup(function()
    {
        update_total_amount();
    });
    function update_total_amount()
    {
        var cost = parseFloat($('.quantity').val()) || 0;
        var duration = parseFloat($('.rate').val()) || 0;
        var total = cost * duration;
        total = total.toFixed(2);
        $('.total_amount').val(total);
    }


    $('.quantity_u').keyup(function()
    {

        var quantity = parseFloat($(this).val()) || 0;
        var rate = parseFloat($(this).parents('td').nextAll().find('.rate_u').val()) || 0;

        var total_amount_u = quantity * rate;

        total_amount_u = total_amount_u.toFixed(2);



        $(this).parents('td').nextAll().find('.total_amount_u').val(total_amount_u);
    });

    $('.rate_u').keyup(function()
    {
        var rate = parseFloat($(this).val()) || 0;
        var quantity = parseFloat($(this).parents('td').prevAll().find('.quantity_u').val()) || 0;

        var total_amount_u = rate * quantity;

        total_amount_u = total_amount_u.toFixed(2);

        $(this).parents('td').nextAll().find('.total_amount_u').val(total_amount_u);
    });
    


    $('.deleteother').click(function(e)
    {   
        
      var status = confirm("Are you sure?");
      if(status)
      {

          var oid = $(this).attr('oid');
          var z = $(this);
          $.ajax({
                 type:'POST',
                 url:'/admin/job_estimate/jobs/delete/'+ oid + '/others' ,
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


         $(z).parents('tr').find('input.update_only_field').each(function(index,item)
         {
            var name = $(item).attr('name');
            var value = $(item).val();
            arrayz[name] = value;
         });

            arrayz = Object.assign({}, arrayz);



            $(z).parents('div').next().show();

          $.ajax({
               type:'POST',
               url:'/admin/job_estimate/jobs/update/'+ oid + '/others' ,
               data:{ "_token": "{{ csrf_token() }}",'data' : arrayz},
               success:function(data) {
                if(data)
                {
                  $(z).parents('div').next().hide();
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

});

</script>

<style>
.updating
{
    display: none;
}
</style>


@endsection
