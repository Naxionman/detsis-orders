@extends('template')

@section('title', 'Προσθήκη Τιμολογίου Μεταφορικής - Detsis Orders')

@section('content')
<div class="container">
    <div class="card bg-success bg-opacity-25 shadow-lg border-0 rounded-3 mt-3 ">
        <div class="card-header"><h3 class="text-center font-weight-light my-2 ">Προσθήκη Τιμολογίου μεταφορικής</h3></div>
            <div class="card-body bg-light">
                <form action="add_shipment" id="addShipment" method="POST">
                    <div class="row mt-3 justify-content-center">
                        <div class="col-2"><label for="inputShippingDate">Ημερομηνία παραλαβής</label></div>
                        <div class="col-4"><input class="form-control" type="date" id="inputShippingDate" name="shipping_date" placeholder="Πότε παραλάβαμε"></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-2"><label for="inputShiper">Μεταφορική</label></div>
                        <div class="col-4">
                            <select class="form-control" id="inputShipper" name="shipper_id">
                                @foreach ($shippers as $shipper)
                                    <option type="text" value="{{ $shipper->id }}">{{ $shipper->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-2"><label for="inputSupplier">Προμηθευτής</label></div>
                        <div class="col-4">
                            <select class="js-example-basic-single form-control" id="inputSupplier" name="supplier_id">
                                @foreach ($suppliers as $supplier)
                                    <option   type="text" value="{{ $supplier->id }}">{{ $supplier->company_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-2"><label for="inputShipmentNumber">Αριθμός Τιμολογίου</label></div>
                        <div class="col-4"><input class="form-control" name="shipment_invoice_number" type="text" id="inputShipmentNumber" autocomplete="off"></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-2"><label for="inputShipmentPrice">Χρέωση</label></div>
                        <div class="col-4"><input class="form-control" name="shipment_price" type="number" step="0.01" id="inputShipmentPrice" autocomplete="off"></div>
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
                        <div class="col-4"><input class="form-control" name="extra_price" type="number" step="0.01" id="inputExtraPrice" autocomplete="off"></div>
                    </div>

                    @csrf
                </form>
            </div>
            <div class="card-footer text-center py-2">
                <button class="btn btn-danger shadow-sm" type="submit" form="addShipper">  Αποθήκευση  </button>
                <a href="/shipments" class="btn btn-info shadow-sm">  Ακύρωση - Επιστροφή </a>
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