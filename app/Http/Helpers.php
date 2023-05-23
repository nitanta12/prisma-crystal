<?php

namespace App\Helper;

use App\RequestBill;
use App\Models\JobEstimate;
use App\Helper\Calculation;
use App\Models\NationalDaily;
use App\Models\LocalNewspaper;
use App\Models\Magazine;
use App\Models\Movie;
use App\Models\OnlinePortal;
use App\Models\Others;
use App\Models\Radio;
use App\Models\Tv;

class Calculation
{

 	public static function get_total_all($bills)
	{

           foreach($bills as $jb)
           {
              $jb->all_calculation =  Calculation::calculate_total_amount($jb->je_id);
           }

          return $bills;

	}

	public static function calculate_total_amount($je_id)
	{
		$job_estimate = JobEstimate::find($je_id);

		$table = $job_estimate->table_type;
		
		if($table == 'national_daily')
		{
			$jobs = NationalDaily::where('je_id',$je_id)->get();
		}
		if($table == 'local_newspaper')
		{
			$jobs = LocalNewspaper::where('je_id',$je_id)->get();
		}
		if($table == 'magazine')
		{
			$jobs = Magazine::where('je_id',$je_id)->get();
		}
		if($table == 'movie')
		{
			$jobs = Movie::where('je_id',$je_id)->get();
		}
		if($table == 'online_portal')
		{
			$jobs = OnlinePortal::where('je_id',$je_id)->get();
		}
		if($table == 'others')
		{
			$jobs = Others::where('je_id',$je_id)->get();
		}
		if($table == 'radio')
		{
			$jobs = Radio::where('je_id',$je_id)->get();
		}
		if($table == 'tv')
		{
			$jobs = Tv::where('je_id',$je_id)->get();
		}

		    $total = 0;
        $discount_array = [];
        $charges_array = [];
        $total_charge = 0;
        $grandest_total = 0;
        $all_discounts = 0;
        $sumtotal = 0;	
        $total_before_vat = 0;
        $net_total = 0;
        $agency_discount_percentage = 0;
        $vat = 0;
        $all_discounts= 0;
        $agency_discount = 0;

        $final_data = [];

        $final_data['total_discount'] = 0;
        $final_data['total_amount'] =  0;
        $final_data['agency_discount'] =  0;
        $final_data['total_charges'] = 0;
        $final_data['total_before_vat']  = 0;
        $final_data['vat'] =0;

        $final_data['final_total'] = 0;

        foreach($jobs as $oj)
        {         
                  $total_charge = 0;
                  $charges_array = [];
                  $discount_array =[];


                  if($table == 'national_daily' || $table == 'local_newspaper' || $table=='magazine')
                  {
                       $sumtotal+= $oj->amount;
                       $total = $oj->amount;
                  }
                  elseif($table == 'movie')
                  {
                      $sumtotal+= $oj->rate_per_month;
                      $total = $oj->rate_per_month;
                  }
                  else
                  {
            		       $sumtotal+= $oj->total_amount;
                       $total = $oj->total_amount;
                  }

                   $grandest_total = $total + $grandest_total;
                    foreach($oj->discounts as $ojd)
                    {
                      if(!isset($discount_array[$ojd->discounts->discount_name]))
                      {
                        $discount_array[$ojd->discounts->discount_name]=0;
                      }
            
                      if($ojd->discount_percentage)
                        {
                          $discount_array[$ojd->discounts->discount_name]+= round((($ojd->discount_percentage * $total) / 100),2); 
                          $all_discounts += round((($ojd->discount_percentage * $total) / 100),2);
                          
                        }
                        else
                        {
                          $discount_array[$ojd->discounts->discount_name]+=round($ojd->discount_amount,2);
                          $all_discounts += round($ojd->discount_amount,2);
                          
                        }

                        $total = $total - round((($ojd->discount_percentage * $total) / 100),2);
                        
                    }

           			$final_data['total_discount'] = $all_discounts;
           			$final_data['total_amount'] =  $sumtotal;

         			    $net_total = $grandest_total - $all_discounts;
                	$agency_discount_percentage = 0;

                  

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
                          $charges_array[$jec->charges->charge_name]+=round((($jec->charge_percentage*$net_total)/ 100),2); 
                        }
                        else
                        {
                          $charges_array[$jec->charges->charge_name]+=round($jec->charge_amount,2);
                        }
                      }
                      else
                      {
                        $charges_array[$jec->charges->charge_name]=$jec->charge_percentage;
                      }
                    }


                   

                    if($charges_array)
                    {
                    	foreach($charges_array as $ckey=>$ca)
                    	{
		                    if($ckey != 'Agency Discount')
		                    {
		                    	
		                        $total_charge+=$ca;
		                    }
		                    else
		                    {
			                   $agency_discount_percentage = $ca;
			                     
		                    }

		                   }
		                      
	                 }

                 

	              $total_before_vat  = $net_total + $total_charge;
                $agency_discount = (($total_before_vat * $agency_discount_percentage)/100);
                $total_before_vat = $total_before_vat - $agency_discount;
                $vat = round(($total_before_vat * 13 )/ 100,2);

                $final_data['total_before_vat']  = $total_before_vat;
                $final_data['agency_discount'] =  $agency_discount;
                $final_data['total_charges'] = $total_charge;
                $final_data['vat'] = $vat;
                $final_data['final_total'] = $total_before_vat + $vat;


        }

        return $final_data;	

	}

  public static function calculate_total_amount_vendor_only($je_id,$vendor_id)
  { 

    $job_estimate = JobEstimate::where('je_name',$je_id)->first();


    if($job_estimate)
    {
      $table = $job_estimate->table_type;
      $je_id = $job_estimate->id;
    }
    else
    {
      $table = '';
    }
    
    if($table == 'national_daily')
    {
      $jobs = NationalDaily::where('je_id',$je_id)->where('vendor_id',$vendor_id)->get();
    }
    if($table == 'local_newspaper')
    {
      $jobs = LocalNewspaper::where('je_id',$je_id)->where('vendor_id',$vendor_id)->get();
    }
    if($table == 'magazine')
    {
      $jobs = Magazine::where('je_id',$je_id)->where('vendor_id',$vendor_id)->get();
    }
    if($table == 'movie')
    {

      $jobs = Movie::where('je_id',$je_id)->where('vendor_id',$vendor_id)->get();
      
    }
    if($table == 'online_portal')
    {
      $jobs = OnlinePortal::where('je_id',$je_id)->where('vendor_id',$vendor_id)->get();
    }
    if($table == 'others')
    {
      $jobs = Others::where('je_id',$je_id)->where('vendor_id',$vendor_id)->get();
    }
    if($table == 'radio')
    {
      $jobs = Radio::where('je_id',$je_id)->where('vendor_id',$vendor_id)->get();
    }
    if($table == 'tv')
    {
      $jobs = Tv::where('je_id',$je_id)->where('vendor_id',$vendor_id)->get();
    }

        $total = 0;
        $discount_array = [];
        $charges_array = [];
        $total_charge = 0;
        $grandest_total = 0;
        $all_discounts = 0;
        $sumtotal = 0;  
        $total_before_vat = 0;
        $net_total = 0;
        $agency_discount_percentage = 0;
        $vat = 0;
        $all_discounts= 0;
        $agency_discount = 0;

        $final_data = [];

        $final_data['total_discount'] = 0;
        $final_data['total_amount'] =  0;
        $final_data['agency_discount'] =  0;
        $final_data['total_charges'] = 0;
        $final_data['total_before_vat']  = 0;
        $final_data['vat'] =0;

        $final_data['final_total'] = 0;
      if(isset($jobs))
      {
        foreach($jobs as $oj)
        {         
                  $total_charge = 0;
                  $charges_array = [];
                  $discount_array =[];


                  if($table == 'national_daily' || $table == 'local_newspaper' || $table=='magazine')
                  {
                       $sumtotal+= $oj->amount;
                       $total = $oj->amount;
                  }
                  elseif($table == 'movie')
                  {
                      $sumtotal+= $oj->rate_per_month;
                      $total = $oj->rate_per_month;
                  }
                  else
                  {
                       $sumtotal+= $oj->total_amount;
                       $total = $oj->total_amount;
                  }

                   $grandest_total = $total + $grandest_total;
                    foreach($oj->discounts as $ojd)
                    {
                      if(!isset($discount_array[$ojd->discounts->discount_name]))
                      {
                        $discount_array[$ojd->discounts->discount_name]=0;
                      }
            
                      if($ojd->discount_percentage)
                        {
                          $discount_array[$ojd->discounts->discount_name]+= round((($ojd->discount_percentage * $total) / 100),2); 
                          $all_discounts += round((($ojd->discount_percentage * $total) / 100),2);
                          
                        }
                        else
                        {
                          $discount_array[$ojd->discounts->discount_name]+=round($ojd->discount_amount,2);
                          $all_discounts += round($ojd->discount_amount,2);
                          
                        }

                        $total = $total - round((($ojd->discount_percentage * $total) / 100),2);
                        
                    }

                $final_data['total_discount'] = $all_discounts;
                $final_data['total_amount'] =  $sumtotal;

                  $net_total = $grandest_total - $all_discounts;
                  $agency_discount_percentage = 0;

                  

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
                          $charges_array[$jec->charges->charge_name]+=round((($jec->charge_percentage*$net_total)/ 100),2); 
                        }
                        else
                        {
                          $charges_array[$jec->charges->charge_name]+=round($jec->charge_amount,2);
                        }
                      }
                      else
                      {
                        $charges_array[$jec->charges->charge_name]=$jec->charge_percentage;
                      }
                    }


                   

                    if($charges_array)
                    {
                      foreach($charges_array as $ckey=>$ca)
                      {
                        if($ckey != 'Agency Discount')
                        {
                          
                            $total_charge+=$ca;
                        }
                        else
                        {
                         $agency_discount_percentage = $ca;
                           
                        }

                       }
                          
                   }

                 

                $total_before_vat  = $net_total + $total_charge;
                $agency_discount = (($total_before_vat * $agency_discount_percentage)/100);
                $total_before_vat = $total_before_vat - $agency_discount;
                $vat = round(($total_before_vat * 13 )/ 100,2);

                $final_data['total_before_vat']  = $total_before_vat;
                $final_data['agency_discount'] =  $agency_discount;
                $final_data['total_charges'] = $total_charge;
                $final_data['vat'] = $vat;
                $final_data['final_total'] = $total_before_vat + $vat;


        }
      }
   
        return $final_data; 
  }

}
