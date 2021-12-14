@extends('template')

@section('title', 'DetsisOrders - Λεπτομέρειες παραγγελίας')

@section('content')
<div class="container">
    <div class="card bg-success bg-opacity-25 shadow-lg border-0 rounded-3 mt-3 ">
        <div class="card-header"><h3 class="text-center font-weight-light my-2 "><strong>Λεπτομέρειες παραγγελίας</strong> 
            @if($order->arrival_date !=null)
                - Συσχετισμένο τιμολόγιο :
                @foreach ($order->invoices as $invoice)
                    <a href="/view_invoice/{{ $invoice->id }}"> {{ $invoice->id }}</a>
                @endforeach
            @endif
            </h3></div>
            <div class="card-body bg-light">
                <!-- General details of order -->
                <div class="row">
                    <h6>Αριθμός παραγγελίας : {{ $order->id }}</h6>
                    <h6>Προμηθευτής : <strong>{{ $order->supplier->company_name }}</strong></h6>
                    <h6>Ημερομηνία παραγγελίας : {{ $order->order_date->format('d-m-Y') }}</h6>
                    <h6>Ημερομηνία άφιξης : 
                        @php
                            if($order->arrival_date == null){
                                echo "Δεν έχει παραδοθεί ακόμα";
                            } else {
                                echo $order->arrival_date->format('d-m-Y');
                            }
                        @endphp
                    </h6>    
                </div>
                <!-- List of ordered goods -->
                <div class="row">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Ήρθε;</th>
                                <th style="width: 5%">α/α</th>
                                <th>DCode</th>
                                <th>Κωδ.Προμηθευτή</th>
                                <th>Ποσότητα</th>
                                <th>Μ/Μ</th>
                                <th>Ανά συσκ.</th>
                                <th>Περιγραφή προϊόντος</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                        @foreach ($order_details as $detail)
                            @if($detail->pending == 0)
                                <tr style="color:#808080">
                                    <td><input class="form-check-input" type="checkbox" checked disabled></td>
                                    <td>{{ $detail->id }}</td>
                                    <td>{{ $detail->product->detsis_code }}</td>
                                    <td>{{ $detail->product->product_code }}</td>
                                    <td>{{ $detail->quantity }}</td>
                                    <td>{{ $detail->measurement_unit }}</td>
                                    <td>{{ $detail->items_per_package }}</td>
                                    <td>{{ $detail->product->product_name }}</td>
                                </tr>
                            @else
                            <tr>
                                <td><input class="form-check-input" type="checkbox" disabled></td>
                                <td>{{ $detail->id }}</td>
                                <td>{{ $detail->product->detsis_code }}</td>
                                <td>{{ $detail->product->product_code }}</td>
                                <td>{{ $detail->quantity }}</td>
                                <td>{{ $detail->measurement_unit }}</td>
                                <td>{{ $detail->items_per_package }}</td>
                                <td>{{ $detail->product->product_name }}</td>
                            </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row m-2  border border-box rounded-3">
                    <div class="wrapper m-2">Σημειώσεις :
                        <textarea rows="4" class="form-control" autocomplete="nope" type="text" >{{ $order->notes }}</textarea>
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