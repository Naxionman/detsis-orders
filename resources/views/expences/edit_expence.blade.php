@extends('template')

@section('title', 'Επεξεργασία Παγίου')

@section('content')
<div class="container">
    <div class="card bg-warning bg-opacity-25 shadow-lg border-0 rounded-3 mt-3 ">
        <div class="card-header"><h3 class="text-center font-weight-light my-2 ">Επεξεργασία παγίου εξόδου</h3></div>
            <div class="card-body bg-light">
                <form action="/edit_expence/{{ $expence->id }}" id="editExpence" method="POST">
                @method('PATCH')
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputDate">Ημερομηνία</label></div>
                        <div class="col-sm-4"><input class="form-control" value="{{$expence->expence_date->format("Y-m-d") }}" type="date" id="inputDate" name="expence_date" required="required"></div>
                    </div>
                    
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputDescription">Περιγραφή</label></div>
                        <div class="col-sm-4"><input class="form-control" value="{{ $expence->description }}" type="text" id="inputDescription" name="description"></div>
                    </div>    

                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputAmount">Ποσόν</label></div>
                        <div class="col-sm-4"><input class="form-control" value="{{ $expence->amount }}" type="number" step="0.01" id="inputAmount" name="amount"></div>
                    </div>    


                    @csrf
                </form>
            </div>
            <div class="card-footer text-center py-2">
                <button class="btn btn-danger shadow-sm" type="submit" form="editExpence">  Αποθήκευση Αλλαγών </button>
                <a href="/expences" class="btn btn-info shadow-sm">  Ακύρωση - Επιστροφή </a>
            </div>
        </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <audio autoplay src="/sound/beep.mp3"/>
    @endif

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
</div>
@endsection