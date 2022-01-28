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

        //Shipments stats
        $dionysos_shipments = Shipment::where('shipper_id','=','2')->get();
             
        $monthly_sum = 0;
        $extra_sum = 0;
        foreach ($dionysos_shipments as $shipment) {
            $month = date("m",strtotime($shipment->shipping_date));
            if($month == date('m')){
                $monthly_sum += $shipment->shipment_price;
                $extra_sum += $shipment->extra_price;
            }
        }
        
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

        
        return view('welcome', compact('monthly_sum','extra_sum', 'pending_orders','monthly_orders','ship_stats','order_stats_current_year','order_stats_previous_year','total_yearly_expences','total_last_year_expences')); 
    }
}