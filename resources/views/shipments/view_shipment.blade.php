@extends('template')

@section('title', 'Στοιχεία Παράδοσης')

@section('content')
<div class="container">
    <div class="card bg-success  bg-gradient shadow-lg border-0 rounded-3 mt-3 ">
        <div class="card-header"><h3 class="text-center font-weight-light my-2 ">{{ $shipment->shipper->name }}</h3></div>
            <div class="card-body bg-light">
                    <div class="row mt-3 justify-content-center">
                        <div class="col">
                            <div class="row">
                                <div class="col-4"><label>Αποστολέας</label></div>
                                <div class="col-8"><strong>{{ $shipment->supplier->company_name }}</strong></div>
                            </div>
                            <div class="row">
                                <div class="col-4"><label>Ημερομηνία παραλαβής</label></div>
                                <div class="col-8">{{ $shipment->shipping_date->format('d-m-Y') }}</div>
                            </div>
                            <div class="row">
                                <div class="col-4"><label>Αριθμός παραστατικού</label></div>
                                <div class="col-8">ΤΠΥ-Α-{{ $shipment->shipment_invoice_number }}</div>
                            </div>
                            <div class="row">
                                <div class="col-4"><label>Συννημένα Τιμολόγια Αποστολέα</label></div>
                                <div class="col-8"><strong>{{ $supplier_invoices_count }} (
                                    @foreach ($supplier_invoices as $invoice)
                                        <a href="/view_invoice/{{ $invoice->id }}">{{ $invoice->supplier_invoice_number	}}</a>
                                    @endforeach
                                 )</strong></div>
                            </div>
                        </div>
                        
                       
                    </div>
                    
            </div>
            <div class="card-footer text-center py-2">
               <a href="/shipments" class="btn btn-info shadow-sm"> Επιστροφή </a>
            </div>
        </div>
</div>
@endsection