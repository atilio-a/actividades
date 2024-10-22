<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-purple elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('images/logo.jpg') }}" alt=" Logo" class="brand-image img-circle-32 elevation-1"
            style="max-height:40px;opacity: .8">
        <span class="brand-text font-weight-light">Actividades</span>
    </a>
    <!-- Log on to marco farfan 3888-15568587 for more projects -->

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ auth()->user()->getAvatar() }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->getFullname() }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item has-treeview">
                    <a href="{{ route('home') }}" class="nav-link {{ activeSegment('') }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Panel</p>
                    </a>
                </li>




                <li class="nav-item has-treeview">
                    <a href="{{ route('actions.index') }}" class="nav-link {{ activeSegment('actions') }}">
                        <i class="nav-icon fa fa-qrcode"></i>
                        <p>Actividades</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ route('localidades.index') }}" class="nav-link {{ activeSegment('localidades') }}">
                        <i class="nav-icon fas fa-city"></i>
                        <p>Localidades</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ route('entities.index') }}" class="nav-link {{ activeSegment('entities') }}">
                        <i class="nav-icon fas fa-landmark"></i>
                        <p>Entidades</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ route('teams.index') }}" class="nav-link {{ activeSegment('teams') }}">
                        <i class="nav-icon fas fa-address-book"></i>
                        <p>Personas</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ route('programs.index') }}" class="nav-link {{ activeSegment('program') }}">
                        <i class="nav-icon fas fa-address-book"></i>
                        <p>Programas</p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="{{ route('projects.index') }}" class="nav-link {{ activeSegment('project') }}">
                        <i class="nav-icon fas fa-address-book"></i>
                        <p>Poyectos</p>
                    </a>
                </li>


                @php
                    $fecha = date('Y-m-d');
                    $start_date = date('Y-m-d', strtotime('-5 days', strtotime($fecha)));
                    $end_date = date('Y-m-d', strtotime('+4 days', strtotime($fecha)));
                    //start_date=2024-05-16&end_date=2024-05-20
                    $url = '?start_date=' . $start_date . '&end_date=' . $end_date;
                @endphp

               <!-- <li class="nav-item has-treeview">
                    <a href="{{ route('payments.index') }}" class="nav-link {{ activeSegment('payments') }}">
                        <i class="nav-icon fas fa-file-invoice"></i>
                        <p>Descargas</p>
                    </a>
                </li>-->

                @if (auth()->user()->rol == 'ADMINISTRADOR')
                    <li class="nav-item has-treeview">
                        <a href="{{ route('usuarios.index') }}" class="nav-link {{ activeSegment('usuarios') }}">
                            <i class="nav-icon fa fa-user"></i>
                            <p>Usuarios</p>
                        </a>
                    </li>
                @endif



                <!--<li class="nav-item has-treeview">
                    <a href="{{ route('users.edit', auth()->user()->id) }}"
                        class="nav-link {{ activeSegment('users') }}">
                        <i class="nav-icon fas fa-user-edit"></i>
                        <p>Modificar mis datos</p>
                    </a>

                </li>-->

                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="document.getElementById('logout-form').submit()">
                        <i class="nav-icon fas fa-power-off"></i>
                        <p>Salir del Sistema</p>
                        <form action="{{ route('logout') }}" method="POST" id="logout-form">
                            @csrf
                        </form>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div><!-- Log on to marco farfan 3888-15568587 for more projects -->
    <!-- /.sidebar -->
</aside>
