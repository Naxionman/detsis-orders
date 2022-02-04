<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Models\Order;
use App\Models\Shipper;
use App\Models\Expence;

class PageController extends Controller {
    
    public function index() {
        //orders stats
        $pending_orders = Order::where('pending','=',1)->count();
        
        $monthly_orders = Order::whereMonth('order_date','=', date("m"))->count();

        //Shipments stats - Dionysos is our main shipping company so we want to track every invoice of theirs
        $dionysos_shipments = Shipment::where('shipper_id','=','2')->get();
             
        $month_sum = 0;
        $last_month_sum = 0;
        foreach ($dionysos_shipments as $shipment) {
            $month = date("m",strtotime($shipment->shipping_date));
            if($month == date('m')){
                $month_sum += $shipment->shipment_price;
            }
            if($month == date('m')-1){
                $last_month_sum += $shipment->shipment_price;
            }
        }
        //dd($month);
        //Shippers stats for chart
        $shippers = Shipper::all();
        $ship_stats = array();
        foreach ($shippers as $shipper) {
            $count = Shipment::where('shipper_id','=', $shipper->id)
                                ->where('shipper_id','!=', 1)
                                ->orWhere('extra_shipper_id','=', $shipper->id)
                                ->count();
            if($count != 0){
                $ship_stats[$shipper->name] = $count;
            }
        }

        //Orders stats for chart
        $order_stats_current_year = array();
        $order_stats_previous_year = array();
        $orders = Order::all();
        
        //initializing the arrays        
        for ($i=1; $i < 13 ; $i++) { 
            $order_stats_current_year[$i] = 0;
            $order_stats_previous_year[$i] = 0;
        }

        //For each month of the current year we get the number of orders
        for ($i=1; $i < 13; $i++) { 
            $order_per_month_count = 0;
            
            foreach ($orders as $order){
                if($order->order_date->year == Date('Y') && $order->order_date->month == $i ){
                    $order_per_month_count += 1;
                    $order_stats_current_year[$i] = $order_per_month_count;
                }
                if($order->order_date->year == Date('Y')-1 && $order->order_date->month == $i ){
                    $order_per_month_count +=1;
                    $order_stats_previous_year[$i] = $order_per_month_count;
                }
            }
            
        }

        // 2021 Hard-coded stats
        if(Date("Y") == 2022){
            $order_stats_previous_year[1] = 32;
            $order_stats_previous_year[2] = 37;
            $order_stats_previous_year[3] = 93;
            $order_stats_previous_year[4] = 58;
            $order_stats_previous_year[5] = 49;
            $order_stats_previous_year[6] = 60;
            $order_stats_previous_year[7] = 45;
            $order_stats_previous_year[8] = 30;
            $order_stats_previous_year[9] = 56;
            $order_stats_previous_year[10] = 87;
            $order_stats_previous_year[11] = 54;
            $order_stats_previous_year[12] = 43;
        }
        

        $month_name = '';
        switch (Date('m')) {
            case '01':
                $month_name = 'Ιανουάριος';
                $last_month_name = 'Δεκέμβριος';
                break;
            case '02':
                $month_name = 'Φεβρουάριος';
                $last_month_name = 'Ιανουάριος';
                break;
            case '03':
                $month_name = 'Μάρτιος';
                $last_month_name = 'Φεβρουάριος';
                break;
            case '04':
                $month_name = 'Απρίλιος';
                $last_month_name = 'Μάρτιος';
                break;
            case '05':
                $month_name = 'Μάιος';
                $last_month_name = 'Απρίλιος';
                break;
            case '06':
                $month_name = 'Ιούνιος';
                $last_month_name = 'Μάιος';
                break;
            case '07':
                $month_name = 'Ιούλιος';
                $last_month_name = 'Ιούνιος';
                break;
            case '08':
                $month_name = 'Αύγουστος';
                $last_month_name = 'Ιούλιος';
                break;
            case '09':
                $month_name = 'Σεπτέμβριος';
                $last_month_name = 'Αύγουστος';
                break;
            case '10':
                $month_name = 'Οκτώβριος';
                $last_month_name = 'Σεπτέμβριος';
                break;
            case '11':
                $month_name = 'Νοέμβριος';
                $last_month_name = 'Οκτώβριος';
                break;
            case '12':
                $month_name = 'Δεκέμβριος';
                $last_month_name = 'Νοέμβριος';
                break;
        }

        //Expences calculations
        $expences = Expence::all();
        $total_yearly_expences = 0;
        $total_last_year_expences = 0;
        foreach ($expences as $expence) {
            if($expence->expence_date->year == Date("Y")){
                $total_yearly_expences += $expence->amount;
            }
            if($expence->expence_date->year == Date("Y") - 1){
                $total_last_year_expences += $expence->amount;
            }
            
        }
        
        return view('welcome', compact(
                                'last_month_name',
                                'month_name',
                                'month_sum',
                                'last_month_sum', 
                                'pending_orders',
                                'monthly_orders',
                                'ship_stats',
                                'order_stats_current_year',
                                'order_stats_previous_year',
                                'total_yearly_expences',
                                'total_last_year_expences'
                            )); 
    }
}