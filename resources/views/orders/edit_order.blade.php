@extends('template')

@section('title', 'DetsisOrders - Επεξεργασία Παραγγελίας')


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
                        <form action="/edit_oder" method="post">
                            <label for="inputShipper">Μεταφορική</label>
                            <select class="form-control" id="inputShipper" name="shipper_id">
                                @forelse ($shippers as $shipper)
                                    <option   type="text" value="{{ $shipper->id }}">{{ $shipper->name }}</option>
                                @empty
                                    <option>Δεν υπάρχουν μεταφορικές στην βάση!</option>
                                @endforelse
                            </select>
                        </form>
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
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
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
