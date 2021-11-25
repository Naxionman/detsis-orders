<!DOCTYPE html>
<html>
    <head>
        <link href="\css\styles.css" rel="stylesheet" />
        
        <link rel="stylesheet" type="text/css" href="https:////cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"/>
        <style>
            body {
                height: 842px;
                width: 595px;
                /* to centre page on screen*/
                margin-left: auto;
                margin-right: auto;
            }
        </style>
    </head>
    <body class="border rounded-3">
        <div class="card">
            <div class="card-header">
                <h3>Δελτίο απόσπασης οχήματος ____/____/ {{date('Y')}}</h3>
            </div>

            <div class="card-body">
                <div class="row m-2 justify-content-evenly">
                    @foreach ($vehicles as $vehicle)
                        <div class="col-3">
                            <h5> {{ $vehicle->name }} </h5> 
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <h2>Ομάδα </h2>
                    @foreach ($employees as $employee)
                        <div class="border rounded-5">
                            <h5>{{ $employee->surname}} {{ $employee->first_name}}</h5>    
                        </div>    
                    @endforeach
                </div>
                <div class="row">
                    <div class="col">
                        <h2>Πελάτης</h2>
                        <br>
                        <br>
                        <br>
                    </div>
                    <div class="col">
                        <h2>Διεύθυνση</h2>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>