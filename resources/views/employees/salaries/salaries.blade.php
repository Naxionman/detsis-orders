@extends('template')

@section('title', 'Μισθοδοσία - Detsis Orders')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Μισθοδοσία</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/">Αρχική σελίδα</a></li>
                <li class="breadcrumb-item"><a href="/employees">Εργαζόμενοι</a></li>
                <li class="breadcrumb-item active">Μισθοδοσία</li>
            </ol>
            <div class="card mb-4">
                <a href="/add_salary" class="btn btn-info" >Προσθήκη Μισθοδοσίας</a>    
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-4"> 
                            @php
                                $current_year = Date("Y");
                            @endphp
                            <i class="fas fa-table me-1"></i>
                            Πίνακας Μισθοδοσίας Eργαζομένων <b>{{ $current_year }}</b>
                        </div>
                        <div class="col-8">
                            @if ($min_year < $current_year)
                                Πίνακες προηγούμενων ετών    
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @php
                        $months = ['Ιανουάριος', 'Φεβρουάριος','Μάρτιος','Απρίλιος','Δώρο Πάσχα','Μάιος','Ιούνιος','Ιούλιος','Αύγουστος', 'Σεπτέμβριος', 'Οκτώβριος', 'Νοέμβριος','Δεκέμβριος','Δώρο Χρστουγέννων'];
                        $aa = 0;
                    @endphp
                    
                    @foreach ($months as $month)
                        @php
                            $aa++;
                        @endphp
                        <div class="accordion" id="acc-{{$aa}}">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{$aa}}" aria-expanded="true" aria-controls="collapseOne">
                                        {{ $month }}
                                    </button>
                                </h2>
                                <div id="collapse-{{$aa}}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#acc-{{$aa}}">
                                    <div class="accordion-body">
                                        <table id="salariesTable{{$aa}}" class="cell-border display compact">
                                            <thead>
                                                <tr>
                                                    <th>Εργαζόμενος</th>
                                                    <th>Οικ.Κατ.</th>
                                                    <th>Τέκνα</th>
                                                    <th>Τριετία</th>
                                                    <th>Επ.Γάμου</th>
                                                    <th>Πληρωτέο (€)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $sum = 0;
                                                @endphp
                                                @foreach ($salaries as $salary)
                                                    @if ($salary->salary_month == $month && $salary->salary_year == $current_year)
                                                        <tr>
                                                            <td>{{ $salary->employee->surname }} {{$salary->employee->first_name}}</td>
                                                            <td>{{ $salary->employee->marital_status }}</td>
                                                            <td>{{ $salary->employee->children }}</td>
                                                            <td>@if ($salary->three_year_benefit > 0)
                                                                    <i class="fas fa-check"></i>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ( $salary->employee->marital_status == 'Έγγαμος' || $salary->employee->marital_status == 'Διαζευγμένος' || $salary->employee->marital_status == 'Χήρος')
                                                                    @if ($salary->marriage_benefit > 0)
                                                                    <i class="fas fa-check"></i>
                                                                    @else        
                                                                    <i class="fas fa-times"></i>
                                                                    @endif
                                                                @endif
                                                            </td>
                                                            <td>{{ number_format($salary->net_salary,2,",",".") }}</td>
                                                        </tr>
                                                        @php
                                                            $sum += $salary->net_salary;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <script type = "text/javascript">
                                            $(document).ready( function () {$('#salariesTable{{$aa}}').DataTable(
                                                {dom: 'rtip',
                                                info :false,
                                                paging: false}
                                                
                                            )});
                                        </script>                                        
                                        Σύνολο μισθοδοσίας :<b> {{number_format($sum,2 ,",",".") }} € </b>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
            {!! Toastr::message() !!}
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"type="text/javascript"></script>
    <script type="text/javascript" src="https:////cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.11/sorting/date-eu.js"></script>

    
@endsection