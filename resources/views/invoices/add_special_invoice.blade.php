@extends('template')

@section('title', 'Νέο Τιμολόγιο')

@section('content')
<div class="container">
    <div class="card bg-danger bg-opacity-75 shadow-lg border-0 rounded-3 mt-3 ">
        <div class="card-header"><h3 class="text-center font-weight-light my-2 ">Νέο Τιμολόγιο (άνευ παραγγελίας)</h3></div>
        <div class="card-body bg-light">
            <form action="/add_special_invoice" id="addSpecialInvoice" method="post">
                <!-- General details of invoice -->
                <div class="row m-2">
                    <div class="col-6 me-2 border rounded-3 shadow-sm">
                        <br>
                        <div class="row">
                            <div class="col-6 text-end justify-content-center">
                                <label class="align-middle" for="orderSupplier">Προμηθευτής</label>
                            </div>
                            <div class="col-6">
                                <select class="js-example-basic-single form-control" id="inputSupplier" name="supplier_id">
                                    @foreach ($suppliers as $supplier)
                                        <option   type="text" value="{{ $supplier->id }}">{{ $supplier->company_name }}</option>
                                    @endforeach
                                </select>
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
                                    <div class="col-5 text-end justify-content-center">
                                            <label for="inputShipper" class="align-middle">Μεταφορική</label>
                                        </div>
                                        <div class="col-7">
                                            <select class="form-control" id="inputShipper" name="shipper_id">
                                                <option value="" selected>Δεν θα καταχωρηθεί προσωρινά</option>
                                                @foreach ($shippers as $shipper)
                                                    <option type="text" value="{{ $shipper->id }}">{{ $shipper->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                </div>
                                <div class="row">
                                    <div class="col-5 text-end justify-content-center">
                                            <label for="inputShipmentNumber" class="align-middle">Αριθμός Τιμολογίου</label>
                                        </div>
                                        <div class="col-7">
                                            <input class="form-control" name="shipment_invoice_number" type="text" id="inputShipmentNumber" autocomplete="off">
                                        </div>
                                </div>
                                <div class="row">
                                    <div class="col-5 text-end justify-content-center">
                                            <label for="inputShipmentPrice" class="align-middle">Συνολική χρεώση</label>
                                        </div>
                                        <div class="col-7">
                                            <input class="form-control" name="shipment_price" type="number" step="0.01" id="inputShipmentPrice" autocomplete="off">
                                        </div>
                                </div>
                                <div class="row">
                                    <div class="col-5 text-end justify-content-center">
                                            <label for="inputExtraShipper" class="align-middle">Επιπλέον μεταφορική</label>
                                        </div>
                                        <div class="col-7">
                                            <select class="form-control" id="inputExtraShipper" name="extra_shipper_id" >
                                                <option value="none" selected disabled hidden>Δεν υπήρξε ενδιάμεση μεταφορική</option>
                                                @foreach ($shippers as $shipper)
                                                        <option type="text" value="{{ $shipper->id }}">{{ $shipper->name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                </div>
                                <div class="row">
                                    <div class="col-5 text-end justify-content-center">
                                        <label for="inputExtraPrice" class="align-middle">Xρεώση 2ης μεταφορικής</label>
                                    </div>
                                    <div class="col-7">
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
                                        <option value="{{ $shipment->id }}">{{ $shipment->shipment_invoice_number }} - {{ $shipment->shipper->name }}</option>
                                    @endforeach
                                </select>
                                <br>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Code for inserting product details (not order details) -->
                <div class="row">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 5%">α/α</th>
                                <th>Ποσότητα</th>
                                <th>Μ/Μ</th>
                                <th>Προϊόν</th>
                                <th>Τιμή μονάδας</th>
                                <th>Καθαρή αξία</th>
                                <th>Έκπτωση %</th>
                                <th>Αξία</th>
                                <th>ΦΠΑ %</th>
                                <th>ΦΠΑ</th>
                                <th>Τελική Τιμή</th>
                            </tr>
                        </thead>
                        <tbody>    
                                
                            <tr id="productRow1">
                                <td style="width: 5%" class="p-0 order-font" id="aa1">1</td>
                                
                                <td style="width: 5%" class="p-0 order-font">
                                    <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="quantity1" id="quantity1" required="required">
                                </td>
                                <td style="width: 5%" class="p-0 order-font">
                                    <input type="text" class="form-control p-0 pe-2 text-end order-font" name="measurement_unit1" id="measurementUnit1" value="ΤΕΜ">
                                </td>
                                <td>
                                    <select class="form-control js-example-basic-single" name="product1" id="product1">
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->product_name }} ({{ $product->detsis_code}})</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td style="width: 5%" class="p-0">
                                    <input type="number" step="0.0001" class="form-control p-0 pe-2 text-end order-font" name="net_value1" id="netValue1" min="0" required="required">
                                </td>
                                <td style="width: 5%" class="p-0">
                                    <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="sum_net_value1" id="sumNetValue1" min="0" readonly="readonly">
                                </td>
                                <td style="width: 5%" class="p-0">
                                    <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="product_discount1" value="0.00"min="0" max="100" id="productDiscount1">
                                </td>
                                <td style="width: 5%" class="p-0">
                                    <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="value1" value="0.00" min="0" id="value1" readonly="readonly">
                                </td>
                                <td style="width: 5%" class="p-0">
                                    <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="tax_rate1" value="24.00" min="0" max="100" id="taxRate1">
                                </td>
                                <td style="width: 5%" class="p-0">
                                    <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="tax1" min="0" id="tax1" readonly="readonly">
                                </td>
                                <td style="width: 10%" class="p-0">
                                    <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="price1" min="0" id="price1" readonly="readonly">
                                </td>
                            </tr>
                            <input type="hidden" name="count" id="count" value="1">
                        </tbody>
                    </table>
                    <div>
                        <button type="button" id="addProduct" class="btn btn-warning me-5 ms-5"> + Προσθήκη προϊόντος </button>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-7 border rounded">
                        <div class="m-2">Σημειώσεις :</div>
                        <textarea form="addSpecialInvoice" name="notes" id="inputNotes" cols="90" rows="10"></textarea>
                    </div>
                    <div class="col-1"></div>
                    <div class="col-2 border rounded-start">
                        <div class="row">
                            <div class="text-end">Συνολική καθαρή αξία :</div>
                        </div>
                        <div class="row">
                            <div class="text-end">Έκπτωση παραγγελίας :</div>
                        </div>
                        <div class="row">
                            <div class="text-end">Επιβαρύνσεις :</div>
                        </div>
                        <div class="row">
                            <div class="text-end">ΦΠΑ (%) :</div>
                        </div>
                        <div class="row">
                            <div class="text-end">ΦΠΑ (€):</div>
                        </div>
                        <div class="row">
                            <div class="text-end">Σύνολο :</div>
                        </div>
                    </div>
                    <div class="col-2 border rounded-end">
                        <div class="row">
                            <input type="number" step="0.01" readonly="readonly" class="form-control p-0 pe-2 text-end order-font" min="0" id="invoiceNetValue">
                        </div>
                        <div class="row">
                            <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="order_discount" min="0" id="orderDiscount" value="0.00">
                        </div>
                        <div class="row">
                            <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="extra_charges" min="0" id="extraCharges" value="0.00">
                        </div>
                        <div class="row">
                            <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="invoice_tax_rate" min="0" id="invoiceTaxRate" value="24.00">
                        </div>
                        <div class="row">
                            <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" min="0" id="tax">
                        </div>
                        <div class="row">
                            <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="invoice_total" min="0" id="invoiceTotal">
                        </div>
                    </div>
                </div>
                @csrf
            </form> 
        </div>
        <div class="card-footer text-center py-2">
            <button class="btn btn-danger shadow-sm" type="submit" form="addSpecialInvoice">  Αποθήκευση </button>
            <a href="/orders" class="btn btn-info shadow-sm">  Ακύρωση - Επιστροφή </a>
        </div>
    </div>
</div>
@endsection

