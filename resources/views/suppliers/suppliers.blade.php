@extends ('template')

@section('title', 'Προμηθευτές')


@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Προμηθευτές</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/">Αρχική σελίδα</a></li>
                <li class="breadcrumb-item active">Προμηθευτές</li>
            </ol>
                <div class="card mb-4">
                    <a href="/add_supplier" class="btn btn-success" >Προσθήκη προμηθευτή</a>    
                </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                        Πίνακας προμηθευτών
                </div>
                <div class="card-body">
                    <table id="myTable" class="cell-border display compact">
                        <thead>
                            <tr>
                                <th>Ονομασία</th>
                                <th>email</th>
                                <th>Τηλέφωνο</th>
                                <th>Πόλη</th>
                                <th>Παραγγελίες</th>
                                <th>Σύνολο €</th>
                                <th>Στοιχεία Ελέγχου</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Ονομασία</th>
                                <th>email</th>
                                <th>Τηλέφωνο</th>
                                <th>Πόλη</th>
                                <th>Παραγγελίες</th>
                                <th>Σύνολο €</th>
                                <th>Στοιχεία Ελέγχου</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        @forelse ($suppliers as $supplier)
                            <tr>
                                <td><strong>{{$supplier->company_name }}</strong></td>
                                <td>{{$supplier->email }}</td>
                                <td>{{$supplier->phone1 }}</td>
                                <td>{{$supplier->phone1 }}</td>
                                <td>0</td>
                                <td>0 €</td>
                                <td style="width:15%" >
                                    <div class="d-flex justify-content-evenly">
                                        <a href="/edit_supplier/{{ $supplier->id }}" class="btn btn-warning ">
                                            <i class="far fa-edit"></i>Edit</a>
                                            <form action="/edit_supplier/{{ $supplier->id }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                                <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                            </form>
                                        


                                    </div>
                                </td>
                            </tr>
                        @empty
                            No suppliers added in the database.
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
    </div>

    
@endsection