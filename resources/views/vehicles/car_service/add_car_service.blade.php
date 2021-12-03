@extends('template')

@section('title', 'Προσθήκη service/Βλάβης - Detsis Orders')

@section('content')
<div class="container">
    <div class="card bg-warning bg-opacity-75 shadow-lg border-0 rounded-3 mt-3 ">
        <div class="card-header"><h3 class="text-center font-weight-light my-2 ">Service/Βλάβες {{ $vehicle->name}}</h3></div>
            <div class="card-body bg-light">
                <form action="" id="addCarService" method="POST">
                    <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputServiceDate">Ημερομηνία βλάβης/service</label></div>
                        <div class="col-sm-4"><input class="form-control" value="{{ date('Y-m-d') }}" type="date" id="inputServiceDate" name="car_service_date" required="required"></div>
                    </div>
                                        
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputGarage">Συνεργείο</label></div>
                        <div class="col-sm-4"><input class="form-control" type="text" id="inputGarage" name="garage" required="required"></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputDescription">Συνεργείο</label></div>
                        <div class="col-sm-4"><input class="form-control" type="text" id="inputDescription" name="description" required="required"></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputAmount">Ποσό (€)</label></div>
                        <div class="col-sm-4"><input class="form-control" type="number" step="0.01" id="inputAmount" name="amount" required="required"></div>
                    </div>
                    @csrf
                </form>
            </div>
            <div class="card-footer text-center py-2">
                <button class="btn btn-danger shadow-sm" type="submit" form="addCarService">  Αποθήκευση  </button>
                <a href="/vehicles" class="btn btn-info shadow-sm">  Ακύρωση - Επιστροφή </a>
            </div>
        </div>
</div>
@endsection