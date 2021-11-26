@extends ('template')

@section('title', 'Παραγγελίες')


@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Παραγγελίες</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/">Αρχική σελίδα</a></li>
                <li class="breadcrumb-item active">Παραγγελίες</li>
            </ol>
                <div class="card mb-4">
                    <a href="/add_order" class="btn btn-success" >Νέα παραγγελία</a>    
                </div>
            <div class="card mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-4"><i class="fas fa-table me-1"></i>Παραγγελίες</div> 
                        <div class="form-check form-switch col">
                            <label class="form-check-label" for="switchShowroom">Μόνο Έκθεσης</label>
                            <input class="form-check-input" type="checkbox" id="switchShowroom">
                        </div>
                        <div class="form-check form-switch col">
                            <label class="form-check-label" for="switchFactory">Μόνο Εργοστασίου</label>
                            <input class="form-check-input" type="checkbox" id="switchFactory">
                        </div>
                        <div class="form-check form-switch col">
                            <label class="form-check-label" for="switchPending">Μόνο Ανοικτές</label>
                            <input class="form-check-input" type="checkbox" id="switchPending">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="myTable" class="cell-border display compact">
                        <thead>
                            <tr>
                                <th>α/α</th>
                                <th>Ημερομηνία</th>
                                <th>Καθυστέρηση</th>
                                <th>Προμηθευτής</th>
                                <th>Αφορά</th>
                                <th>Σύνολο</th>
                                <th>Άφιξη</th>
                                <th>Στοιχεία Ελέγχου</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>α/α</th>
                                <th>Ημερομηνία</th>
                                <th>Καθυστέρηση</th>
                                <th>Προμηθευτής</th>
                                <th>Αφορά</th>
                                <th>Σύνολο</th>
                                <th>Άφιξη</th>
                                <th>Στοιχεία Ελέγχου</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            
                        @forelse ($orders as $order)
                            <tr data-href="view_order/{{ $order->id}}">
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->order_date->format('d-m-Y') }}</td>
                                <td>
                                    @php
                                        $start_date = $order->order_date->format('d-m-Y');
                                        $end_date = date("Y-m-d");
                                        // The following subtraction is for seconds, so we need to divide this the diffrence by 86.400 (24/60/60)
                                        $difference = (strtotime($end_date)- strtotime($start_date))/86400;
                                        echo $difference;
                                    @endphp 
                                </td>
                                <td>{{ $order->supplier->company_name }}</td>
                                <td>
                                    @php
                                        $detail = $order->orderDetails()->first();
                                        //dd($detail);
                                        if($detail->product_id == 1){
                                            echo "Εμπόριο"; //This is about the showroom orders
                                        } else{
                                            echo "Εργοστάσιο"; //This is about the factory orders
                                        }
                                    @endphp
                                </td>
                                <td class="text-end">{{ number_format($order->order_price, 2,',','.') }} €</td>
                                <td>
                                    @php
                                    if($order->arrival_date == null){
                                        $id = $order->id;
                                        if($detail->product_id == 1){
                                            echo "<a href='/edit_showroom_order/$id'><button class='btn btn-primary btn-sm' >Άφιξη</button></a>";
                                        }else{
                                            echo "<a href='/edit_order/$id'><button class='btn btn-primary btn-sm' >Άφιξη</button></a>";
                                        }
                                    }else{
                                        echo $order->arrival_date->format('d-m-Y');
                                    } 
                                    @endphp
                                 </td>
                                <td style="width:15%" >
                                    <div class="d-flex justify-content-evenly">
                                        <a href="/edit_order/{{ $order->id }}" class="btn btn-sm btn-warning">
                                            <i class="far fa-edit"></i>Edit</a>
                                            <form action="/orders/{{ $order->id }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                                <button class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></button>
                                            </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            No orders added in the database.
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
    <script type = "text/javascript">
        $(document).ready( function () {
                            //Unfortunately every table must be written separately...
                            $('#myTable').DataTable();
        });
    </script>
    
@endsection