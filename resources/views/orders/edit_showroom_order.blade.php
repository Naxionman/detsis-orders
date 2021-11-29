@extends('template')

@section('title', 'Παραγγελία Εμπορίου')

@section('content')
<div class="container">
    <div class="card bg-warning bg-opacity-25 shadow-lg border-0 rounded-3 mt-3 ">
        <div class="card-header"><h3 class="text-center font-weight-light my-2 ">Λεπτομέρειες παραγγελίας</h3></div>
            <div class="card-body bg-light">
                <form action="/edit_showroom_order/{{ $order->id }}" id="editOrderDetails" method="post">
                    @method('PATCH')
                    <!-- General details of order -->
                    <div class="row">
                        <div class="col-5">
                            <h6>Αριθμός παραγγελίας : {{ $order->id }}</h6>
                            <h6>Προμηθευτής : <strong>{{ $order->supplier->company_name }}</strong></h6>
                            <h6>Ημερομηνία παραγγελίας : {{ $order->order_date->format('d-m-Y') }}</h6>
                            <div class="row">
                                <div class="col-4 text-end justify-content-center">
                                    <label for="inputArrivalDate" class="align-middle"><strong>Ημερομηνία άφιξης</strong></label>
                                </div>
                                <div class="col-8">
                                    <input class="form-control" name="arrival_date" type="date" id="inputArrivalDate" required="required">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 text-end justify-content-center">
                                    <label for="inputInvoiceNumber">Αριθμός Τιμολογίου Προμηθευτή</label>
                                </div>
                                <div class="col-8">
                                    <input class="form-control" name="order_invoice_number" type="text" id="inputInvoiceNumber" required="required">
                                </div>
                            </div>
                            
                        </div>

                        <div class="col">
                            <div class="row">
                                <div class="col-4 text-end justify-content-center">
                                        <label for="inputShipper" class="align-middle">Μεταφορική</label>
                                    </div>
                                    <div class="col-8">
                                        <select class="form-control" id="inputShipper" name="shipper_id">
                                            @forelse ($shippers as $shipper)
                                                <option   type="text" value="{{ $shipper->id }}">{{ $shipper->name }}</option>
                                            @empty
                                                <option>Δεν υπάρχουν μεταφορικές στην βάση!</option>
                                            @endforelse
                                        </select>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-4 text-end justify-content-center">
                                        <label for="inputShipmentNumber" class="align-middle">Αριθμός Τιμολογίου</label>
                                    </div>
                                    <div class="col-8">
                                        <input class="form-control" name="invoice_number" type="text" id="inputShipmentNumber" autocomplete="off" required="required">
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
                                    <label for="inputExtraPrice" class="align-middle">Xρεώση της επιπλέον μεταφορικής</label>
                                </div>
                                <div class="col-8">
                                    <input class="form-control" name="extra_price" type="number" step="0.01" id="inputExtraPrice" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- List of ordered goods -->
                    <div class="row">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
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
                            @foreach ($order_details as $detail)
                                @php
                                    $count +=1;
                                @endphp
           
                                <tr>
                                    <tr>
                                        <input type="hidden" name="product_id{{$count}}" value="{{ $detail->product->id }}">
                                        <input type="hidden" name="detail_id{{$count}}" value="{{ $detail->id }}">
                                        <td style="width: 5%" class="p-0 order-font">{{ $count }}</td>
                                        <td style="width: 10%" class="p-0 order-font">{{ $detail->product->detsis_code }}</td>
                                        <td style="width: 10%" class="p-0 order-font">{{ $detail->product->product_code }}</td>
                                        <td style="width: 5%" class="p-0 order-font">
                                            <input type="number" class="form-control p-0 pe-2 text-end order-font" name="quantity{{$count}}" value="{{ $detail->quantity }}" id="quantity{{$count}}">
                                        </td>
                                        <td class="p-0">
                                            <input type="text" class="form-control p-0 pe-2 text-end order-font" name="measurement_unit{{$count}}" placeholder="M/M">
                                        </td>
                                        <td class="p-0">
                                            <input type="number" class="form-control p-0 pe-2 text-end order-font" name="items_per_package{{$count}}">
                                        </td>
                                        <td style="width: 20%" class="p-0 order-font" >{{ $detail->product->product_name }}</td>
                                        <td style="width: 5%" class="p-0">
                                            <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="net_value{{$count}}" id="netValue{{$count}}" min="0" required>
                                        </td>
                                        <td style="width: 5%" class="p-0">
                                            <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="sum_net_value{{$count}}" id="sumNetValue{{$count}}" min="0" required>
                                        </td>
                                        <td style="width: 5%" class="p-0">
                                            <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="product_discount{{$count}}" value="0.00"min="0" max="100" id="productDiscount{{$count}}">
                                        </td>
                                        <td style="width: 5%" class="p-0">
                                            <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="value{{$count}}" value="0.00"min="0" id="value{{$count}}">
                                        </td>
                                        <td style="width: 5%" class="p-0">
                                            <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="tax_rate{{$count}}" value="24.00" min="0" max="100" id="taxRate{{$count}}">
                                        </td>
                                        <td style="width: 5%" class="p-0">
                                            <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="tax{{$count}}" min="0" id="tax{{$count}}">
                                        </td>
                                        <td style="width: 10%" class="p-0">
                                            <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="price{{$count}}" min="0" id="price{{$count}}" readonly="readonly">
                                        </td>
                                    </tr>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <input type="hidden" name="count" id="count" value="{{$count}}">
                        <input type="hidden" name="order_id" value="{{$detail->order_id}}">
                        <input type="hidden" name="pending" value="0">
                        <input type="hidden" name="supplier_id" value="{{$order->supplier_id}}">
                        
                    </div>
                    <div class="row m-2">
                        <div class="col-7 border rounded">
                            <div class="m-2">Σημειώσεις :</div>
                            <input class="form-control" type="textarea" value=" {{ $order->notes }}" name="notes" class="order-font">
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
                                <input type="number" step="0.01" readonly="readonly" class="form-control p-0 pe-2 text-end order-font" min="0" id="orderNetValue">
                            </div>
                            <div class="row">
                                <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="order_discount" min="0" id="orderDiscount" value="{{ $order->order_discount }}">
                            </div>
                            <div class="row">
                                <input type="number" step="0.01" class="form-control p-0 pe-2 text-end order-font" name="order_tax_rate" value="24.00" min="0" id="orderTaxRate">
                            </div>
                            <div class="row">
                                <input type="number" step="0.01" readonly="readonly" class="form-control p-0 pe-2 text-end order-font" min="0" id="tax">
                            </div>
                            <div class="row">
                                <input type="number" step="0.01" readonly="readonly" class="form-control p-0 pe-2 text-end order-font" name="order_price" value="{{ number_format($sum - ($sum * $order->order_discount/100),2, ",", ".") }}" min="0" id="orderPrice">
                            </div>
    
                        </div>
                    </div>
                    @csrf
                </form> 
            </div>
            <div class="card-footer text-center py-2">
                <button class="btn btn-danger" type="submit" form="editOrderDetails">  Αποθήκευση Αλλαγών  </button>
                <a href="/orders" class="btn btn-primary">  Ακύρωση - Επιστροφή </a>
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
<script type="text/javascript">

            
   
   
</script>



@endsection