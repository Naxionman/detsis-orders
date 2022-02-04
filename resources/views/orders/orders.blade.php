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
                    <a href="/add_order" class="btn w-100 btn-success" >Νέα παραγγελία</a>
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
                        <div class="form-check form-switch col">
                            <label class="form-check-label" for="switchClosed">Μόνο Κλειστές</label>
                            <input class="form-check-input" type="checkbox" id="switchClosed">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="ordersTable" class="cell-border display compact">
                        <thead>
                            <tr>
                                <th>pending</th>
                                <th>α/α</th>
                                <th>Ημερομηνία</th>
                                <th>Καθυστέρηση</th>
                                <th>Πελάτης</th>
                                <th>Προμηθευτής</th>
                                <th>Αφορά</th>
                                <th>Άφιξη</th>
                                <th>Στοιχεία Ελέγχου</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>pending</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Σύνολο παραγγελιών :</th>
                                <th>{{ $orders_count}}</th>
                                <th>Σύνολο Ανοικτών : </th>
                                <th>{{ $orders_pending }}</th>
                                <th></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            
                        @forelse ($orders as $order)
                            <tr data-href="view_order/{{ $order->id}}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $order->notes }}">
                                <td>
                                    @if($order->pending == 0)
                                        Κλειστή
                                    @endif
                                </td>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->order_date->format('d-m-Y') }}</td>
                                <td>
                                    @php
                                        $start_date = $order->order_date->format('d-m-Y');
                                        $end_date = date("Y-m-d");
                                        // The following subtraction is for seconds, so we need to divide this the diffrence by 86.400 (24/60/60)
                                        $difference = (strtotime($end_date)- strtotime($start_date))/86400;
                                        if($order->pending == 1){
                                            echo $difference;
                                        } else {
                                            echo '-';
                                        }
                                        
                                    @endphp 
                                </td>
                                <td>
                                    @if($order->client_id == null)
                                        {{ 'Εργοστάσιο' }}
                                    @else
                                        {{ $order->client->surname }} {{ $order->client->name }}
                                    @endif
                                </td>
                                <td>{{ $order->supplier->company_name }}</td>
                                <td>{{ $order->order_type }}</td>
                                <td>
                                    @if ($order->pending == 1)
                                        <a class="btn btn-primary shadow-sm btn-sm" href="/add_invoice/{{$order->id}}">Άφιξη</a>
                                    @else
                                        {{ $order->arrival_date->format('d-m-Y'); }} 
                                    @endif
                                 </td>
                                <td style="width:15%" >
                                    <div class="d-flex justify-content-evenly">
                                        <a href="/edit_order/{{ $order->id }}" class="btn btn-sm btn-warning">
                                            <i class="far fa-edit"></i>Edit</a>
                                            <form action="/orders/{{ $order->id }}" id="deleteForm" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <a type="button" class="btn btn-sm btn-danger show_confirm"><i class="far fa-trash-alt"></i></a>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"type="text/javascript"></script>
    <script type="text/javascript" src="https:////cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.11/sorting/date-eu.js"></script>
    <script type = "text/javascript">
        $(document).ready( function () {$('#ordersTable').DataTable({
            order: [[1,'desc'],[0,'desc']],
            columnDefs: [{ 
                type: 'date-eu', targets: [1,6], 
                }],
            columnDefs: [{
                targets: 0,
                searchable: true,
                visible: false
                }]
            } 
        );});
    </script>    
@endsection