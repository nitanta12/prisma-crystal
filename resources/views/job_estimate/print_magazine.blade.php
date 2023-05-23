@extends('layouts.admin')

@section('content')
<div class="card">

  <div class="card-header">
      <a class="btn btn-primary pull-right btn-xs" href="javascript:window.print()" style="color:#fff"><i class="fa fa-print"></i> Print</a>
  </div>
    
    <div class="card-body myDivToPrint">
      <div class="col-sm-6 float-left">
        <img src="{{asset('images/Prisma.gif')}}" style="height:80px">
      </div>

      <div class="col-xs-6 float-right" style="text-align: right">
        <br/>
        <p>Prisma Advertising</p>
        <p>Kalikasthan, Kathmandu</p>
        <p>Tel: 4-443351 / 4-4393831, 4-4398831 Fax No : 4-439382</p>
      </div>
      <div class="clearfix"></div>
      <br/>
      <center><span>Job Estimate</span></center>

      <div class="col-xs-12" style="text-align: right">
          <p>Date : {{date('Y-m-d')}}</p>
          <p>Job Estimate No. :  {{$job_estimate->je_name}}</p>
      </div>
      <div class="clearfix"></div>
      <div class="col-xs-12 table-responsive">
          <table class="table" style="width:350px;border:none">
            <tr>
              <td>Client : </td>
              <td>{{$campaign->client_name}}</td>
            </tr>
             <tr>
              <td>Address : </td>
              <td>{{$campaign->client_address}}</td>
            </tr>
            <tr>
              <td>Phone No : </td>
              <td>{{$campaign->client_phone}}</td>
            </tr>
            <tr>
              <td>Brand : </td>
              <td>{{$campaign->client_brand}}</td>
            </tr>
            <tr>
              <td>Campaign : </td>
              <td>{{$campaign->campaign_name}}</td>
            </tr>
            <tr>
              <td>Media : </td>
              <td>@php
                    $media = explode('-',$job_estimate->je_name);

                @endphp
                {{$media[1]}}
              </td>
            </tr>
            </table>


            <table class="table table-bordered border-table" cellspacing="0" cellpadding="0">
              <thead>
                
                  <th>Publication</th>
                  <th>Size(cc)</th>
                  <th>Break</th>
                  <th>Position</th>
                  <th>Type</th>
                  <th>Rate/cc</th>
                  <th>Ins.</th>
                  <th>Amount</th>
              </thead>

              <tbody>
                @php
                  $total = 0;
                  $discount_array = [];
                  $charges_array = [];
                  $total_charge = 0;
                  $grandest_total = 0;
                  $all_discounts = 0;
                  $sumtotal = 0;
                @endphp

               
                <!-- job loop -->
                @foreach($jobs as $key=>$oj)
                 
                  <tr>
                  
                    <td>{{$oj->publication}}</td>
                    <td>{{$oj->size}}</td>
                    <td>{{$oj->break}}</td>
                    <td>{{$oj->position}}</td>
                    <td>{{$oj->color_type}}</td>
                    <td>{{$oj->rate_per_cc}}</td>
                    <td>{{$oj->inc}}</td>
                    <td>{{$oj->amount}}</td>
                    <td>
                        <table class="table table-bordered" style="font-size:11px">

                        @if(isset($oj->months))
                          @foreach($oj->months as $key=>$ojm)
                          <tr>
                                <td colspan="{{count($ojm)}}" style="text-align:center">{{$key}}</td>
                          </tr>
                            <tr>
                              @foreach($ojm as $dayskey=>$days)
                                <td>{{$dayskey}}</td>
                              @endforeach
                            </tr>
                            <tr>
                              @foreach($ojm as $dayskey=>$days)
                                <td>{{substr($days['weekday'],0,1)}}</td>
                              @endforeach
                            </tr>
                            <tr>
                              @foreach($ojm as $dayskey=>$days)
                                <td style="height:25px">
                                  @if($days['day'])
                                    1
                                  @endif
                                </td>
                              @endforeach
                            </tr>
                          @endforeach
                        @endif

                        </table>

                    </td>
                  </tr>


                   <?php
                    //50000
                  $sumtotal+= $oj->amount;
                   $total = $oj->amount;
                   $grandest_total = $total + $grandest_total;
                    foreach($oj->discounts as $ojd)
                    {
                      if(!isset($discount_array[$ojd->discounts->discount_name]))
                      {
                        $discount_array[$ojd->discounts->discount_name]=0;
                      }
            
                      if($ojd->discount_percentage)
                        {
                          $discount_array[$ojd->discounts->discount_name]+= round((($ojd->discount_percentage * $total) / 100),5); 
                          $all_discounts += round((($ojd->discount_percentage * $total) / 100),5);
                          
                        }
                        else
                        {
                          $discount_array[$ojd->discounts->discount_name]+=round($ojd->discount_amount,5);
                          $all_discounts += round($ojd->discount_amount,5);
                          
                        }



                        $total = $total - round((($ojd->discount_percentage * $total) / 100),5);
                        
                    }

                   ?>
                @endforeach

                 <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td colspan="2">Total Amount</td>
                      <td>{{$sumtotal}}</td>
                    </tr>
                
                @if($discount_array)
                  @foreach($discount_array as $dkey=>$da)
                    <tr>
                     
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td colspan="2">{{$dkey}}</td>
                      <td>{{$da}}</td>
                    </tr>
                   
                  @endforeach
               @endif

                <?php 
                $net_total = $grandest_total - $all_discounts;
                $agency_discount_percentage = 0;
                ?>
                <?php
                 foreach($job_estimate->charges as $jec)
                    {
                      if($jec->charges->charge_name != 'Agency Discount')
                      {
                         if(!isset($charges_array[$jec->charges->charge_name]))
                        {
                          $charges_array[$jec->charges->charge_name]=0;
                        }
                      
                        if($jec->charge_percentage)
                        {
                          $charges_array[$jec->charges->charge_name]+=round((($jec->charge_percentage*$net_total)/ 100),5); 
                        }
                        else
                        {
                          $charges_array[$jec->charges->charge_name]+=round($jec->charge_amount,5);
                        }
                      }
                      else
                      {
                        $charges_array[$jec->charges->charge_name]=$jec->charge_percentage;
                      }
                    }
                ?>

              

                @if($charges_array)
                  @foreach($charges_array as $ckey=>$ca)
                    @if($ckey != 'Agency Discount')
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2">{{$ckey}}</td>
                        <td>{{$ca}}</td>
                      </tr>
                      @php
                        $total_charge+=$ca;
                      @endphp
                    @else
                      @php
                       $agency_discount_percentage = $ca;
                      @endphp
                    @endif
                  @endforeach

               @endif
               @php
                $total_before_vat  = $net_total + $total_charge;
                $agency_discount = (($total_before_vat * $agency_discount_percentage)/100);
                $total_before_vat = $total_before_vat - $agency_discount
               @endphp

               @if($agency_discount > 0)
                 <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td colspan="2">Agency Discount</td>
                      <td><b>{{round($agency_discount,5)}}</b></td>
                  </tr>
                @endif
                 <tr>
                    
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    <td colspan="2">Total</td>
                    <td><b>{{$total_before_vat}}</b></td>
                </tr>
                @php
                  $vat = round(($total_before_vat * 13 )/ 100,5);
                @endphp
                <tr>
                   
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    <td colspan="2">VAT 13 %</td>
                    <td><b>{{$vat}}</b></td>
                </tr>
                 @php
                  $final_total = $total_before_vat + $vat;
                @endphp
                 <tr>
                   
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    <td colspan="2">Grand Total</td>
                    <td><b>{{$final_total}}</b></td>
                </tr>
              </tbody>

            </table>

          <p>In Words</p>
          <b>
            @php
             $f = new NumberFormatter($locale = "en_IN", NumberFormatter::SPELLOUT);
             echo $f->format($final_total) . ' only /-';
            @endphp

          </b>

      </div>
      <br/><br/> 
       <h6>Discounts</h6>
      <table class="table table-bordered border-table">
        <tbody>
          @foreach($jobs as $key=>$oj)
            @if($oj->discounts->count() > 0)
            <tr>
              <td>{{$oj->publication}} (Publication)</td>
              <td>{{$oj->rate_per_cc}} (Actual Rate)</td>
              @php
                $rate_after_discount =$oj->rate_per_cc;
              @endphp
              @foreach($oj->discounts as $ojd)
                @php

                

                  $rate_after_discount = $rate_after_discount - round(($rate_after_discount * $ojd->discount_percentage) / 100,5);
                @endphp

                <td>{{ $rate_after_discount }} ({{$ojd->discounts->discount_name}} {{$ojd->discount_percentage}}%)
                 </td>
              @endforeach

          </tr>
          @endif
          @endforeach
        </tbody>
      </table>
      <div class="">   
        <div class="col-sm-3 float-left">
          Prepared By <br/> <br/>
          ________________________
          <br/>
          @php
            $user = App\User::find($campaign->user_id)->name;
          @endphp
          {{$user}}<br/>
          Client Servicing Department<br/>
          Prisma Advertising<br/>
          {{date('F j, Y')}}
        </div>
         <div class="col-sm-3 float-left">
          Recommenderd/Checked By <br/> <br/>
          ________________________
          <br/>
          Prisma Advertising<br/>
          {{date('F j, Y')}}
        </div>
         <div class="col-sm-3 float-left">
          Recommended By <br/> <br/>
          ________________________
          <br/>
          {{$campaign->client_name}}<br/>
          {{$campaign->client_address}}<br/>
          {{date('F j, Y')}}
        </div>
         <div class="col-sm-3 float-left">
          Approved By <br/> <br/>
          ________________________
          <br/>
          {{$campaign->client_name}}<br/>
          {{$campaign->client_address}}<br/>
           {{date('F j, Y')}}
        </div>
      </div>


    </div>
</div>


<style>
p
{
  margin-bottom: 0; 
}
.underline
{
  text-decoration: underline;
}
.border-table td,th
{
  padding:0px !important;
  border:1px #000 solid !important;

}
.table td,th
{
  padding: 0px !important;
}
img {
    -webkit-print-color-adjust: exact;
}

.card
{
  font-size:12px;
  font-weight: 600;

}

</style>


@endsection
