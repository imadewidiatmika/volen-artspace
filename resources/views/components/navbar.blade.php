<!-- Navbar Start -->
<div class="container-fluid bg-dark sticky-top">
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-dark navbar-light py-2 py-lg-0">
            <a href="{{ route('index') }}" class="navbar-brand">
                <img class="img-fluid" src="img/vln_logo.png" alt="Logo">
            </a>
            <button type="button" class="navbar-toggler ms-auto me-0 bg-dark" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon "></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto">
                    <a href="{{ route('index') }}" class="nav-item nav-link {{ Request::is('/') ? 'active' : '' }} ">Home</a>
                    <a href="{{ route('about') }}"class="nav-item nav-link {{ Request::is('about') ? 'active' : '' }}">About</a>
                    <a href="{{ route('installation') }}"class="nav-item nav-link {{ Request::is('installation') ? 'active' : '' }}">Installation</a>
                    <a href="{{ route('activities') }}"class="nav-item nav-link {{ Request::is('activities') ? 'active' : '' }}">Activities</a>
                    <a href="{{ route('goods') }}"class="nav-item nav-link {{ Request::is('goods') ? 'active' : '' }}">Goods</a>
                    <a href="{{ route('contact') }}"class="nav-item nav-link {{ Request::is('contact') ? 'active' : '' }}">Contact</a>
                    <a href="{{ route('registration') }}"class="nav-item nav-link {{ Request::is('registration') ? 'active' : '' }}">Registration</a>
                </div>
                <div class="border-start ps-4 d-none d-lg-block">
                    <a href="https://api.whatsapp.com/send?phone=+62895341115908&text=Hi!%20I am%20Really%20Excited%20With%20Volen Artspace%20.%20Do you have time to contact me please?" class="btn btn-lg  p-0 text-white px-1"> <i class="icn bi bi-whatsapp"></i> 
                    </a>
                    {{-- <a href="https://api.whatsapp.com/send?phone=0895341115908&text=Hi!%20I am%20Really%20Excited%20With%20Volen Artspace%20.%20Do you have time to contact me please?" class="btn btn-lg p-0 text-white px-1"> <i class="icn bi bi-instagram"></i> 
                    </a>
                    <a href="https://api.whatsapp.com/send?phone=0895341115908&text=Hi!%20I am%20Really%20Excited%20With%20Volen Artspace%20.%20Do you have time to contact me please?" class="btn btn-lg p-0 text-white px-1"> <i class="icn bi bi-youtube"></i> 
                    </a> --}}
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->