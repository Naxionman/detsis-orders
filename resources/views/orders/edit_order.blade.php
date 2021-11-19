@extends('template')

@section('title', 'DetsisOrders - Επεξεργασία Παραγγελίας')


@section('content')
<div class="container">
    <div class="card bg-warning bg-opacity-25 shadow-lg border-0 rounded-3 mt-3 ">
        <div class="card-header"><h3 class="text-center font-weight-light my-2 ">Λεπτομέρειες παραγγελίας</h3></div>
            <div class="card-body bg-light">
                <form action="/edit_order/{{ $order->id }}" id="editOrderDetails" method="post">
                    @method('PATCH')
                    <!-- General details of order -->
                    <div class="row">
                        <div class="col-5">
                            <h6>Αριθμός παραγγελίας : {{ $order->id }}</h6>
                            <h6>Προμηθευτής : {{ $order->supplier->company_name }}</h6>
                            <h6>Ημερομηνία παραγγελίας : {{ $order->order_date->format('d-m-Y') }}</h6>
                            
                            <div class="col-4 text-end justify-content-center">
                                <label for="inputArrivalDate" class="align-middle"><strong>Ημερομηνία άφιξης</strong></label>
                            </div>
                            <div class="col-8">
                                <input class="form-control" name="arrival_date" type="date" id="inputArrivalDate" required="required">
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
                                        <label for="inputShipmentNumber" class="align-middle">Συνολική χρεώση</label>
                                    </div>
                                    <div class="col-8">
                                        <input class="form-control" name="shipment_price" type="text" id="inputShipmentNumber" autocomplete="off" required="required">
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
                                    <input class="form-control" name="extra_price" type="number" id="inputExtraPrice" autocomplete="off">
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
                                    <th>Ποσότητα</th>
                                    <th>Μ/Μ</th>
                                    <th>Ανά συσκ.</th>
                                    <th>DCode</th>
                                    <th>Κωδ.Προμηθευτή</th>
                                    <th style="letter-spacing: -1px">Περιγραφή προϊόντος</th>
                                    <th>Καθαρή αξία</th>
                                    <th>Έκπτωση %</th>
                                    <th>ΦΠΑ %</th>
                                    <th>Τιμή</th>
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

                                
                                <input type="hidden" name="count" id="count" value="{{$count}}">
                                <input type="hidden" name="order_id" value="{{$detail->order_id}}">
                                <tr>
                                    <tr>
                                        <td style="width: 5%" class="p-0">{{ $count }}</td>
                                        <td class="form-control p-0 pe-2 text-end">{{ $detail->quantity }}</td>
                                        <td class="p-0">
                                            <input type="text" class="form-control p-0 pe-2 text-end" name="measurement_unit{{$count}}" placeholder="Μονάδα μέτρησης">
                                        </td>
                                        <td class="p-0">
                                            <input type="number" class="form-control p-0 pe-2 text-end" name="items_per_package{{$count}}">
                                        </td>
                                        
                                        <td style="width: 10%" class="p-0">{{ $detail->product->detsis_code }}</td>
                                        <td style="width: 10%" class="p-0">{{ $detail->product->product_code }}</td>
                                        <td style="width: 20%" class="p-0">{{ $detail->product->product_name }}</td>
                                        <td style="width: 10%" class="p-0">
                                            <input type="number" step="0.01"  class="form-control p-0 pe-2 text-end" name="net_value{{$count}}" id="net_value{{$count}}" min="0" required>
                                        </td>
                                        <td style="width: 5%" class="p-0">
                                            <input type="number" step="0.01"  class="form-control p-0 pe-2 text-end" name="product_discount{{$count}}" value="0.00"min="0" max="100" id="product_discount{{$count}}">
                                        </td>
                                        <td style="width: 5%" class="p-0">
                                            <input type="number" step="0.01" class="form-control p-0 pe-2 text-end" name="tax_rate{{$count}}" value="24.00" min="0" max="100" id="tax_rate{{$count}}">
                                        </td>
                                        <td style="width: 10%" class="p-0">
                                            <input type="number" step="0.01" class="form-control p-0 pe-2 text-end" readonly="readonly" name="price{{$count}}" min="0" id="price{{$count}}" required>
                                        </td>
                                    </tr>
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
                                <input type="number" step="0.01" readonly="readonly" class="form-control p-0 pe-2 text-end" min="0" id="orderNetValue">
                            </div>
                            <div class="row">
                                <input type="number" step="0.01" class="form-control p-0 pe-2 text-end" name="order_discount" min="0" id="orderDiscount" value="{{ $order->order_discount }}">
                            </div>
                            <div class="row">
                                <input type="number" step="0.01" readonly="readonly" class="form-control p-0 pe-2 text-end" min="0" id="tax">
                            </div>
                            <div class="row">
                                <input type="number" step="0.01" class="form-control p-0 pe-2 text-end" name="order_price" value="{{ $order->order_price}}" min="0" id="orderPrice">
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


