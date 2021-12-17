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
                                    <label class="align-middle">{{ $invoice->orders->first()->id }}</label>
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
                                    <label class="align-middle">{{ $invoice->shipment->shipment_invoice_number }}</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5 text-end justify-content-center">
                                    <label class="align-middle">Συνολική χρεώση</label>
                                </div>
                                <div class="col-5">
                                    <label class="align-middle">{{ $invoice->shipment->shipment_price }} €</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5 text-end justify-content-center">
                                    <label class="align-middle">Επιπλέον μεταφορική</label>
                                </div>
                                <div class="col-5">
                                    <label class="align-middle">{{ $invoice->shipment->extraShipper->name }}</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5 text-end justify-content-center">
                                    <label class="align-middle">Xρεώση 2ης μεταφορικής</label>
                                </div>
                                <div class="col-5">
                                    <label class="align-middle">{{ $invoice->shipment->extra_price }} €</label>
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
                            <th>Ήρθαν;</th>
                            <th style="width: 5%">α/α</th>
                            <th>DCode</th>
                            <th>Κωδ.Προμηθευτή</th>
                            <th>Ποσότητα</th>
                            <th>Μ/Μ</th>
                            <th>Ανά συσκ.</th>
                            <th>Περιγραφή προϊόντος</th>
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
                        @php
                            $count = 0
                        @endphp          
                        @foreach ($details as $detail)
                        @if ($detail->pending == 1)
                            @php
                                $count +=1;
                            @endphp
                            <tr id="tr">
                                <td>
                                    <div class="form-check"><input class="form-check-input" type="checkbox" value="1" name="arrived{{$count}}" id="check{{$count}}" checked></div>
                                </td>
                                <td style="width: 5%" class="p-0 order-font">{{ $count }}</td>
                                <td style="width: 10%" class="p-0 order-font">{{ $detail->product->detsis_code }}</td>
                                <td style="width: 10%" class="p-0 order-font">{{ $detail->product->product_code }}</td>
                                <td style="width: 5%" class="p-0 order-font">
                                    <input type="number" class="form-control p-0 pe-2 text-end order-font" name="quantity{{$count}}" value="{{ $detail->quantity }}" id="quantity{{$count}}">
                                </td>
                                <td class="p-0">
                                    <input type="text" class="form-control p-0 pe-2 text-end order-font" name="measurement_unit{{$count}}" id="measurementUnit{{$count}}" value="{{ $detail->measurement_unit == null ?: 'ΤΕΜ'}}">
                                </td>
                                <td class="p-0">
                                    <input type="number" class="form-control p-0 pe-2 text-end order-font" name="items_per_package{{$count}}" id="itemsPerPackage{{$count}}" value="{{ $detail->items_per_package == null ?: '1'}}">
                                </td>
                                <td style="width: 30%" class="p-0 order-font" >{{ $detail->product->product_name }}</td>
                                <td style="width: 5%" class="p-0">
                                    <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="net_value{{$count}}" id="netValue{{$count}}" min="0" required>
                                </td>
                                <td style="width: 5%" class="p-0">
                                    <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="sum_net_value{{$count}}" id="sumNetValue{{$count}}" min="0" readonly="readonly">
                                </td>
                                <td style="width: 5%" class="p-0">
                                    <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="product_discount{{$count}}" value="0.00"min="0" max="100" id="productDiscount{{$count}}">
                                </td>
                                <td style="width: 5%" class="p-0">
                                    <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="value{{$count}}" value="0.00"min="0" id="value{{$count}}" readonly="readonly">
                                </td>
                                <td style="width: 5%" class="p-0">
                                    <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="tax_rate{{$count}}" value="24.00" min="0" max="100" id="taxRate{{$count}}">
                                </td>
                                <td style="width: 5%" class="p-0">
                                    <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="tax{{$count}}" min="0" id="tax{{$count}}" readonly="readonly">
                                </td>
                                <td style="width: 10%" class="p-0">
                                    <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="price{{$count}}" min="0" id="price{{$count}}" readonly="readonly">
                                </td>
                            </tr>
                        @else
                            <tr style="color:#808080"">
                                <td>
                                    <input type="hidden" name="arrived{{$count}}" value="0">
                                    <div class="form-check"><input class="form-check-input" type="checkbox" checked disabled>*</div>
                                </td>
                                <td style="width: 5%" class="p-0 order-font">{{ $count }}</td>
                                <td style="width: 10%" class="p-0 order-font">{{ $detail->product->detsis_code }}</td>
                                <td style="width: 10%" class="p-0 order-font">{{ $detail->product->product_code }}</td>
                                <td style="width: 5%" class="p-0 order-font">
                                    <input type="number" class="form-control p-0 pe-2 text-end order-font"  value="{{ $detail->quantity }}" id="quantity{{$count}}"disabled>
                                </td>
                                <td class="p-0">
                                    <input type="text" class="form-control p-0 pe-2 text-end order-font" id="measurementUnit{{$count}}" value="{{ $detail->measurement_unit == null ?: 'ΤΕΜ'}}" disabled>
                                </td>
                                <td class="p-0">
                                    <input type="number" class="form-control p-0 pe-2 text-end order-font" id="itemsPerPackage{{$count}}" value="{{ $detail->items_per_package == null ?: '1'}}"disabled>
                                </td>
                                <td style="width: 30%" class="p-0 order-font" >{{ $detail->product->product_name }}</td>
                                <td style="width: 5%" class="p-0">
                                    <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font"  id="netValue{{$count}}" min="0" disabled>
                                </td>
                                <td style="width: 5%" class="p-0">
                                    <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" min="0" readonly="readonly"disabled>
                                </td>
                                <td style="width: 5%" class="p-0">
                                    <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" value="0.00"min="0" max="100" id="productDiscount{{$count}}"disabled>
                                </td>
                                <td style="width: 5%" class="p-0">
                                    <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" value="0.00"min="0" id="value{{$count}}" readonly="readonly"disabled>
                                </td>
                                <td style="width: 5%" class="p-0">
                                    <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" value="24.00" id="taxRate{{$count}}"disabled>
                                </td>
                                <td style="width: 5%" class="p-0">
                                    <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" id="tax{{$count}}" readonly="readonly"disabled>
                                </td>
                                <td style="width: 10%" class="p-0">
                                    <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" id="price{{$count}}" readonly="readonly">
                                </td>
                            </tr>
                        @endif            
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
                        <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" value="">
                    </div>
                    <div class="row">
                        <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" value="">
                    </div>
                    <div class="row">
                        <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" value="">
                    </div>
                    <div class="row">
                        <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" value="">
                    </div>
                    <div class="row">
                        <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" value="">
                    </div>
                    <div class="row">
                        <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" value="">
                    </div>
                </div>
            </div>
        </div><!-- card body-->
        
        <div class="card-footer text-center py-2">
            <button class="btn btn-danger shadow-sm" type="submit" form="addInvoice">  Αποθήκευση </button>
            <a href="/orders" class="btn btn-info shadow-sm">  Ακύρωση - Επιστροφή </a>
        </div>
    </div><!-- card -->
</div>
@endsection


