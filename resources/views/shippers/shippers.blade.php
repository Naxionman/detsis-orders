@extends ('template')

@section('title', 'Μεταφορικές')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Μεταφορικές εταιρείες</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/">Αρχική σελίδα</a></li>
                <li class="breadcrumb-item active">Μεταφορικές</li>
            </ol>
                <div class="card mb-4">
                    <a href="/add_shipper" class="btn btn-warning" >Προσθήκη Μεταφορικής</a>    
                </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                        Πίνακας Μεταφορικών
                </div>
                <div class="card-body">
                    <table id="myTable" class="cell-border display compact">
                        <thead>
                            <tr>
                                <th>Ονομασία</th>
                                <th>Τηλέφωνο</th>
                                <th>Παραγγελίες</th>
                                <th>Αυτό το μήνα</th>
                                <th>Σύνολο €</th>
                                <th>Στοιχεία Ελέγχου</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Ονομασία</th>
                                <th>Τηλέφωνο</th>
                                <th>Παραγγελίες</th>
                                <th>Αυτό το μήνα</th>
                                <th>Σύνολο €</th>
                                <th>Στοιχεία Ελέγχου</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        @forelse ($shippers as $shipper)
                            <tr>
                                <td><strong>{{$shipper->name }}</strong></td>
                                <td>{{ $shipper->phone }}</td>
                                <td>{{ $shipments->where('shipper_id',$shipper->id)->count() }}</td>
                                <td>
                                    @php
                                        $month_shipments = 0;
                                        $shipper_shipments = $shipments->where('shipper_id',$shipper->id)->all();
                                        foreach ($shipper_shipments as $shipper_shipment) {
                                            if($shipper_shipment->shipping_date->month == Date('m')){
                                                $month_shipments += 1;
                                            }
                                        }
                                    @endphp
                                    {{ $month_shipments }}</td>
                                <td>
                                    @php
                                        $shipper_total = 0;
                                        foreach ($shipments as $shipment) {
                                            if($shipment->shipper_id == $shipper->id){
                                                $shipper_total += $shipment->shipment_price;
                                            }
                                            if ($shipment->extra_shipper_id == $shipper->id){
                                                $shipper_total += $shipment->extra_price;
                                            }
                                        }
                                    @endphp
                                    <strong>{{ number_format($shipper_total,2,",",".") }} €</strong>
                                </td>
                                <td style="width:15%" >
                                    <div class="d-flex justify-content-evenly">
                                        <a href="/edit_shipper/{{ $shipper->id }}" class="btn btn-sm btn-warning flex-fill">
                                            <i class="far fa-edit"></i>Edit</a>
                                            <form action="/shippers/{{ $shipper->id }}" id="deleteForm" method="POST">
                                            @method('DELETE')
                                            @csrf
                                                <button class="btn btn-sm btn-danger show_confirm"><i class="far fa-trash-alt"></i></button>
                                            </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            Δεν υπάρχουν καταχωρημένες μεταφορικές στην βάση δεδομένων.
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