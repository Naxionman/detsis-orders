@extends('template')

@section('title', 'Προσθήκη παγίου - Detsis Orders')

@section('content')
<div class="container">
    <div class="card bg-success bg-opacity-75 shadow-lg border-0 rounded-3 mt-3 ">
        <div class="card-header"><h3 class="text-center font-weight-light my-2 ">Προσθήκη παγίου</h3></div>
            <div class="card-body bg-light">
                <form action="#" id="addExpence" method="POST">
                    
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputDate">Ημερομηνία πληρωμής</label></div>
                        <div class="col-sm-4"><input class="form-control" value="{{ date('Y-m-d') }}" type="date" id="inputDate" name="expence_date" required="required"></div>
                    </div>
                    
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputDescription">Περιγραφή</label></div>
                        <div class="col-sm-4"><input class="form-control" type="text" step="0.01" id="inputDescription" name="description"></div>
                    </div>

                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputAmount">Ποσό (€)</label></div>
                        <div class="col-sm-4"><input class="form-control" type="number" step="0.01" id="inputAmount" name="amount"></div>
                    </div>
                    @csrf
                </form>
            </div>
            <div class="card-footer text-center py-2">
                <button class="btn btn-danger" type="submit" form="addExpence">  Αποθήκευση  </button>
                <a href="/expences" class="btn btn-info shadow-sm">  Ακύρωση - Επιστροφή </a>
            </div>
        </div>
</div>
@endsection