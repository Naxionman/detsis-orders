@extends ('template')

@section('title', 'Παραγγελίες')


@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Παραγγελίες</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/">Αρχική σελίδα</a></li>
                <li class="breadcrumb-item active">Παραγγελίες</li>
            </ol>
                <div class="card mb-4">
                    <a href="/add_order" class="btn btn-success" >Νέα παραγγελία</a>    
                </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Παραγγελίες
                </div>
                <div class="card-body">
                    <table id="myTable" class="cell-border display compact">
                        <thead>
                            <tr>
                                <th>α/α</th>
                                <th>Ημερομηνία</th>
                                <th>Προμηθευτής</th>
                                <th>Έκπτωση</th>
                                <th>Σύνολο</th>
                                <th>Άφιξη</th>
                                
                                <th>Στοιχεία Ελέγχου</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>α/α</th>
                                <th>Ημερομηνία</th>
                                <th>Προμηθευτής</th>
                                <th>Έκπτωση</th>
                                <th>Σύνολο</th>
                                <th>Άφιξη</th>
                                
                                <th>Στοιχεία Ελέγχου</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->order_date->format('d-m-Y') }}</td>
                                <td>{{ $order->supplier->company_name }}</td>
                                <td>{{ $order->discount }}</td>
                                <td>{{ $order->price }}</td>
                                <td>{{ $order->arrival_date }}</td>
                                <td style="width:15%" >
                                    <div class="d-flex justify-content-evenly">
                                        <a href="/edit_order/{{ $order->id }}" class="btn btn-warning flex-fill">
                                            <i class="far fa-edit"></i>Edit</a>
                                            <form action="/edit_order/{{ $order->id }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                                <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                            </form>
                                        


                                    </div>
                                </td>
                            </tr>
                        @empty
                            No orders added in the database.
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
    </div>

    
@endsection