<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="Naxionman" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>
        
        <!-- CSS stylesheets -->
        <link href="\css\styles.css" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"/>        
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"> 
        <!-- CDN to jquery -->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        
        <!--  CDN to toastr -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    </head>
   
    <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
    <!-- CDN to Chart.js -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>     
    
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="/">DetsisOrders</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Payments button -->
            <a class="btn btn-dark ms-5" style="background-color :rgb(34, 56, 56)" href="/payments">Πληρωμές <i class="fas fa-landmark"></i></a>
            
            <!-- Navbar SiteMap-->
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark ms-5">
                <div class="container-fluid ">
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                    <ul class="navbar-nav">
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Γρήγορη Μετάβαση
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                          <li><a class="dropdown-item" href="/orders">Παραγγελίες</a></li>
                          <li><a class="dropdown-item" href="/suppliers">Προμηθευτές</a></li>
                          <li><a class="dropdown-item" href="/shippers">Μεταφορικές</a></li>
                          <li><a class="dropdown-item" href="/clients">Πελάτες</a></li>
                          <li><a class="dropdown-item" href="/expences">Πάγια έξοδα</a></li>
                          <li><a class="dropdown-item" href="/employees">Εργαζόμενοι</a></li>
                          <li><a class="dropdown-item" href="/vehicles">Οχήματα</a></li>
                          <li class="dropdown-header">Συνχές ενέργειες</li>
                          <li><a class="dropdown-item" href="/add_client">Νέος Πελάτης</a></li>
                          <li><a class="dropdown-item" href="/add_supplier">Νέος Προμηθευτής</a></li>
                          <li><a class="dropdown-item" href="/add_special_invoice">Νέο Τιμολόγιο</a></li>
                          <li><a class="dropdown-item" href="view_shipper/2/2022">Καρτέλα Διονύσου</a></li>
                        </ul>
                      </li>
                    </ul>
                  </div>
                </div>
              </nav>
            
            <!-- Warehouse button -->
            <a class="btn btn-dark ms-5" style="background-color :rgb(34, 56, 56)" href="/warehouse">Αποθήκη <i class="fas fa-warehouse"></i></a>
            <!-- Notification bell -->
            @include('notifications', compact('shortages'))

            <!-- Navbar-->
            <ul class="navbar-nav ms-5 me-5">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Logout</a></li>
                    </ul>
                </li>
            </ul>

        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Πίνακας Ελέγχου</div>
                            <a class="nav-link" href="/">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Αρχική σελίδα
                            </a>
                            <a class="nav-link" href="/orders">
                                <div class="sb-nav-link-icon"><i class="fas fa-money-check"></i></div>
                                Παραγγελίες
                            </a>
                            <a class="nav-link" href="/invoices">
                                <div class="sb-nav-link-icon"><i class="fas fa-file-invoice"></i></div>
                                Τιμολόγια
                            </a>
                            <a class="nav-link" href="/suppliers">
                                <div class="sb-nav-link-icon"><i class="fas fa-industry"></i></div>
                                Προμηθευτές
                            </a>
                            <a class="nav-link collapsed" href="#"  data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-edit"></i></div>Διαχείριση
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/products">
                                        <div class="sb-nav-link-icon"><i class="fas fa-box-open"></i></div>
                                        Προϊόντα
                                    </a>
                                    <a class="nav-link" href="/shipments">
                                        <div class="sb-nav-link-icon"><i class="fas fa-car"></i></div>
                                        Φορτωτικές
                                    </a>
                                    <a class="nav-link" href="/dispatches">
                                        <div class="sb-nav-link-icon"><i class="fas fa-car"></i></div>
                                        Κινήσεις
                                    </a>                                    
                                    <a class="nav-link" href="/clients">
                                        <div class="sb-nav-link-icon"><i class="fas fa-user-friends"></i></div>
                                        Πελάτες
                                    </a>
                                    <a class="nav-link" href="/employees">
                                        <div class="sb-nav-link-icon"><i class="fas fa-address-card"></i></div>
                                        Εργαζόμενοι
                                    </a>
                                    <a class="nav-link" href="/shippers">
                                        <div class="sb-nav-link-icon"><i class="fas fa-shipping-fast"></i></div>
                                        Μεταφορικές
                                    </a>
                                    <a class="nav-link" href="/vehicles">
                                        <div class="sb-nav-link-icon"><i class="fas fa-car"></i></div>
                                        Οχήματα
                                    </a>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Naxionman
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    @yield('content')
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">made by Naxionman in 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    
        <script>
            // Toast notifications for everything. Customization inside the controllers.
            @if(Session::has('message'))
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                toastr.success("{{ session('message') }}");
            @endif
                
            @if(Session::has('error'))
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                    }
                toastr.error("{{ session('error') }}");
            @endif
                
            @if(Session::has('info'))
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                    }
                toastr.info("{{ session('info') }}");
            @endif
                
            @if(Session::has('warning'))
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                    }
                toastr.warning("{{ session('warning') }}");
            @endif
        </script>
    </body>
    <!--  CDN to font-awesome -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    
    <!--  CDN to datables -->        
    <script type="text/javascript" src="https:////cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.11/sorting/date-eu.js"></script>
    <script type="text/javascript" src="/js/dataTables.dateFormat.js"></script>

    
    <!-- CDN to Sweet Alert -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.all.min.js"></script>
    <!-- CDN to printThis-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js" integrity="sha512-d5Jr3NflEZmFDdFHZtxeJtBzk0eB+kkRXWFQqEc1EKmolXjHm2IKCA7kTvXBNjIYzjXfD5XzIjaaErpkZHCkBg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="/js/scripts.js"></script>
    <!--  CDN to select2 -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script> 
</html>
