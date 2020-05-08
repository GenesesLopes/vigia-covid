<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-users-cog"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <span class="dropdown-header">Configurações</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item text-center">
                    Dados da conta
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{route('logout')}}" class="dropdown-item dropdown-footer">
                    Sair
                </a>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->