<ul class="navbar-nav ms-auto me-5 mb-2 mb-lg-0">
    <span class="badge p1 fa-stack fa-5x has-badge bg-danger">4</span>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-bell fa-fw "></i></a>
        <ul class="dropdown-menu dropdown-menu-md-end" aria-labelledby="navbarDropdown">
            @foreach ($shortages as $product)
                <li class="dropdown-item"><a href="/orders"></a>
                    Το προϊόν <strong> {{$product->product_name}}</strong>
                    έχει φτάσει χαμηλότερα από το δηλωθέν όριο των {{$product->min_level}} τεμαχιών!
                
                </li>    
            @endforeach
            <li><hr class="dropdown-divider" /></li>

            @foreach ($birthdays as $employee)
                <li>
                    Σήμερα ο/η <strong> {{$employee->surname}} {{ $employee->first_name}}</strong>
                     έχει γενέθλια! Ευχηθείτε του "χρόνια πολλά"!
                </li>    
            @endforeach
        </ul>
    </li>
</ul>