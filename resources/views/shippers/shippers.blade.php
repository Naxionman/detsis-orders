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
                                <td>{{$shipper->phone }}</td>
                                <td>Δεν έχει υλοποιηθεί ακόμα</td>
                                <td>Δεν έχει υλοποιηθεί ακόμα</td>
                                <td>0</td>
                                <td style="width:15%" >
                                    <div class="d-flex justify-content-evenly">
                                        <a href="/edit_shipper/{{ $shipper->id }}" class="btn btn-warning flex-fill">
                                            <i class="far fa-edit"></i>Edit</a>
                                            <form action="/shippers/{{ $shipper->id }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                                <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
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
    <script type = "text/javascript">
        $(document).ready( function () {
                            //Unfortunately every table must be written separately...
                            $('#myTable').DataTable();
        });
    </script>
    
@endsection