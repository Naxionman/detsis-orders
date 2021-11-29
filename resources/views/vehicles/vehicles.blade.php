@extends ('template')

@section('title', 'Οχήματα')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Oχήματα</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/">Αρχική σελίδα</a></li>
                <li class="breadcrumb-item active">Οχήματα</li>
            </ol>
                <div class="card mb-4">
                    <a href="/add_vehicle" class="btn btn-warning" >Προσθήκη Οχήματος</a>    
                </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                        Πίνακας Οχημάτων

                    <a class="btn btn-dark" href="/kteo">KTEO</a>
                    <a class="btn btn-dark" href="/car_services">Βλάβες - Services</a>
                    <a class="btn btn-dark" href="/insurance">Ασφάλειες</a>
                </div>
                <div class="card-body">
                    <table id="myTable" class="cell-border display compact">
                        <thead>
                            <tr >
                                <th>Ονομασία</th>
                                <th>Πινακίδα</th>
                                <th>Λήξη ασφάλισης</th>
                                <th>Τελευταίο service</th>
                                <th>Επόμενο ΚΤΕΟ</th>
                                <th>Στοιχεία Ελέγχου</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Ονομασία</th>
                                <th>Πινακίδα</th>
                                <th>Λήξη ασφάλισης</th>
                                <th>Τελευταίο service</th>
                                <th>Επόμενο ΚΤΕΟ</th>
                                <th>Στοιχεία Ελέγχου</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        @forelse ($vehicles as $vehicle)
                            <tr data-href="view_vehicle/{{ $vehicle->id}}">
                                <td><strong>{{$vehicle->name }}</strong></td>
                                <td>{{ $vehicle->plate }}</td>
                                <td>insurance</td>
                                <td>service</td>
                                <td>kteo</td>
                                <td style="width:15%" >
                                    <div class="d-flex justify-content-evenly">
                                        <a href="/edit_vehicle/{{ $vehicle->id }}" class="btn btn-warning flex-fill">
                                            <i class="far fa-edit"></i>Edit</a>
                                            <form action="/vehicles/{{ $vehicle->id }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                                <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                            </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <strong> Δεν υπάρχουν καταχωρημένα οχήματα στην βάση δεδομένων.</strong>
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