@extends ('template')

@section('title', 'Ημερήσια κίνηση οχημάτων')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Κινήσεις</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/">Αρχική σελίδα</a></li>
                <li class="breadcrumb-item active">Κινήσεις</li>
            </ol>
                <div class="card mb-4">
                    <a href="/add_dispatch" class="btn btn-warning" >Προσθήκη Κίνησης</a>    
                </div>
            <div class="card mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-3">
                            <i class="fas fa-car me-1"></i>
                            Ημερολόγιο κινήσεων
                        </div>
                        <div class="col">
                            <a class="btn btn-secondary" href="/dispatch_log"><i class="fas fa-print ms-5"></i>Εκτύπωση δελτίου απόσπασης</a>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <table id="dispatchesTable" class="cell-border display compact">
                        <thead>
                            <tr>
                                <th>Ημερομηνία</th>
                                <th>Όχημα</th>
                                <th>Πελάτης</th>
                                <th>Διεύθυνση</th>
                                <th>Πλήρωμα</th>
                                <th>Στοιχεία Ελέγχου</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Ημερομηνία</th>
                                <th>Όχημα</th>
                                <th>Πελάτης</th>
                                <th>Διεύθυνση</th>
                                <th>Πλήρωμα</th>
                                <th>Στοιχεία Ελέγχου</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        @forelse ($dispatches as $dispatch)
                            <tr>
                                <td><strong>{{ $dispatch->dispatch_date->format('d-m-Y') }}</strong></td>                                
                                <td>{{ $dispatch->vehicle->name }}</td>
                                <td>{{ $dispatch->client->surname }} {{$dispatch->client->name}}</td>
                                <td>{{ $dispatch->address }}</td>
                                <td>@foreach ($dispatch->employees as $employee)
                                    {{ $employee->surname }},
                                @endforeach</td>
                                <td style="width:15%" >
                                    <div class="d-flex justify-content-evenly">
                                        <a href="/edit_dispatch/{{ $dispatch->id }}" class="btn btn-warning flex-fill">
                                            <i class="far fa-edit"></i>Edit</a>
                                            <form action="/dispatches/{{ $dispatch->id }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                                <button class="btn btn-danger show_confirm"><i class="far fa-trash-alt"></i></button>
                                            </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <strong> Δεν υπάρχουν καταχωρημένες κινήσεις στην βάση δεδομένων.</strong>
                            <hr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"type="text/javascript"></script>
    <script type="text/javascript" src="https:////cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.11/sorting/date-eu.js"></script>
    <script type = "text/javascript">$(document).ready( function () {$('#dispatchesTable').DataTable();});</script>
@endsection