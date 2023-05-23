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
      <div class="col-xs-12">
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


            <table class="table table-bordered">
              <thead>
                  <th>S.N</th>
                  <th>Portal Name</th>
                  <th>Category</th>
                  <th>Cost per month</th>
                  <th>Duration</th>
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
                    <td>{{$key + 1}}</td>
                    <td>{{$oj->portal_name}}</td>
                    <td>{{$oj->category}}</td>
                    <td>{{$oj->cost_per_month}}</td>
                    <td>{{$oj->duration}}</td>
                    <td>{{$oj->total_amount}}</td>
                  </tr>

                  <?php
                    //50000
                  $sumtotal+= $oj->total_amount;
                   $total = $oj->total_amount;
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
                      <td colspan="2">Total Amount</td>
                      <td>{{$sumtotal}}</td>
                    </tr>
                
                @if($discount_array)
                  @foreach($discount_array as $dkey=>$da)
                    <tr>
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
                      <td colspan="2">Agency Discount</td>
                      <td><b>{{round($agency_discount,5)}}</b></td>
                  </tr>
                @endif
                 <tr>
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
              <td>{{$oj->cost_per_month}} (Actual Rate)</td>
              @php
                $total =15;
                $rate_after_discount =$oj->cost_per_month;
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
table td
{
  padding:3px !important;
}
img {
    -webkit-print-color-adjust: exact;
}

</style>


@endsection
