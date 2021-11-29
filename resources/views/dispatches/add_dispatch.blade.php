@extends('template')

@section('title', 'Νέα κίνηση - Detsis Orders')

@section('content')
<div class="container">
    <div class="card bg-c-blue bg-opacity-25 shadow-lg border-0 rounded-3 mt-3 ">
        <div class="card-header"><h3 class="text-center font-weight-light my-2 ">Προσθήκη νέας κίνησης οχήματος</h3></div>
            <div class="card-body bg-light">
                <form action="add_dispatch" id="addDispatch" method="POST">
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputDispatchDate">Ημερομηνία</label></div>
                        <div class="col-sm-4"><input class="form-control" value="{{ date("2021-11-11")}}" type="date" id="inputDispatchDate" name="dispatch_date"></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputVehicle">Όχημα</label></div>
                        <div class="col-sm-4">
                            <select class="form-control" id="inputVehicle" name="vehicle_id">
                                @forelse ($vehicles as $vehicle)
                                    <option   type="text" value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                                @empty
                                    <option>Δεν υπάρχουν οχήματα στην βάση!</option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <script type="text/javascript">
                        function addInputField(count){
                            var count;
                            count = count +1;
                            var divToPlace = document.getElementById('inputCrew');
                            var fragment = document.createElement('fragment');
                            fragment.id = 'fragment'+count;
                            var oldButton = document.getElementById('addVehicleEmployee');
                            oldButton.parentNode. removeChild(oldButton);
                            fragment.innerHTML = '<select id="fragment'+count+'" class="form-control js-example-basic-single" name="employee'+count+'"> @foreach ($employees as $employee)<option value="{{ $employee->id }}">{{ $employee->surname }} {{ $employee->first_name }}</option> </option> @endforeach</select><button type="button" id="addVehicleEmployee" onclick="addInputField('+count+')" class="btn btn-warning btn-sm m-1"> + Προσθήκη εργαζομένου στο όχημα</button><button class="btn btn-danger btn-sm" onclick="removeInputField('+count+')" type="button">Αφαίρεση</button><input type="hidden" name="count" value="'+count+'">';    
                            document.getElementById('divToPlace').appendChild(fragment);
                            
                        }
                        
                        function removeInputField(count){
                            var fragmentToRemove = document.getElementById('fragment'+count);
                            console.log("$('[id^=addVehicleEmployee]').length is :" + $('[id^=addVehicleEmployee]').length);
                            var oldButton = document.createElement('div');
                            fragmentToRemove.parentNode.removeChild(fragmentToRemove);
                            if($('[id^=addVehicleEmployee]').length < 1){
                                console.log("It is < 1 ...");
                                var oldButton = document.createElement('div');
                                oldButton.innerHTML = '<button type="button" id="addVehicleEmployee" onclick="addInputField('+count+')" class="btn btn-warning btn-sm m-1"> + Προσθήκη εργαζομένου στο όχημα</button>';
                                document.getElementById('divToPlace'). appendChild(oldButton);
                            }
                        }
                    </script>


                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputCrew">Εργαζόμενοι</label></div>
                        <div class="col-sm-4" id="divToPlace">
                            <select class="form-control js-example-basic-single" id="inputCrew" name="employee0">
                                @forelse ($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->surname }} {{ $employee->first_name }}</option>
                                @empty
                                    <option value="">Δεν υπάρχουν εργαζόμενοι στην βάση!</option>
                                @endforelse
                            </select>
                            <button type="button" id="addVehicleEmployee" onclick="addInputField(0)" class="btn btn-warning btn-sm m-1"> + Προσθήκη εργαζομένου στο όχημα</button>
                        </div>
                    </div>
                    
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputClient">Πελάτης</label></div>
                        <div class="col-sm-4"><input class="form-control" type="text" id="inputClient" name="client" placeholder="Πελάτης"></div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-2"><label for="inputAddress">Διεύθυνση</label></div>
                        <div class="col-sm-4"><input class="form-control" type="text" id="inputAddress" name="address" placeholder="Διεύθυνση"></div>
                    </div>
                    
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-10">
                            <label for="inputNotes">Σημειώσεις</label>
                            <input class="form-control" autocomplete="nope" type="text" id="inputNotes" name="notes" placeholder="Σημειώσεις">
                        </div>
                    </div>
                    @csrf
                </form>
            </div>
            <div class="card-footer text-center py-2">
                <button class="btn btn-danger" type="submit" form="addDispatch">  Αποθήκευση  </button>
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