<!-- This is about the invoices that are needed to be logged and do not belong to an order --> 

@extends('template')

@section('title', 'Νέο Τιμολόγιο')

<div class="container">
    <div class="card bg-danger bg-opacity-75 shadow-lg border-0 rounded-3 mt-3 ">
        <div class="card-header"><h3 class="text-center font-weight-light my-2 ">Νέο Τιμολόγιο (άνευ παραγγελίας)</h3></div>
            <div class="card-body bg-light">
                <form action="/add_invoice" id="addSpecialInvoice" method="post">
                    <!-- General details of invoice -->
                    <div class="row m-2">
                        <div class="col-6 me-2 border rounded-3 shadow-sm">
                            <br>
                            <div class="row">
                                <div class="col-6 text-end justify-content-center">
                                    <label class="align-middle" for="orderSupplier">Προμηθευτής</label>
                                </div>
                                <div class="col-6">
                                    <input class="form-control" name="" id="invoiceSupplier" type="text" readonly">
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
                                            <option value="{{ $shipment->id }}">{{ $shipment->invoice_number }} - {{ $shipment->shipper->name }}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Code for inserting product details (not order details) -->




                    @csrf
                </form> 
            </div>
            <div class="card-footer text-center py-2">
                <button class="btn btn-danger shadow-sm" type="submit" form="addInvoice">  Αποθήκευση </button>
                <a href="/orders" class="btn btn-info shadow-sm">  Ακύρωση - Επιστροφή </a>
            </div>
        </div>