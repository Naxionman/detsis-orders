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
                    <a href="/add_special_invoice" class="btn w-100 btn-danger" >Νέο Τιμολόγιο</a>
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
                    <table id="invoicesTable" class="cell-border display compact">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Ημερομηνία</th>
                                <th>Προμηθευτής</th>
                                <th>Αριθμός</th>
                                <th>Παραγγελίες</th>
                                <th>Πληρωτέο</th>
                                <th>Αφορά</th>
                                <th>Στοιχεία Ελέγχου</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>id</th>
                                <th>Ημερομηνία</th>
                                <th>Προμηθευτής</th>
                                <th>Αριθμός</th>
                                <th>Παραγγελίες</th>
                                <th>Πληρωτέο</th>
                                <th>Αφορά</th>
                                <th>Στοιχεία Ελέγχου</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            
                        @forelse ($invoices as $invoice)
                            <tr data-href="view_invoice/{{ $invoice->id}}">
                                <td>{{ $invoice->id }}</td>
                                <td>{{ $invoice->invoice_date->format('d-m-Y') }}</td>
                                <td>{{ $invoice->supplier->company_name }}</td>
                                <td>{{ $invoice->supplier_invoice_number }}</td>
                                <td>
                                    @foreach ($details as $detail)
                                        @if($invoice->id == $detail->invoice_id)
                                            @if ($detail->order_id == null)
                                                {{ '-' }}
                                                @break
                                            @else
                                                <a href="/view_order/{{ $detail->order_id }}">{{ $detail->order_id }}</a>                                                    
                                            @endif
                                        @endif
                                    @endforeach
                                </td>
                                <td class="text-end pe-2">{{ number_format($invoice->invoice_total,2,",",".") }} €</td>
                                <td>{{ $invoice->invoice_type }}</td>
                                <td style="width:15%" >
                                    <div class="d-flex justify-content-evenly">
                                        <a href="/edit_invoice/{{ $invoice->id }}" class="btn btn-sm btn-warning">
                                            <i class="far fa-edit"></i>Edit</a>
                                            <form action="/invoices/{{ $invoice->id }}" id="deleteForm" method="POST">
                                            @method('DELETE')
                                            @csrf
                                                <a type="button" class="btn btn-danger show_confirm"><i class="far fa-trash-alt"></i></a>
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
    <script type = "text/javascript">$(document).ready( function () {$('#invoicesTable').DataTable({
        order: [[1,'desc']],
        columnDefs: [{ 
                    type: 'date-eu', targets: [1] }]}  
        );});</script>
    
@endsection