<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@600&display=swap" rel="stylesheet">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link href="\css\styles.css" rel="stylesheet" />
        <title>Εκτύπωση Δελτίου</title>
        <link rel="stylesheet" type="text/css" href="https:////cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"/>
        <style>
            body {
                width: 210mm;
                min-height: 297mm;
                font-family: 'JetBrains Mono', monospace;
            }
        </style>
    </head>
    <body class="border rounded-3 p-5">
        <br>
        <br>
        <div class="row">
            <div class="col-2">
                <img src="/images/logo-white.jpg" alt="logo-white" width="100" height="100">
            </div>
            <div class="col-10 d-flex align-items-center justify-content-center">
                <h2>Δελτίο Aπόσπασης Oχήματος</h2>
            </div>
        </div>
        

        
        <div class="card">
            <div class="card-header text-center">
                <br>
                <h5>Ημερομηνία : ______/______/ {{date('Y')}}</h5>
                <br>
            </div>
            <br>
            <div class="card-body">
                <div class="row m-2 justify-content-evenly">
                    @foreach ($vehicles as $vehicle)
                        <div class="col-3">
                            <h5> {{ $vehicle->name }} </h5> 
                        </div>
                    @endforeach
                </div>
                <br>
                <br>
                <div class="row">
                    <h4>Ομάδα </h4>
                    @foreach ($employees as $employee)
                        <div class="col-1 border rounded-circle">
                                    
                        </div>
                        <div class="col-11 border rounded-5">
                            <h6>{{ $employee->surname}} {{ $employee->first_name}}</h6>    
                        </div>    
                    @endforeach
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col">
                        <h4>Πελάτης</h4>
                        <div class=" border-bottom m-5"></div>
                        <div class=" border-bottom m-5"></div>
                        <div class=" border-bottom m-5"></div>
                        
                        
                    </div>
                    <div class="col">
                        <h4>Διεύθυνση</h4>
                        <div class=" border-bottom m-5"></div>
                        <div class=" border-bottom m-5"></div>
                        <div class=" border-bottom m-5"></div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>