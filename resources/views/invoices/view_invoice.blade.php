@extends('template')

@section('title', 'Τιμολόγιο')

@section('content')
<div class="container">
    <div class="card bg-danger bg-opacity-75 shadow-lg border-0 rounded-3 mt-3 ">
        <div class="card-header"><h3 class="text-center font-weight-light my-2 ">Τιμολόγιο {{ $invoice->id }}</h3></div>
        <div class="card-body bg-light">
            <div class="row mt-2">
                <div class="col"><!-- Left column -->
                    <div class="card bg-danger bg-opacity-75 border-0 rounded-3 shadow-sm">
                        <div class="card-header text-light font-weight-light">Στοιχεία παραστατικού</div>
                        <div class="card-body bg-light">
                            <div class="row">
                                <div class="col-6 text-end justify-content-center">
                                    <label class="align-middle">Αφορά παραγγελία/ες</label>
                                </div>
                                <div class="col-6">
                                    <label class="align-middle">
                                        @foreach ($details as $detail)
                                            @if ($detail->order_id == null)
                                                {{ '-' }}
                                                @break
                                            @else
                                                {{ $invoice->orders->first()->id}}                                                    
                                            @endif
                                        @endforeach
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 text-end justify-content-center">
                                    <label class="align-middle">Προμηθευτής</label>
                                </div>
                                <div class="col-6">
                                    <label class="align-middle">{{ $invoice->supplier->company_name }}</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 text-end justify-content-center">
                                    <label class="align-middle">Ημερομηνία παραγγελίας</label>
                                </div>
                                <div class="col-6">
                                    <label class="align-middle">{{ $invoice->invoice_date->format('d-m-Y') }}</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 text-end justify-content-center">
                                    <label class="align-middle">Ημερομηνία άφιξης</label>
                                </div>
                                <div class="col-6">
                                    <label class="align-middle">{{ $invoice->shipment->shipping_date->format('d-m-Y') }}</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 text-end justify-content-center">
                                    <label class="align-middle">Ημερομηνία τιμολόγησης</label>
                                </div>
                                <div class="col-6">
                                    <label class="align-middle">{{ $invoice->invoice_date->format('d-m-Y') }}</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 text-end justify-content-center">
                                    <label class="align-middle">Αριθμός Τιμολογίου Προμηθευτή</label>
                                </div>
                                <div class="col-6">
                                    <label class="align-middle">{{ $invoice->supplier_invoice_number }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                        
                <div class="col"><!-- Second column (Μεταφορική) -->
                    <div class="card bg-danger bg-opacity-75 border-0 rounded-3 shadow-sm">
                        <div class="card-header text-light font-weight-light">Τιμολόγιο Μεταφορικής</div>
                        <div class="card-body bg-light">
                            <div class="row">
                                <div class="col-5 text-end justify-content-center">
                                    <label class="align-middle">Μεταφορική</label>
                                </div>
                                <div class="col-5">
                                    <label class="align-middle">{{ $invoice->shipment->shipper->name }}</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5 text-end justify-content-center">
                                    <label class="align-middle">Αριθμός Τιμολογίου</label>
                                </div>
                                <div class="col-5">
                                    <label class="align-middle">{{ $invoice->shipment->shipment_invoice_number ?: '-' }}</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5 text-end justify-content-center">
                                    <label class="align-middle">Συνολική χρεώση</label>
                                </div>
                                <div class="col-5">
                                    <label class="align-middle">{{ $invoice->shipment->shipment_price ?: '0' }} €</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5 text-end justify-content-center">
                                    <label class="align-middle">Επιπλέον μεταφορική</label>
                                </div>
                                <div class="col-5">
                                    <label class="align-middle">
                                        @if ($invoice->shipment->extra_shipper_id == null)
                                            {{'-'}}
                                        @else
                                            {{ $invoice->shipment->extraShipper->name }}    
                                        @endif
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5 text-end justify-content-center">
                                    <label class="align-middle">Xρεώση 2ης μεταφορικής</label>
                                </div>
                                <div class="col-5">
                                    <label class="align-middle">{{ $invoice->shipment->extra_price ?: '-'}} €</label>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 5%">α/α</th>
                            <th>DCode</th>
                            <th>Κωδικός Προμηθευτή</th>
                            <th>Ποσ.</th>
                            <th>Μ/Μ</th>
                            <th>Ανά συσκ.</th>
                            <th>Περιγραφή προϊόντος</th>
                            <th>Τιμή μονάδας</th>
                            <th>Καθαρή αξία</th>
                            <th>Έκπτωση (%)</th>
                            <th>Αξία</th>
                            <th>ΦΠΑ (%)</th>
                            <th>ΦΠΑ (€)</th>
                            <th>Τελική Τιμή</th>
                        </tr>
                    </thead>
                    <tbody>    
                        @php
                            $count = 0
                        @endphp          
                        @foreach ($details as $detail)
                            @php
                                $count +=1;
                            @endphp
                            <tr>
                                <td style="width: 3%" class="p-0 order-font">{{ $count }}</td>
                                <td style="width: 6%" class="p-0 text-start order-font">{{ $detail->product->detsis_code }}</td>
                                <td style="width: 10%" class="p-0 text-start ps-2 order-font">{{ $detail->product->product_code }}</td>
                                <td style="width: 3%" class="p-0 text-end pe-3 order-font">{{ $detail->quantity }}</td>
                                <td style="width: 3%" class="p-0 text-start order-font">{{ $detail->measurement_unit == null ?: 'ΤΕΜ' }}</td>
                                <td style="width: 5%" class="p-0 text-start order-font">{{ $detail->items_per_package == null ?: '1'}}</td>
                                <td style="width: 30%" class="p-0 text-start ps-2 order-font" >{{ $detail->product->product_name }}</td>
                                <td style="width: 5%" class="p-0 pe-3 text-end">{{ number_format($detail->net_value, 4, ",", ".") }}</td>
                                <td style="width: 5%" class="p-0 pe-3 text-end">{{ number_format ($detail->net_value * $detail->quantity , 2, ",", ".")}}</td>
                                <td style="width: 5%" class="p-0 pe-3 text-end">{{ number_format ($detail->product_discount, 2, ",", ".") }}</td>
                                <td style="width: 5%" class="p-0 pe-3 text-end">{{ number_format (($detail->net_value * $detail->quantity) - ($detail->net_value * $detail->quantity)* $detail->product_discount/100, 2, ",", ".") }}</td>
                                <td style="width: 5%" class="p-0 pe-3 text-end">{{ number_format ($detail->tax_rate , 2, ",", ".")}}</td>
                                <td style="width: 5%" class="p-0 pe-3 text-end">{{ number_format ((($detail->net_value * $detail->quantity) - ($detail->net_value * $detail->quantity)* $detail->product_discount/100) * $detail->tax_rate/100 , 2, ",", ".")}}</td>
                                <td style="width: 10%" class="p-0 pe-3 text-end">{{ number_format ($detail->price, 2, ",", ".") }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="row m-2">
                <div class="col-7 border rounded">
                    <div class="m-2">Σημειώσεις :</div>
                    <textarea cols="90" rows="10">{{ $invoice->notes }}</textarea>
                </div>
                <div class="col-1"></div>
                <div class="col-3 border rounded-start">
                    <div class="row">
                        <div class="text-end">Συνολική καθαρή αξία :</div>
                    </div>
                    <div class="row">
                        <div class="text-end">Έκπτωση παραγγελίας:</div>
                    </div>
                    <div class="row">
                        <div class="text-end">Επιβαρύνσεις (€):</div>
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
                <div class="col-1 border rounded-end">
                    <div class="row"><div class="text-end">{{ number_format ($invoice->invoice_total / (1 + $invoice->invoice_tax_rate/100) - $invoice->extra_charges, 2, ",", ".") }}</div></div>
                    <div class="row"><div class="text-end">{{ number_format ($invoice->order_discount, 2, ",", ".") }}</div></div>
                    <div class="row"><div class="text-end">{{ number_format ($invoice->extra_charges, 2, ",", ".") }}</div></div>
                    <div class="row"><div class="text-end">{{ number_format ($invoice->invoice_tax_rate, 2, ",", ".")}}</div></div>
                    <div class="row"><div class="text-end">{{ number_format ($invoice->invoice_total - $invoice->invoice_total / (1 + $invoice->invoice_tax_rate/100) - $invoice->extra_charges, 2, ",", ".") }}</div></div>
                    <div class="row"><div class="text-end">{{ number_format ($invoice->invoice_total, 2, ",", ".") }}</div></div>
                </div>
            </div>
        </div><!-- card body-->
        
        <div class="card-footer text-center py-2">
            <a href="/invoices" class="btn btn-info shadow-sm">  Ακύρωση - Επιστροφή </a>
        </div>
    </div><!-- card -->
</div>
@endsection


