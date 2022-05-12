@extends('template')

@section('title', 'DetsisOrders - Λεπτομέρειες παραγγελίας')

@section('content')
<div class="container">
    <div class="card bg-success bg-opacity-25 shadow-lg border-0 rounded-3 mt-3 ">
        <div class="card-header"><h3 class="text-center font-weight-light my-2 "><strong>Λεπτομέρειες παραγγελίας</strong> 
            
            @if($order->arrival_date !=null)
                - Συσχετισμένο τιμολόγιο :
                @foreach ($order_details as $detail)
                    <a href="/view_invoice/{{ $detail->invoice_id }}"> {{ $detail->invoice_id }}</a>
                @endforeach
            @else
                @if ($order->pending == 1)
                        <a class="btn btn-primary shadow-sm btn-sm ms-2" href="/add_invoice/{{$order->id}}">Άφιξη</a>
                        <a href="/edit_order/{{ $order->id }}" class="btn btn-sm btn-warning ms-2 shadow-sm">
                            <i class="far fa-edit"></i>Επεξεργασία</a>
                @endif
            @endif
                <a type="button" form="deleteForm" class="btn btn-danger btn-sm show_confirm ms-5"><i class="far fa-trash-alt"></i></a>
            </h3>
            <form action="/orders/{{ $order->id }}" id="deleteForm" method="POST">
                @method('DELETE')
                @csrf
            </form>
        </div>
            <div class="card-body bg-light">
                <!-- General details of order -->
                <div class="row">
                    <h6>Αριθμός παραγγελίας : {{ $order->id }}</h6>
                    <h6>Πελάτης : {{ $order->client->surname }} {{ $order->client->name }}</h6>
                    <h6>Προμηθευτής : <a href="/view_supplier/{{ $order->supplier->id }}"><strong>{{ $order->supplier->company_name }}</strong></a></h6>
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

                <!-- For the orders of showcase or factory-non-stock there is no need to show the details because they are always the same -->
                @if ($order->order_type == 'Εργοστάσιο')
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
                @endif
                

                <!-- ===== ORDER FILES ===== --> 
                <div class="row m-2 border border-box rounded-3">
                    <div class="row">
                        <div class="col-4">
                            <label for="file" class="form-label">Επισυναπτόμενα αρχεία</label>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($files as $file)
                            <div class="row">
                                <li>
                                    
                                   <a href="{{$file->path}}"><i class="far fa-file-word"></i> {{$file->name}}</a>
                                </li>
                            </div>
                            
                        @endforeach

                    </div>
                    <div class="row">
                        <form action="/upload" method="post" id="uploadForm" enctype="multipart/form-data">
                            <input class="form-control" name="file" type="file" id="file">
                                @error('file')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                            <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                            @csrf
                        </form>
                    </div>    
                    
                
                    <div class="row">
                        <!-- Progress bar -->
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <!-- Display upload status -->
                        <div id="uploadStatus"></div>
                    </div>
                    <!-- Order_files forelse here...-->
                </div>

                <div class="row m-2  border border-box rounded-3">
                    <div class="wrapper m-2">Σημειώσεις : 
                        <button class="btn btn-sm btn-outline-primary mb-2 toPrinter"><i class="fa fa-print"></i>Εκτύπωση σημειώσεων</button>
                        <textarea rows="{{ $rows + 5}}" class="form-control" autocomplete="nope" type="text" id="itemToPrint">{{ $order->notes }}</textarea>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center py-2">
                 
                <a href="javascript:history.back()" class="btn btn-primary">  Ακύρωση - Επιστροφή </a>
            </div>
        </div>
<script>
    //PRINTING
    $(".toPrinter").on('click', function () {
        
        
        $("#itemToPrint").printThis({
            removeScripts: true, 
            importCSS: true,
            header: "<p>Πελάτης :<strong>{{ $order->client->surname }} {{ $order->client->name }}</strong></p><p>Προμηθευτής : <strong>{{ $order->supplier->company_name }}</strong></p><p> Αριθμός Παραγγελίας :<strong> {{$order->id }}</strong>, Ημερομηνία παραγγελίας :<strong>{{ $order->order_date->format('d-m-Y') }}</strong></p>"
        });
    });

</script>

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