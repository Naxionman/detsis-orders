@extends('template')

@section('title', 'DetsisOrders - Λεπτομέρειες παραγγελίας')

@section('content')
<div class="container">
    <div class="card bg-warning bg-opacity-25 shadow-lg border-0 rounded-3 mt-3 ">
        <div class="card-header"><h3 class="text-center font-weight-light my-2 ">Λεπτομέρειες παραγγελίας
            @if($order->arrival_date !=null)
                @foreach ($order->invoices as $invoice)
                    @if ($invoice->orderDetails->order_id == $order->id)
                        
                        <a href="/invoices/{{ $invoice->id }}"></a>        
                    @endif
                    
                @endforeach
                
            @endif
        
            </h3></div>
            <div class="card-body bg-light">
                <!-- General details of order -->
                <div class="row">
                    <div class="col m-3 border rounded">
                        <h6>Αριθμός παραγγελίας : {{ $order->id }}</h6>
                        <h6>Προμηθευτής : {{ $order->supplier->company_name }}</h6>
                        <h6>Ημερομηνία παραγγελίας : {{ $order->order_date->format('d-m-Y') }}</h6>
                        <h6>Ημερομηνία άφιξης : 
                            @php
                                if($order->arrival_date == null){
                                    echo "Δεν έχει παραδοθεί";
                                } else {
                                    echo $order->arrival_date->format('d-m-Y');
                                }
                            @endphp
                        </h6>    
                    </div>
                    <div class="col m-3">
                        <div class="card">
                            <h5 class="card-header">Τιμολόγιο Μεταφορικής</h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col border-end">
                                        <h6>Μεταφορική : </h6>
                                        <h6>Αριθμός εγγράφου : </h6>
                                        <h6>Χρέωση :</h6>
                                        <h6>Επιπλέον Μεταφορική : </h6>
                                        <h6>Επιπλέον χρέωση : </h6>
                                    </div>
                                    
                                    <div class="col">
                                        <h6>{{ $order->shipment->shipper->name ?? " " }}</h6>
                                        <h6>{{ $order->shipment->invoice_number ?? " " }}</h6>
                                        <h6>{{ number_format($order->shipment->shipment_price ?? '0', 2, ",", ".") }} €</h6>
                                        <h6>{{ $order->shipment->extraShipper->name ?? " " }}</h6>
                                        <h6>{{ number_format($order->shipment->extra_price ?? '0', 2, ",", ".")  }} €</h6>
                                    </div>
                                </div>
                                
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
                        @foreach ($order_details as $detail)
                            <tr>
                                <td>{{ $detail->id }}</td>
                                <td>{{ $detail->product->detsis_code }}</td>
                                <td>{{ $detail->product->product_code }}</td>
                                <td>{{ $detail->quantity }}</td>
                                <td>{{ $detail->measurement_unit }}</td>
                                <td>{{ $detail->items_per_package }}</td>
                                <td>{{ $detail->product->product_name }}</td>
                                <td>{{ number_format($detail->net_value, 2, ",", ".") }}</td>
                                <td>{{ number_format($detail->net_value * $detail->quantity, 2, ",", ".") }}</td>
                                <td>{{ number_format($detail->product_discount, 2, ",", ".") }}</td>
                                <td>{{ number_format($detail->net_value * $detail->quantity - $detail->net_value * $detail->quantity * $detail->product_discount/100 , 2, ",", ".") }}</td>
                                <td>{{ number_format($detail->tax_rate,2, ",", ".") }}</td>
                                <td>{{ number_format(($detail->net_value * $detail->quantity - $detail->net_value * $detail->quantity * $detail->product_discount/100)* $detail->tax_rate /100 ,2, ",", ".") }}</td>
                                <td>{{ number_format($detail->price, 2, ",", ".") }}</td>
                            </tr>
                        
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row m-2">
                    <div class="col-7 border rounded">
                        <div class="m-2">Σημειώσεις :</div>
                        <textarea rows = "4" cols = "92">{{ $order->notes}}</textarea>
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
                        <div class="row"> <!-- Σύνολο αξιών μετά έκπτωσης (προ φόρου) -->
                            <div class="text-end">{{ number_format($order->order_price /(1 + $order->tax_rate/100) + $order->order_price /(1 + $order->tax_rate/100)* $order->order_discount/100 - $order->order_charges  ,2, ",", ".") }} €</div>    
                        </div>
                        <div class="row"> <!-- Η έκπτωση της παραγγελίας συνολικά (όχι επι μέρους εκπτώσεις προϊόντων -->
                            <div class="text-end">{{ number_format($order->order_discount,2, ",", ".") }} %</div>    
                        </div>
                        <div class="row"> <!-- Τυχούσες επιπλέον επιβαρύνσεις -->
                            <div class="text-end">{{ number_format($order->order_charges,2, ",", ".") }} %</div>    
                        </div>
                        <div class="row"> <!-- Ποσοστό του φόρου -->
                            <div class="text-end">{{ number_format($order->tax_rate,2, ",", ".") }} %</div>    
                        </div>
                        <div class="row"> <!-- Συνολικός φόρος σε € -->
                            <div class="text-end">{{ number_format( $order->order_price - $order->order_price /(1 + $order->tax_rate/100) ,2, ",", ".") }} € </div>
                        </div>
                        <div class="row"> <!-- Τελικό σύνολο, πληρωτέο ποσό-->
                            <div class="text-end">{{ number_format( $order->order_price ,2, ",", ".") }} €</div>                            
                        </div>

                    </div>
                </div>
            </div>
            <div class="card-footer text-center py-2">
                 
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
@endsection