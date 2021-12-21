<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Models\Order;
use App\Models\Shipper;
use Illuminate\Http\Request;

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

        
        $shippers = Shipper::all();
        $ship_stats = array();
        foreach ($shippers as $shipper) {
            $count = Shipment::where('shipper_id','=', $shipper->id)
                                ->orWhere('extra_shipper_id','=', $shipper->id)
                                ->count();
            if($count != 0){
                $ship_stats[$shipper->name] = $count;
            }
        }


        //dd($ship_stats);
        
        return view('welcome', compact('monthly_sum','extra_sum', 'pending_orders','monthly_orders','ship_stats')); 
    }

    
}
