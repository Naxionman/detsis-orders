@extends ('template')

@section('title', $vehicle->name)

@section('content')
<div class="container">
    <div class="card bg-success bg-opacity-25 shadow-lg border-0 rounded-3 mt-3 ">
        <div class="card-header">
            <h3 class="text-center font-weight-light my-2 ">{{$vehicle->name}}
                <a href="/vehicles" class="btn btn-info shadow-sm"> Επιστροφή στον πίνακα οχημάτων</a></h3></div>
            
            <div class="card-body bg-light">
                <div class="row">
                    <div class="col">
                        <div class="card bg-info bg-opacity-10 shadow-sm border-2 rounded-3 m-2">
                            <div class="card-header"><h5>Στοιχεία οχήματος</h5></div>
                            <div class="card-body bg-light">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="row"><div class="text-end">Ονομασία :</div></div>
                                        <div class="row"><div class="text-end">Πινακίδα :</div></div>
                                        <div class="row"><div class="text-end">Τύπος καυσίμου :</div></div>
                                        <div class="row"><div class="text-end">Λήξη ασφάλισης :</div></div>
                                        <div class="row"><div class="text-end">Λήξη ισχύος ΚΤΕΟ :</div></div>
                                        <div class="row"><div class="text-end">Ημέρες από service :</div></div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row"><div class="text-start">{{ $vehicle->name }}</div></div>
                                        <div class="row"><div class="text-start">{{ $vehicle->plate }}</div></div>
                                        <div class="row"><div class="text-start">{{ $vehicle->fuel_type }}</div></div>
                                        <div class="row"><div class="text-start">{{ $insurance == null ?: $insurance->expiry_date->format('d-m-Y') }}</div></div>
                                        <div class="row"><div class="text-start">{{ $kteo == null ?: $kteo->next_kteo_date->format('d-m-Y') }}</div></div>
                                        <div class="row"><div class="text-start">{{ $days }}</div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="row mt-2">
                            <div class="col pe-2 pb-2">
                                <a href="/add_fuel/{{ $vehicle->id }}" class="btn btn-danger shadow-sm p-2 w-100">
                                    <i class="fas fa-gas-pump fa-4x"></i> 
                                    <h6>Ανεφοδιασμός</h6>
                                    
                                </a>
                            </div>
                            <div class="col pe-2 pb-2 ">
                                <a href="/add_insurance/{{ $vehicle->id }}" class="btn btn-success shadow-sm p-2 w-100">
                                    <i class="fas fa-car-crash fa-4x"></i>
                                    <h6>Ασφάλεια</h6>
                                </a>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col p-2">
                                <a href="/add_kteo/{{ $vehicle->id }}" class="btn btn-info shadow-sm p-2 w-100">
                                    <i class="fas fa-clipboard-check fa-4x"></i> 
                                    <h6>ΚΤΕΟ</h6>
                                </a>
                            </div>
                            <div class="col p-2">
                                <a href="/add_car_service/{{ $vehicle->id }}" class="btn btn-warning shadow-sm p-2 w-100">
                                    <i class="fas fa-wrench fa-4x"></i>
                                    <h6>Service</h6>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            

                <div class="row border rounded-3 m-2 p-2">
                    <div class="col-5"> <!-- Left table with Refuelings -->
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                                Πίνακας ανεφοδιασμών
                        </div>
                        <table id="refuelsTable" class="cell-border display compact">
                            <thead>
                                <tr >
                                    <th>Ημερομηνία</th>
                                    <th>Ποσό</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($car_refuelings as $refill)
                                <tr>
                                    <td>{{ $refill->refuel_date->format('d-m-Y') }}</td>
                                    <td>{{ number_format($refill->amount,2,",",".") }} €</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-7">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                                Πίνακας βλαβών-service
                        </div>
                        <table id="servicesTable" class="cell-border display compact">
                            <thead>
                                <tr >
                                    <th>Ημερομηνία</th>
                                    <th>Συνεργείο</th>
                                    <th>Περιγραφή</th>
                                    <th>Ποσό</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($car_services as $service)
                                <tr>
                                    <td>{{ $service->service_date->format("d-m-Y") }}</td>
                                    <td>{{ $service->garage }}</td>
                                    <td>{{ $service->description }}</td>
                                    <td>{{ number_format($service->amount,2,",",".") }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center py-2">
                
            </div>
        </div>

</div>

<script type = "text/javascript">
    $(document).ready( function () {$('#refuelsTable').DataTable({
        columnDefs: [{ 
            type: 'date-eu', targets: [0] }]}  
    );});
</script>
<script type = "text/javascript">
    $(document).ready( function () {
        $('#servicesTable').DataTable({
            columnDefs: [{ 
                type: 'date-eu', targets: [0] }]}  
    );});
</script>
@endsection