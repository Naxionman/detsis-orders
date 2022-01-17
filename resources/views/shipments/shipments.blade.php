@extends ('template')

@section('title', 'Τιμολόγια μεταφορικών')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Τιμολόγια μεταφορικών</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/">Αρχική σελίδα</a></li>
                <li class="breadcrumb-item active">Τιμολόγια Μεταφορικών</li>
            </ol>
                <div class="card mb-4">
                    <a href="/add_shipment" class="btn btn-success" >Προσθήκη Τιμολογίου Μεταφορικής</a>    
                </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                        Πίνακας Τιμολογίων Μεταφορικών
                </div>
                <div class="card-body">
                    <table id="shipmentsTable" class="cell-border display compact">
                        <thead>
                            <tr>
                                <th>Ημερομηνία</th>
                                <th>Μεταφορική</th>
                                <th>Προμηθευτής</th>
                                <th>Αριθμός</th>
                                <th>2η μεταφορική</th>
                                <th>Ποσό 2ης</th>
                                <th>Ποσό</th>
                                <th>Στοιχεία Ελέγχου</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Ημερομηνία</th>
                                <th>Μεταφορική</th>
                                <th>Προμηθευτής</th>
                                <th>Αριθμός</th>
                                <th>2η μεταφορική</th>
                                <th>Ποσό 2ης</th>
                                <th>Ποσό</th>
                                <th>Στοιχεία Ελέγχου</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        @forelse ($shipments as $shipment)
                            @if ($shipment->shipper->id != 1)
                            <tr>
                                <th>{{ $shipment->shipping_date->format('d-m-Y') }}</th>
                                <th>{{ $shipment->shipper->name }}</th>
                                <th>{{ $shipment->supplier->company_name }}</th>
                                <th>{{ $shipment->shipment_invoice_number }}</th>
                                <th>@if ($shipment->extra_price > 0)
                                    {{ $shipment->extraShipper->shipper->name }}
                                @endif
                                </th>
                                <th class="text-end pe-2">{{ number_format ($shipment->extra_price, 2, ",", ".") }}</th>
                                <th class="text-end pe-2">{{ number_format ($shipment->shipment_price, 2, ",", ".") }}</th>
                                <td style="width:15%" >
                                    <div class="d-flex justify-content-evenly">
                                        <a href="/edit_shipment/{{ $shipment->id }}" class="btn btn-sm btn-warning flex-fill">
                                            <i class="far fa-edit"></i>Edit</a>
                                            <form action="/shipments/{{ $shipment->id }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                                <button class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></button>
                                            </form>
                                    </div>
                                </td>
                            </tr>
                            @endif
                        @empty
                            Δεν υπάρχουν τιμολόγια μεταφορικών στην βάση.
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
        $(document).ready( function () {$('#shipmentsTable').DataTable({
            columnDefs: [{ 
                type: 'date-eu', targets: [0] }]}  
            );});
    </script>
    
@endsection