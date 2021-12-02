@extends('template')

@section('title', 'Ανεφοδιασμοί - Detsis Orders')

@section('content')
<div class="container">
    <div class="card bg-success bg-opacity-25 shadow-lg border-0 rounded-3 mt-3 ">
        <div class="card-header"><h3 class="text-center font-weight-light my-2 ">Εγγραφή οχήματος</h3></div>
            <div class="card-body bg-light">
                <form action="add_vehicle" id="addVehicle" method="POST">
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputName">Ονομασία οχήματος</label></div>
                        <div class="col-sm-4"><input class="form-control" autocomplete="nope" type="text" id="inputName" name="name" placeholder="Το όνομα του οχήματος"  required="required" autofocus></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputPlate">Πινακίδα οχήματος</label></div>
                        <div class="col-sm-4"><input class="form-control" autocomplete="nope" type="text" id="inputPlate" name="plate" placeholder="Η πινακίδα οχήματος"  required="required"></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputFuelType">Είδος καυσίμου</label></div>
                        <div class="col-sm-4">
                            <select class="form-control" autocomplete="nope" type="text" id="inputFuelType" name="fuel_type" >
                                <option value="Πετρέλαιο (Diesel)">Πετρέλαιο (Diesel)</option>
                                <option value="Βενζίνη (Αμόλυβδη)">Βενζίνη (Αμόλυβδη)</option>
                                <option value="Υγραέριο LPG">Υγραέριο LPG</option>
                                <option value="φυσικό αέριο">Φυσικό αέριο</option>
                                <option value="Ηλεκτρικό">Ηλεκτρικό</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputNotes">Σημειώσεις</label></div>
                        <div class="col-sm-4"><input class="form-control" autocomplete="nope" type="text" id="inputNotes" name="notes" placeholder="Εδώ σημειώστε επιπλέον πληροφορίες για το όχημα"></div>
                    </div>
                    @csrf
                </form>
            </div>
            <div class="card-footer text-center py-2">
                <button class="btn btn-danger" type="submit" form="addVehicle">  Αποθήκευση  </button>
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