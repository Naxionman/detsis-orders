@extends('template')

@section('title', 'Νέο Τιμολόγιο')

@section('content')
<div class="container">
    <div class="card bg-danger bg-opacity-75 shadow-lg border-0 rounded-3 mt-3 ">
        <div class="card-header"><h3 class="text-center font-weight-light my-2 ">Νέο Τιμολόγιο</h3></div>
            <div class="card-body bg-light">
                <form action="/add_invoice" id="addInvoice" method="post" novalidate>
                    <!-- General details of order -->
                    <div class="row m-2">
                        <div class="col-6 me-2 border rounded-3 shadow-sm">
                            <ul class="nav nav-tabs" id="supplierInvoiceTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link active" id="home-tab1" data-bs-toggle="tab" data-bs-target="#home1" type="button" role="tab" aria-controls="home1" aria-selected="true">Νέο Τιμολόγιο προμηθευτή</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link" id="shared-tab1" data-bs-toggle="tab" data-bs-target="#shared1" type="button" role="tab" aria-controls="shared1" aria-selected="false">Καταχώρηση σε ήδη υπάρχον</button>
                                </li>
                            </ul>
                            <div class="tab-content p-2" id="myTabContent1">
                                <div class="tab-pane fade show active" id="home1" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="row">
                                        <div class="col-4 text-end justify-content-center">
                                                <label for="inputShipper" class="align-middle">Προμηθευτής</label>
                                            </div>
                                            <div class="col-8">
                                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                <input class="form-control" value="{{ $order->supplier->company_name }}" id="orderSupplier" type="text" readonly">
                                                <input type="hidden" name="supplier_id" value="{{ $order->supplier->id }}">
                                            </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 text-end justify-content-center">
                                            <label for="orderDate" class="align-middle"><strong>Ημερομηνία παραγγελίας</strong></label>
                                        </div>
                                        <div class="col-6">
                                            <input class="form-control" value="{{ $order->order_date->format('Y-m-d') }}" type="date" id="orderDate" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 text-end justify-content-center">
                                            <label for="inputArrivalDate" class="align-middle"><strong>Ημερομηνία άφιξης</strong></label>
                                        </div>
                                        <div class="col-6">
                                            <input class="form-control" value="{{date('Y-m-d')}}"name="arrival_date" type="date" id="inputArrivalDate" required="required">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 text-end justify-content-center">
                                            <label for="inputInvoiceDate" class="align-middle"><strong>Ημερομηνία τιμολόγησης</strong></label>
                                        </div>
                                        <div class="col-6">
                                            <input class="form-control" value="{{date('Y-m-d')}}"name="invoice_date" type="date" id="inputInvoiceDate" required="required">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 text-end justify-content-center">
                                            <label for="inputInvoiceNumber">Αριθμός Τιμολογίου Προμηθευτή</label>
                                        </div>
                                        <div class="col-6">
                                            <input class="form-control" name="supplier_invoice_number" type="text" id="inputInvoiceNumber" required="required">
                                        </div>
                                    </div>
                                   
                                </div>
                                <div class="tab-pane fade" id="shared1" role="tabpanel" aria-labelledby="shared-tab">
                                    <br>
                                    <h6>Επιλέξτε το τιμολόγιο προμηθευτή στο οποίο εμπεριέχεται η παραγγελία</h6>
                                    <select class="form-control js-example-basic-single" name="shared_supplier_invoice" id="sharedSupplierInvoice">
                                        <option value="null" selected></option>
                                        @foreach ($invoices as $invoice)
                                            <option value="{{ $invoice->id }}">{{ $invoice->supplier_invoice_number }} - {{ $invoice->invoice_total }}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                    <br>
                                </div>
                            </div>
                        </div>

                        <div class="col border rounded-3 shadow-sm">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Νέο Τιμολόγιο μεταφορικής</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link" id="shared-tab" data-bs-toggle="tab" data-bs-target="#shared" type="button" role="tab" aria-controls="shared" aria-selected="false">Καταχώρηση σε ήδη υπάρχον</button>
                                </li>
                            </ul>
                            <div class="tab-content p-2" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="row">
                                        <div class="col-4 text-end justify-content-center">
                                                <label for="inputShipper" class="align-middle">Μεταφορική</label>
                                            </div>
                                            <div class="col-8">
                                                <select class="form-control" id="inputShipper" name="shipper_id">
                                                    @foreach ($shippers as $shipper)
                                                        <option type="text" value="{{ $shipper->id }}">{{ $shipper->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4 text-end justify-content-center">
                                                <label for="inputShipmentNumber" class="align-middle">Αριθμός Τιμολογίου</label>
                                            </div>
                                            <div class="col-8">
                                                <input class="form-control" name="shipment_invoice_number" type="text" id="inputShipmentNumber" autocomplete="off" required="required">
                                            </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4 text-end justify-content-center">
                                                <label for="inputShipmentPrice" class="align-middle">Συνολική χρεώση</label>
                                            </div>
                                            <div class="col-8">
                                                <input class="form-control" name="shipment_price" type="number" step="0.01" id="inputShipmentPrice" autocomplete="off" required="required">
                                            </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4 text-end justify-content-center">
                                                <label for="inputExtraShipper" class="align-middle">Επιπλέον μεταφορική</label>
                                            </div>
                                            <div class="col-8">
                                                <select class="form-control" id="inputExtraShipper" name="extra_shipper_id" >
                                                    <option value="none" selected disabled hidden>Δεν υπήρξε ενδιάμεση μεταφορική</option>
                                                    @foreach ($shippers as $shipper)
                                                            <option type="text" value="{{ $shipper->id }}">{{ $shipper->name }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4 text-end justify-content-center">
                                            <label for="inputExtraPrice" class="align-middle">Xρεώση 2ης μεταφορικής</label>
                                        </div>
                                        <div class="col-8">
                                            <input class="form-control" name="extra_price" type="number" step="0.01" id="inputExtraPrice" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="shared" role="tabpanel" aria-labelledby="shared-tab">
                                    <br>
                                    <h6>Επιλέξτε το τιμολόγιο μεταφορικής με το οποίο ήρθε</h6>
                                    <select class="form-control js-example-basic-single" name="shared_shipment" id="shared_shipment">
                                        <option value="null" selected></option>
                                        @foreach ($shipments as $shipment)
                                            @if ($shipment->shipper_id != 1)
                                                <option value="{{ $shipment->id }}">{{ $shipment->shipment_invoice_number }} - {{ $shipment->shipper->name }}</option>    
                                            @endif
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="shipment_invoice_number" value="{{ $shipment->shipment_invoice_number }}">
                                    <input type="hidden" name="shipment_price" value="{{ $shipment->shipment_price }}">
                                    <br>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 
                        There are three kinds of orders. The orders from the showroom and the ones from the factory (split into stockable and non-stockable).
                        But there must be two kinds of javascript checks. For the showroom orders we only need put the final value. 
                        For the factory we need to store the net values of each product and we need to get into details with the products. But we need to add
                        notifications and min_level for the ones of the stockable products. 
                            1. Showroom : No net values and calculations. Just the final price.
                            2. Factory Non-Stockable : No net values and calculations
                            3. Factory Stockable : Net values, price history, minimum levels
                        I am using include() so that repetitions are omitted.
                    -->
                    @if( $order->orderDetails->first()->product_id < 3)  <!-- product ids 1 and 2 refer to orders that don't need calculations  -->
                        @include('invoices.no_calculations')
                    @else
                        @include('invoices.with_calculation')
                    @endif
                    @csrf
                </form> 
            </div>
            <div class="card-footer text-center py-2">
                <button class="btn btn-danger shadow-sm" type="submit" form="addInvoice">  Αποθήκευση </button>
                <a href="/orders" class="btn btn-info shadow-sm">  Ακύρωση - Επιστροφή </a>
            </div>
        </div>
    <script>$('.js-example-basic-multiple').select2();</script>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <audio autoplay src="/sound/beep.mp3"/>
    @endif
</div>
@endsection


