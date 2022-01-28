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
                                <th></th>
                                <th></th>
                                <th>Σύνολο μήνα ΔΙΟΝΥΣΟΥ :</th>
                                <th>{{ number_format ($current_month_sum, 2, ",", ".") }}</th>
                                <th></th>
                                <th>Σύνολο προηγούμενου :</th>
                                <th>{{ number_format ($last_month_sum, 2, ",", ".") }}</th>
                                <th></th>
                            </tr>
                        </tfoot>
                        <tbody>
                        @forelse ($shipments as $shipment)
                            @if ($shipment->shipper->id > 1)
                            <tr data-href="view_shipment/{{ $shipment->id}}">
                                <td>{{ $shipment->shipping_date->format('d-m-Y') }}</td>
                                <td>{{ $shipment->shipper->name }}</td>
                                <td>{{ $shipment->supplier->company_name }}</td>
                                <td>{{ $shipment->shipment_invoice_number }}</td>
                                <td>@if ($shipment->extra_shipper_id != null)
                                    {{ $shipment->extraShipper->name }}
                                @endif
                                </td>
                                <td class="text-end pe-2">{{ number_format ($shipment->extra_price, 2, ",", ".") }}</td>
                                <td class="text-end pe-2">{{ number_format ($shipment->shipment_price, 2, ",", ".") }}</td>
                                <td style="width:15%" >
                                    <div class="d-flex justify-content-evenly">
                                        <a href="/edit_shipment/{{ $shipment->id }}" class="btn btn-sm btn-warning flex-fill">
                                            <i class="far fa-edit"></i>Edit</a>
                                            <form action="/shipments/{{ $shipment->id }}" id="deleteForm" method="POST">
                                            @method('DELETE')
                                            @csrf
                                                <button class="btn btn-sm btn-danger show_confirm"><i class="far fa-trash-alt"></i></button>
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