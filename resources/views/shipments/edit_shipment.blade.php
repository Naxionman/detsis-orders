@extends('template')

@section('title', 'DetsisOrders - Επεξεργασία φορτωτικής')

@section('content')
<div class="container">
    <div class="card bg-warning bg-opacity-25 shadow-lg border-0 rounded-3 mt-3 ">
        <div class="card-header"><h3 class="text-center font-weight-light my-2 ">Επεξεργασία φορτωτικής</h3></div>
            <div class="card-body bg-light">
                <form action="/edit_shipment/{{ $shipment->id }}" id="editShipment" method="POST">
                @method('PATCH')
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputName">Μεταφορική</label></div>
                        <div class="col-sm-4">
                            <select class="form-control" id="inputShipper" name="shipper_id">
                                <option value="{{$shipment->shipper_id}}" selected>{{$shipment->shipper->name}}</option>
                                @foreach ($shippers as $shipper)
                                    <option type="text" value="{{ $shipper->id }}">{{ $shipper->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-2"><label for="inputShipmentNumber">Αριθμός Τιμολογίου</label></div>
                        <div class="col-4"><input class="form-control" value="{{ $shipment->shipment_invoice_number }}" name="shipment_invoice_number" type="text" id="inputShipmentNumber" autocomplete="off"></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputArrivalDate">Ημερομηνία άφιξης</label></div>
                        <div class="col-sm-4"><input class="form-control" value="{{ $shipment->shipping_date->format("Y-m-d") }}" type="date" id="inputArrivalDate" name="shipping_date"></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-2"><label for="inputSupplier">Προμηθευτής</label></div>
                        <div class="col-4">
                            <select class="js-example-basic-single form-control" id="inputSupplier" name="supplier_id">
                                <option   type="text" value="{{ $shipment->supplier_id }}" selected>{{ $shipment->supplier->company_name }}</option>
                                @foreach ($suppliers as $supplier)
                                    <option   type="text" value="{{ $supplier->id }}">{{ $supplier->company_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-2"><label for="inputShipmentPrice">Χρέωση</label></div>
                        <div class="col-4"><input class="form-control" value="{{ $shipment->shipment_price }}" name="shipment_price" type="number" step="0.01" id="inputShipmentPrice" autocomplete="off"></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-2"><label for="inputExtraShiper">Μεταφορική</label></div>
                        <div class="col-4">
                            <select class="form-control" id="inputExtraShiper" name="extra_shipper_id">
                                <option value="none" selected disabled hidden>Δεν υπήρξε ενδιάμεση μεταφορική</option>
                                @foreach ($shippers as $shipper)
                                    <option type="text" value="{{ $shipper->id }}">{{ $shipper->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-2"><label for="inputExtraPrice">Χρέωση 2ης</label></div>
                        <div class="col-4"><input class="form-control" value="{{ $shipment->extra_price }}" name="extra_price" type="number" step="0.01" id="inputExtraPrice"></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-2"><label for="inputRelativeInvoice">Συσχέτιση με τιμολόγιο</label></div>
                        <div class="col-4">
                            <select class="form-control js-example-basic-multiple" multiple='multiple' name="invoices[]" id="boundInvoices">
                                <!-- Here we put into the select2 dropdown, the already related invoices -->
                                @foreach ($supplier_invoices as $supplier_invoice)
                                    <option value="{{$supplier_invoice->id }}" selected>{{ $supplier_invoice->supplier_invoice_number }}</option>
                                @endforeach
                                
                                @foreach ($invoices as $invoice)
                                    @if ($shipment->supplier_id == $invoice->supplier_id)
                                        <option value="{{ $invoice->id }}">{{ $invoice->supplier_invoice_number }}-{{ $invoice->invoice_date->format("d-m-Y") }} - {{ $invoice->supplier->company_name }}</option>    
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @csrf
                </form>
            </div>
            <div class="card-footer text-center py-2">
                <button class="btn btn-danger shadow-sm" type="submit" form="editShipment">  Αποθήκευση Αλλαγών </button>
                <a href="javascript:history.back()" class="btn btn-info shadow-sm">  Ακύρωση - Επιστροφή </a>
            </div>
        </div>

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

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
</div>
@endsection