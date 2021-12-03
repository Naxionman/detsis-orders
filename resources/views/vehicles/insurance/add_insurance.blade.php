@extends('template')

@section('title', 'Προσθήκη ασφάλισης - Detsis Orders')

@section('content')
<div class="container">
    <div class="card bg-success bg-opacity-50 shadow-lg border-0 rounded-3 mt-3 ">
        <div class="card-header"><h3 class="text-center font-weight-light my-2 ">Ασφάλιση {{ $vehicle->name}}</h3></div>
            <div class="card-body bg-light">
                <form action="" id="addInsurance" method="POST">
                    <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputInsuranceDate">Ημερομηνία ασφάλισης</label></div>
                        <div class="col-sm-4"><input class="form-control" value="{{ date('Y-m-d') }}" type="date" id="inputDate" name="insurance_date" required="required"></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputExpiryDate">Ημερομηνία λήξης</label></div>
                        <div class="col-sm-4"><input class="form-control" value="{{ date('Y-m-d', strtotime('+1 year')) }}" type="date" id="inputExpiryDate" name="expiry_date" required="required"></div>
                    </div>
                    
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputCompany">Ασφαλιστική εταιρεία</label></div>
                        <div class="col-sm-4"><input class="form-control" type="text" id="inputCompany" name="insurance_company" required="required"></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputAmount">Ποσό (€)</label></div>
                        <div class="col-sm-4"><input class="form-control" type="number" step="0.01" id="inputAmount" name="amount" required="required"></div>
                    </div>
                    @csrf
                </form>
            </div>
            <div class="card-footer text-center py-2">
                <button class="btn btn-danger" type="submit" form="addInsurance">  Αποθήκευση  </button>
            </div>
        </div>
</div>
@endsection