@extends('template')

@section('title', 'DetsisOrders - Λεπτομέρειες παραγγελίας')

@section('content')
<div class="container">
    <div class="card bg-warning bg-opacity-25 shadow-lg border-0 rounded-3 mt-3 ">
        <div class="card-header"><h3 class="text-center font-weight-light my-2 ">Λεπτομέρειες παραγγελίας</h3></div>
            <div class="card-body bg-light">
                <!-- General details of order -->
                <div class="row">
                    <div class="col">
                        <h6>Αριθμός παραγγελίας : {{ $order->id }}</h6>
                        <h6>Προμηθευτής : {{ $order->supplier->company_name }}</h6>
                        <h6>Ημερομηνία παραγγελίας : {{ $order->order_date->format('d-m-Y') }}</h6>
                        <h6>Ημερομηνία άφιξης : {{ $order->arrival_date }}format('d-m-Y')</h6>
                    </div>

                    <div class="col">
                        <h6>Τιμολόγιο Μεταφορικής</h6>
                    </div>
                    
                </div>
                <!-- List of ordered goods -->
                <div class="row">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>α/α</th>
                                <th>Ποσότητα</th>
                                <th>Μ/Μ</th>
                                <th>DCode</th>
                                <th>Κωδ.Προμηθευτή</th>
                                <th>Περιγραφή προϊόντος</th>
                                <th>Καθαρή αξία</th>
                                <th>Έκπτωση %</th>
                                <th>Μετά έκπτωσης</th>
                                <th>ΦΠΑ %</th>
                                <th>Τιμή</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                        @foreach ($order_details as $detail)
                            <tr>
                                <td>{{ $detail->id }}</td>
                                <td>{{ $detail->quantity }}</td>
                                <td>{{ $detail->measurement_unit }}</td>
                                <td>{{ $detail->product->detsis_code }}</td>
                                <td>{{ $detail->product->product_code }}</td>
                                <td>{{ $detail->product->product_name }}</td>
                                <td>{{ $detail->net_value }}</td>
                                <td>{{ ($detail->discount * 100) }}</td>
                                <td>{{ $detail->net_value - ($detail->net_value * $detail->discount) }}</td>
                                <td>{{ ($detail->tax_rate *100)}}</td>
                                <td>{{ $detail->price}}</td>
                            </tr>
                        
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row m-2">
                    <div class="col-7 border rounded">
                        <div class="m-2">Σημειώσεις :</div>
                        <span>{{ $order->notes}}</span>
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
                            <div class="text-end">ΦΠΑ :</div>
                        </div>
                        <div class="row">
                            <div class="text-end">Σύνολο :</div>
                        </div>
                    </div>
                    <div class="col-2 border rounded-end">
                        <div class="row">
                            <div class="text-end">{{ $sum }} €</div>    
                        </div>
                        <div class="row">
                            <div class="text-end">{{ $order->order_discount }} %</div>    
                        </div>
                        <div class="row">
                            <div class="text-end">{{ $sum * 0.24 }} € </div>
                        </div>
                        <div class="row">
                            <div class="text-end">{{ $sum * 1.24 }} €</div>                            
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