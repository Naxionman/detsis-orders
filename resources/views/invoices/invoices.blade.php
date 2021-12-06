@extends ('template')

@section('title', 'Τιμολόγια')


@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Τιμολόγια προμηθευτών</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/">Αρχική σελίδα</a></li>
                <li class="breadcrumb-item active">Τιμολόγια</li>
            </ol>
                <div class="card mb-4">
                    <a href="/add_order" class="btn w-100 btn-danger" >Νέο Τιμολόγιο</a>
                </div>
            <div class="card mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-4"><i class="fas fa-table me-1"></i>Τιμολόγια</div> 
                        <div class="form-check form-switch col">
                            <label class="form-check-label" for="switchShowroom">Μόνο Έκθεσης</label>
                            <input class="form-check-input" type="checkbox" id="switchShowroom">
                        </div>
                        <div class="form-check form-switch col">
                            <label class="form-check-label" for="switchFactory">Μόνο Εργοστασίου</label>
                            <input class="form-check-input" type="checkbox" id="switchFactory">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="myTable" class="cell-border display compact">
                        <thead>
                            <tr>
                                <th>α/α</th>
                                <th>Ημερομηνία</th>
                                <th>Προμηθευτής</th>
                                <th>Αφορά</th>
                                <th>Άφιξη</th>
                                <th>Σύνολο</th>
                                <th>Στοιχεία Ελέγχου</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>α/α</th>
                                <th>Ημερομηνία</th>
                                <th>Προμηθευτής</th>
                                <th>Αφορά</th>
                                <th>Άφιξη</th>
                                <th>Σύνολο</th>
                                <th>Στοιχεία Ελέγχου</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            
                        @forelse ($invoices as $invoice)
                            <tr data-href="view_invoice/{{ $invoice->id}}">
                                <td>{{ $invoice->id }}</td>
                                <td>{{ $invoice->arrival_date->format('d-m-Y') }}</td>
                                <td>{{ $invoice->supplier->company_name }}</td>
                                <td>
                                    @php
                                        $detail = $order->orderDetails()->first();
                                        if($detail->product_id == 1){
                                            echo "Εμπόριο"; //This is about the showroom orders
                                        } else{
                                            echo "Εργοστάσιο"; //This is about the factory orders
                                        }
                                    @endphp
                                </td>
                                <td>{{$invoice->invoice_total}}</td>
                                <td style="width:15%" >
                                    <div class="d-flex justify-content-evenly">
                                        <a href="/edit_invoice/{{ $invoice->id }}" class="btn btn-sm btn-warning">
                                            <i class="far fa-edit"></i>Edit</a>
                                            <form action="/invoices/{{ $invoice->id }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                                <button class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></button>
                                            </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            No invoices added in the database.
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"type="text/javascript"></script>
    <script type="text/javascript" src="https:////cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.11/sorting/date-eu.js"></script>
    <script type = "text/javascript">$(document).ready( function () {$('#myTable').DataTable();});</script>
    
@endsection