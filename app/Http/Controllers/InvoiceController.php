<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Shipper;
use App\Models\Shipment;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Price;
use Illuminate\Http\Request;

use function Symfony\Component\String\b;

class InvoiceController extends Controller {
    
    public function index() {
        $invoices = Invoice::all();
        $details = OrderDetails::all();

        return view('invoices.invoices', compact('invoices','details'));
    }
    
    public function addInvoice($orderId) {
        $suppliers = Supplier::all();
        $shippers = Shipper::all();
        $products = Product::all();
        $shipments = Shipment::all();
        $orders = Order::where('pending','=',1)->get();
        $order = Order::findOrFail($orderId);
        $details = OrderDetails::where('order_id', $orderId)->get();
        
        $invoices = Invoice::where('supplier_id', $order->supplier_id)->get();
        return view ('invoices.add_invoice', compact('suppliers','products','shipments','shippers', 'orders','order','invoices', 'details'));
    }

    public function addSpecialInvoice() {
        $suppliers = Supplier::all();
        $shippers = Shipper::all();
        $products = Product::all();
        $shipments = Shipment::all();
        
        return view ('invoices.add_special_invoice', compact('suppliers','products','shipments','shippers'));
    }

    public function storeSpecial(Request $request) {
        //dd($request);
        $invoice_type = "";
        //Special Invoices are the ones that do not come from the orders. The difference is that orderDetails do not exist
        $count = $request->input('count');
        $details = collect();

        for ($i=1; $i < $count+1; $i++) { 
            //Taking advantage of the loop to determine the type of the invoice, that is whether it is for the factory or the showroom
            if($request->input('product'.$i) == 1) {
                $invoice_type = "Εμπόριο";
            } else if($request->input('product'.$i) == 2) {
                $invoice_type = "Εργοστάσιο (Μ)";
            } else {
                $invoice_type = "Εργοστάσιο";
            }

            $temp_detail = OrderDetails::create([
                'product_id' => $request->input('product'.$i),
                //'invoice_id' => $invoice->id,
                'pending' => 0,
                'quantity' => $request->input('quantity'.$i),
                'measurement_unit' => $request->input('measurement_unit'.$i),
                'items_per_package' => 1,
                'net_value' => $request->input('net_value'.$i),
                'product_discount' => $request->input('product_discount'.$i),
                'tax_rate' => $request->input('tax_rate'.$i),
                'price' => $request->input('price'.$i),
            ]);

            $details->push($temp_detail);
        }

        //shipment
        if($request->input('shipper_id')==null){

        } else {
            if($request->input('shared_shipment') != 'null') {
                $shared_shipment_id = $request->input('shared_shipment');
                $shared_shipment = Shipment::find($shared_shipment_id);
                $shipment = $shared_shipment;
                $shared_shipment->invoices()->attach($shared_shipment_id);
            } else {
                // (Step 2b) Creating a shipment
                $shipment = Shipment::create([
                    'shipping_date' => $request->input('arrival_date'),
                    'supplier_id' => $request->input('supplier_id'),
                    'shipper_id' => $request->input('shipper_id'),
                    'shipment_price' => $request->input('shipment_price'),
                    'extra_shipper_id' => $request->input('extra_shipper_id'),
                    'shipment_invoice_number' => $request->input('shipment_invoice_number'),
                    'extra_price' => $request->input('extra_price'),
                ]);
            }
        }
        

        //We create the instance of the model and add to the database
        if($request->input("shipper_id")==null){
            $invoice = Invoice::create([
                'invoice_type' => $invoice_type,
                'shipment_id' => null,
                'supplier_id' => $request->input('supplier_id'),
                'invoice_date' => $request->input('invoice_date'),
                'supplier_invoice_number' => $request->input('supplier_invoice_number'),
                'order_discount' => $request->input('order_discount'),
                'invoice_tax_rate' => $request->input('invoice_tax_rate'),
                'extra_charges' => $request->input('extra_charges'),
                'invoice_total' => $request->input('invoice_total'),
                'notes' => $request->input('notes')
            ]);
        }else{
            $invoice = Invoice::create([
                'invoice_type' => $invoice_type,
                'shipment_id' => $shipment->id,
                'supplier_id' => $request->input('supplier_id'),
                'invoice_date' => $request->input('invoice_date'),
                'supplier_invoice_number' => $request->input('supplier_invoice_number'),
                'order_discount' => $request->input('order_discount'),
                'invoice_tax_rate' => $request->input('invoice_tax_rate'),
                'extra_charges' => $request->input('extra_charges'),
                'invoice_total' => $request->input('invoice_total'),
                'notes' => $request->input('notes')
            ]);
        }
        
        
        $i = 1;        
        foreach($details as $detail){
            //Updating each detail with the id of the invoice
            $detail->invoice_id = $invoice->id;
            
            //Setting the last supplier
            $detail->product->last_supplier = $request->input('supplier_id');
            //Updating the stock level
            $detail->product->stock_level = $detail->product->stock_level + $request->input('quantity'.$i);
            //dd($detail->product->stock_level);
            $detail->save();
            $detail->product->save();

            //We also create the history of prices records for each of the details
            if($detail->product->id > 2){
                Price::create([
                    'price_date' => $invoice->invoice_date,
                    'history_quantity' => $request->input('quantity'.$i),
                    'history_price' => $request->input('net_value'.$i),
                    'history_discount' => $request->input('product_discount'.$i),
                    'history_tax_rate' => $request->input('tax_rate'.$i),
                    'supplier_id' => $request->input('supplier_id'),
                    'product_id' => $request->input('product'.$i),
                    'invoice_id' => $invoice->id
                ]);
            }
            
            $i++;
        }

        return redirect('/invoices')->with('message', 'Επιτυχής αποθήκευση Τιμολογίου!');
    }

    public function store(Request $request) { 
        //dd($request);
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
        
        //(Step 1)   The order through which we create a new invoice
        $order = Order::findOrFail($request->input('order_id'));
        //dd($request);
        //(Step 2) There maybe more than one invoices with the same shipment. In this case we don't create a shipment as there is already one.
        if($request->input('shared_supplier_invoice') != 'null') {
            //There must be a shared supplier id posted, through which we find the invoice. 
            $shared_supplier_invoice_id = $request->input('shared_supplier_invoice');
            $invoice = Invoice::findOrFail($shared_supplier_invoice_id);
            //Having found the invoice, we look for the shipment with which it came
            $shared_shipment_id = $request->input('shared_shipment');
            $shipment = Shipment::find($shared_shipment_id);
            
            //attaching the order to the existing invoice!
            $invoice->orders()->attach($order->id);

            //Appending the notes to the shared invoice so that both orders are shown in the notes
            $invoice->notes .= "\r\n" .'-------------  ΣΗΜΕΙΩΣΕΙΣ ΕΠΙΠΛΕΟΝ ΠΑΡΑΓΓΕΛΙΑΣ -----------------';
            $invoice->notes .= "\r\n" .'Πελάτης: '.$order->client->surname .' ' .$order->client->name;
            $invoice->notes .= "\r\n" .$request->input('notes');
            $invoice->notes .= "\r\n";
            $invoice->save();

        } else if($request->input('shared_shipment') != 'null'){
            //That's the case when shared_supplier_invoice is null but there is a shared shipment (e.g. 2 invoices for different orders with one shipment)
            $shared_shipment_id = $request->input('shared_shipment');
            $shipment = Shipment::find($shared_shipment_id);
        } else {
            //That is the normal case when both are null and we enter new values
            $shipment = Shipment::create([
                            'shipping_date' => $request->input('arrival_date'),
                            'supplier_id' => $request->input('supplier_id'),
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
        $order_pending = 0;
        if($request->input('pending')== null){
            for($i = 1; $i < $count + 1; $i++){
                if($request->input('arrived'.$i) == "0"){
                    $order_pending = 1;
                    break; //Even if there is only one pending product, the order should be considered pending.
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
        //If there is a shared invoice there is also a shared shipment, a case which have already been addressed
        if($request->input('shared_supplier_invoice') == 'null'){
            $invoice = Invoice::create([
                'invoice_type' => $order->order_type,
                'shipment_id' => $shipment->id,
                'supplier_id' => $order->supplier->id,
                'invoice_date' => $request->input('invoice_date'),
                'supplier_invoice_number' => $request->input('supplier_invoice_number'),
                //'order_discount'=> $request->input('order_discount'),
                'invoice_total' => $request->input('invoice_total'),
                'notes' => $request->input('notes')
            ]);
        }
        
        //  OrderDetails. The most tricky part!
        //(Step 5) Linking order details with the new invoice
        $i = 1;
        foreach($order->orderDetails as $detail){
            if($order->order_type == 'Εμπόριο' || $order->order_type == 'Εργοστάσιο (Μ)'){
                $detail->invoice_id = $invoice->id;
                $detail->pending = '0';
                $detail->save();
            }
            if($request->input('arrived'.$i) == 1){
                $detail->invoice_id = $invoice->id; //link to the invoice
                $detail->pending = '0'; //updating pending status
                $detail->net_value = $request->input('net_value'.$i);
                $detail->product_discount = $request->input('product_discount'.$i);
                $detail->measurement_unit = $request->input('measurement_unit'.$i);
                $detail->tax_rate = $request->input('tax_rate'.$i);
                $detail->price = $request->input('price'.$i);
                //creating price record for the specific product
                if($detail->product->id >2){
                    Price::create([
                        'price_date' => $request->input('invoice_date'),
                        'history_quantity' => $request->input('quantity'.$i),
                        'history_price' => $request->input('net_value'.$i),
                        'history_discount' => $request->input('product_discount'.$i),
                        'history_tax_rate' => $request->input('tax_rate'.$i),
                        'supplier_id' => $request->input('supplier_id'),
                        'product_id' => $detail->product_id,
                        'invoice_id' => $invoice->id,
                    ]);
                }
                
                $detail->product->last_supplier = $request->input('supplier_id'); //Updating last supplier
                $detail->product->stock_level = $detail->product->stock_level + $request->input('quantity'.$i);
                $detail->save();
                $detail->product->save();
            } 
            $i++;
        }

        //(Step 6) This invoice may refer to more than the order that brought us here
        //$more_orders = $request->input('more_orders');
        //$invoice->orders()->attach($order);
        //$invoice->orders()->attach($more_orders);

        //What happens if the added orders are not completed?

        return redirect('/orders')->with('message', 'Επιτυχής αποθήκευση Τιμολογίου!');
    }

    public function showDetails($invoiceId) {
        $invoice = Invoice::findOrFail($invoiceId);
        $details = OrderDetails::where('invoice_id','=',$invoiceId)->get();
               
        return view ('invoices.view_invoice', compact('invoice','details'));
    }

    //Surely it must the busiest funtion of all the application!!!!
    public function show($invoiceId){
        
        $invoice = Invoice::findOrFail($invoiceId);
        $orders = Order::all();
        $shippers = Shipper::all();
        $suppliers = Supplier::all();
        $products = Product::all();
        $shipments = Shipment::all();
        $details = OrderDetails::where('invoice_id',$invoiceId)->get();

        return view('invoices.edit_invoice', compact('invoice','orders','shippers','shipments','suppliers','products','details'));
    }

    public function update(Request $request, Invoice $invoice){
        
        dd(request()->all());
        /*  *   *   *   *   *   *   *   *   *   *   *   *   *   *   *   *   *   *
         *                              UPDATING an INVOICE
         *  Updating an invoice must be the most populated form in the project. That's because it involves orders, 
         *  calculations, changes of products, changes of dates, changes of shipments and other...
         * 
         */

        //Update the basic info
        $invoice->supplier_id = $request->input('supplier_id');
        $invoice->invoice_date = $request->input('invoice_date');
        $invoice->supplier_invoice_number = $request('supplier_invoice_number');
        $invoice->order_discount = $request->input('order_discount');
        $invoice->extra_charges = $request->input('extra_charges');
        $invoice->invoice_tax_rate = $request->input('invoice_tax_rate');
        $invoice->invoice_total = $request->input('invoice_total');
        $invoice->notes = $request->input('notes');
        $invoice->save();

        //If there was no shipment associated we may input it here (or via the shipping menu)
        if($invoice->shipment_id == null) {
            if($request->input('shipper_id') != null) {

                $shippingData = request()->validate([
                    'shipping_date' => 'required',
                    'shipper_id' => 'required',
                    'supplier_id' => 'required',
                    'extra_shipper_id'=> 'nullable',
                    'shipment_invoice_number' => 'required',
                    'shipment_price' => 'required',
                    'extra_price' => 'nullable',
                ]);
        
                Shipment::create($shippingData);
            }
        } else {
            //in case there is already a shipment we just update the shipment
            $shippingData = request()->validate([
                'shipping_date' => 'required',
                'shipper_id' => 'required',
                'supplier_id' => 'required',
                'extra_shipper_id'=> 'nullable',
                'shipment_invoice_number' => 'required',
                'shipment_price' => 'required',
                'extra_price' => 'nullable',
            ]);

            $shipment = Shipment::findOrFail($invoice->shipment_id);

            $shipment->update($shippingData);
        }

        /* Resetting product quantities. Either they are changed or even if they are totally removed 
         * we need to wipe out the past values so that we have correct quantities. */
        
        foreach($invoice->orderDetails() as $old_detail){
            $old_detail->product->stock_level = 0;
        }

        /* History prices : That's a bit tricky because we need to be sure that no data is left behind.
         * If there is a product that is going to be edited or even removed, history prices must be 
         * updated. Therefore it's safer to delete history prices and make new ones */
        $historyOfInvoice = Price::where('invoice_id',$invoice->id)->get();
        foreach($historyOfInvoice as $price){
            $price->delete();
        }

        /* Along with most order_details values we update the quantities. */
               
        for ($i=1; $i < $request->input('count')+1 ; $i++) { 
            $detail = OrderDetails::findOrFail($request->input('detail'.$i));   //Firstly we find actual record
            $detail->net_value = $request->input('net_value'.$i);               
            $detail->product_discount = $request->input('product_discount'.$i);
            $detail->tax_rate = $request->input('tax_rate'.$i);
            $detail->product_id = $request->input('product'.$i);
            $detail->price = $request->input('price'.$i);
            $detail->order_id = $request->input('order'.$i);
            $detail->product->stock_level = $detail->product->stock_level + $request->input('quantity'.$i);   //Having already deducted the previous stock_level, we add the posted
            //(re)creating price record for the specific product
            if($detail->product->id > 2){
                Price::create([
                    'price_date' => $request->input('invoice_date'),
                    'history_quantity' => $request->input('quantity'.$i),
                    'history_price' => $request->input('net_value'.$i),
                    'history_discount' => $request->input('product_discount'.$i),
                    'history_tax_rate' => $request->input('tax_rate'.$i),
                    'supplier_id' => $request->input('supplier_id'),
                    'product_id' => $detail->product_id,
                    'invoice_id' => $invoice->id,
                ]);
            }
            
            $detail->product->save();
            $detail->save();
            //note : Last supplier is not changed!
        }



    }

    public function destroy(Invoice $invoice) {
        $invoice->delete();

        return redirect('/invoices')->with('message', 'Επιτυχής διαγραφή Τιμολογίου!');
    }
}