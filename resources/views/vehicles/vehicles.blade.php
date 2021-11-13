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
                </div>
                <div class="card-body">
                    <table id="myTable" class="cell-border display compact">
                        <thead>
                            <tr>
                                <th>Ονομασία</th>
                                
                                <th>Στοιχεία Ελέγχου</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Ονομασία</th>
                                
                                <th>Στοιχεία Ελέγχου</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        @forelse ($vehicles as $vehicle)
                            <tr>
                                <td><strong>{{$vehicle->name }}</strong></td>
                                
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

    
@endsection