@extends ('template')

@section('title', 'Καρτέλα'.' '.$shipper->name)

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Kαρτέλα {{ $shipper->name}}</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/">Αρχική σελίδα</a></li>
            <li class="breadcrumb-item"><a href="/shippers">Μεταφορικές</a></li>
            <li class="breadcrumb-item active">Καρτέλα {{ $shipper->name }}</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-4">
                        <i class="fas fa-table me-1"></i>
                        Πίνακας Φορτωτικών έτους <strong>{{ $selected_year }}</strong>
                    </div>
                    <div class="col-8">
                        Επιλέξτε άλλο έτος :
                            @for ($i = $min_year; $i < $max_year+1 ; $i++)
                                <a class="btn btn-sm btn-info" href="/view_shipper/{{ $shipper->id}}/{{$i}}">{{ $i }}</a>
                            @endfor
                        
                    </div>
                </div>
                
            </div>
            <div class="card-body">
                <table id="annualShippingTable" class="cell-border display compact">
                    <thead>
                        <tr>
                            <th>Μήνας</th>
                            <th>Παραδόσεις</th>
                            <th>Χρέωση</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @php
                            $total_count = 0;
                            $total_charges = 0;
                        @endphp
                        @foreach ($shipments_per_year[$selected_year] as $s )
                            <tr>
                                <td>{{ $s["month"] }}</td>
                                <td>{{ $s["count"] }}</td>
                                <td>{{ number_format($s["charges"],2,",",".") }}</td>
                            </tr>
                            @php
                                $total_count += $s["count"];
                                $total_charges += $s["charges"];
                            @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Σύνολα</th>
                            <th>{{ $total_count }}</th>
                            <th>{{ $total_charges }}€</th>
                        </tr>
                    </tfoot>
                </table>
            </div> <!-- card body-->
            <div class="card-footer text-center py-2">
                <a href="javascript:history.back()" class="btn btn-info shadow-sm">  Ακύρωση - Επιστροφή </a>
            </div>
        </div>
    </div>

    <script type = "text/javascript">$(document).ready( function () {
        $('#annualShippingTable').DataTable({
            dom: 'rtip',
            ordering: false,
            paging: false
        });});
    </script>
@endsection
