@extends ('template')

@section('title', $vehicle->name)

@section('content')
<div class="container">
    <div class="card bg-success bg-opacity-25 shadow-lg border-0 rounded-3 mt-3 ">
        <div class="card-header"><h3 class="text-center font-weight-light my-2 ">{{$vehicle->name}}</h3></div>
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
                                        <div class="row"><div class="text-start">{{ $insurance_expiring }}</div></div>
                                        <div class="row"><div class="text-start">{{ $kteo_expiring }}</div></div>
                                        <div class="row"><div class="text-start">{{ $last_service }}</div></div>
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
                                <a href="" class="btn btn-success shadow-sm p-2 w-100">
                                    <i class="fas fa-car-crash fa-4x"></i>
                                    <h6>Ασφάλεια</h6>
                                </a>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col p-2">
                                <button class="btn btn-info shadow-sm p-2 w-100">
                                    <i class="fas fa-clipboard-check fa-4x"></i> 
                                    <h6>ΚΤΕΟ</h6>
                                </button>
                            </div>
                            <div class="col p-2">
                                <button class="btn btn-warning shadow-sm p-2 w-100">
                                    <i class="fas fa-wrench fa-4x"></i>
                                    <h6>Service</h6>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer text-center py-2">
                
            </div>
        </div>

</div>


@endsection