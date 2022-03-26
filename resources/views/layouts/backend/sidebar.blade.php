<!--
 * @Author: Agung Martono
 * @Github: https://github.com/agungmartono
 * @Email: agungmartonolabs@gmail.com
-->
<!--
 * @Author: Agung Martono
 * @Github: https://github.com/agungmartono
 * @Email: agungmartonolabs@gmail.com
-->
<!--
 * @Author: Agung Martono
 * @Github: https://github.com/agungmartono
 * @Email: agungmartonolabs@gmail.com
-->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('backend/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ ucfirst(Auth::user()->name) }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('rooms.index') }}" class="nav-link {{ request()->routeIs('rooms*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-hospital-alt"></i>
                        <p>Ruangan</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('doctors.index') }}" class="nav-link {{ request()->routeIs('doctors*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-md"></i>
                        <p>Dokter</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('patients.index') }}" class="nav-link {{ request()->routeIs('patients*', 'registration_patients.create') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cash-register"></i>
                        <p>Pendaftaran Pasien</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('registration_patients.index') }}" class="nav-link {{ request()->routeIs('registration_patients.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-list"></i>
                        <p>Daftar Registrasi Pasien</p>
                    </a>
                </li>
                
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>