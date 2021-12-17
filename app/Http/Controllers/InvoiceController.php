<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Shipper;
use App\Models\Shipment;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;

class InvoiceController extends Controller {
    
    public function index() {
        $invoices = \App\Models\Invoice::all();

        return view('invoices.invoices', compact('invoices'));
    }
    
    public function add_invoice($orderId) {
        $suppliers = Supplier::all();
        $shippers = Shipper::all();
        $products = Product::all();
        $shipments = Shipment::all();
        $orders = Order::where('pending','=',1)->get();
        $order = Order::findOrFail($orderId);
        $details = OrderDetails::where('order_id', $orderId)->get();

        return view ('invoices.add_invoice', compact('suppliers','products','shipments','shippers', 'orders','order', 'details'));
    }

    public function add_special_invoice() {
        $suppliers = Supplier::all();
        $shippers = Shipper::all();
        $products = Product::all();
        $shipments = Shipment::all();
        
        return view ('invoices.add_special_invoice', compact('suppliers','products','shipments','shippers'));
    }

    public function storeSpecial(Request $request) {
        dd($request);
        $count = $request->input('count');

        
        
    }

    public function store(Request $request) { 
        dd($request);
        /* Since it's the most complicated action I will try to explain every step thoroughly not only 
         * so that you can understand what I am doing, but to be able to maintain the code after a while
         * 
         *      The creation of an invoice - The Steps
         * 
         *       1. We get the order object from the request because we are using it to pass the type of 
         *          the invoice. It is impossible for an invoice to have different type from the order.
         *          There is, though, the chance of a supplier sending mixed orders. In such case ????
         *  
         *       2. Before creating a new shipment we need to check if this invoices is shipped paired to
         *          another one. So there is no NEW shipment. We link it with a previously created shipment.
         * 
         *       2b.If the invoice came with a shipment (even if it was not shipped but bought from a 
         *          physical store) we create a shipment
         * 
         *       3. We update arrive_date, notes and pending for the Order
         * 
         *       4. We create a new invoice instance including type (taken from order)
         * 
         *       5. We place the invoice_id to the order_detail. Furthermore we create a record in prices table 
         *          where we keep the history of the prices for each invoiced product
         * 
         *       6. While some order may be partially invoiced (not completed), there is always the posibility
         *          of having more than one orders within the same invoice. This is dealt with linking orders 
         *          to the newly created invoice. There is a multiple dropdown in the add_invoice form where 
         *          the user can add as many orders as he likes. 
         *              For example: A new invoice arrives which contains products from orders 2,5 and 6.
         *                           In the form we can add these orders and they are linked to the invoice
         */ 

        //The counter of the products 
        $count = $request->input('count');
        //dd($request);
        //(Step 1)   The order through which we create a new invoice
        $order = Order::findOrFail($request->input('order_id'));
        
        
        //(Step 2) There maybe more than one invoices with the same shipment. In this case we don't create a shipment as there is already one.
        if($request->input('shared_shipment') != 'null') {
            $shared_shipment_id = $request->input('shared_shipment');
            $shared_shipment = Shipment::find($shared_shipment_id);
            $shared_shipment->invoices()->attach($shared_shipment_id);
        } else {
            // (Step 2b) Creating a shipment
            $shipment = Shipment::create([
                'shipping_date' => $request->input('arrival_date'),
                'shipper_id' => $request->input('shipper_id'),
                'shipment_price' => $request->input('shipment_price'),
                'extra_shipper_id' => $request->input('extra_shipper_id'),
                'shipment_invoice_number' => $request->input('shipment_invoice_number'),
                'extra_price' => $request->input('extra_price'),
            ]);
        }

        //(Step 3) Order update
            //If the invoice is for the factory then pending should be calculated through the order details. 
            // When all of the products in the order details are not pending, order is not pending too.
        
        if($request->input('pending')== null){
            for($i=1;$i< $count+1;$i++){
                if($request->input('arrived'.$i) == "0"){
                    $order_pending = "1";
                    break; //Even if there is only one pending produc, the order should be considered pending.
                }
            }
        } else {
            $order_pending = $request->input('pending');
        }

        $data_for_orders = [
            'arrival_date' => $request->input('arrival_date'),
            'notes' => $request->input('notes'),
            'pending' => $order_pending,   //The request sends the choice of the Radio button
        ];
        $order->update($data_for_orders);
        
        //(step 4) We finally create and store the invoice
        $invoice = Invoice::create([
            'invoice_type' => $order->order_type,
            'shipment_id' => $shipment->id,
            'supplier_id' => $order->supplier->id,
            'invoice_date' => $request->input('invoice_date'),
            'supplier_invoice_number' => $request->input('supplier_invoice_number'),
            'invoice_total' => $request->input('invoice_total'),
            'notes' => $request->input('notes')
        ]);
        
        //  OrderDetails. The most tricky part!
        //(Step 5) Linking order details with the new invoice
        $i = 1;
        foreach($order->orderDetails as $detail){
            if($request->input('arrived'.$i) == 1){
                $detail->invoice_id = $invoice->id; //link to the invoice
                $detail->pending = '0'; //updating pending status
                //creating price record for the specific product
                \App\Models\Price::create([
                    'price_date' => $request->input('invoice_date'),
                    'history_price' => $request->input('net_value'.$i),
                    'history_discount' => $request->input('product_discount'.$i),
                    'history_tax_rate' => $request->input('tax_rate'.$i),
                    'supplier_id' => $request->input('supplier_id'),
                    'product_id' => $detail->product_id
                ]);
                $detail->product->last_supplier = $request->input('supplier_id'); //Updating last supplier
                $detail->save();
            }
            $i++;
        }

        //(Step 6) This invoice may refer to more than the order that brought us here
        $more_orders = $request->input('more_orders');
        $invoice->orders()->attach($order);
        $invoice->orders()->attach($more_orders);

        //What happens if the added orders are not completed?


        return redirect('/orders')->with('message', 'Επιτυχής αποθήκευση Τιμολογίου!');
    }

    public function showDetails($invoiceId) {
        $invoice = Invoice::findOrFail($invoiceId);
        $details = OrderDetails::where('invoice_id','=',$invoiceId)->get();
               
        return view ('invoices.view_invoice', compact('invoice','details'));
    }

    public function destroy(Invoice $invoice) {
        $invoice->delete();

        return redirect('/invoices')->with('message', 'Επιτυχής διαγραφή Τιμολογίου!');
    }
}