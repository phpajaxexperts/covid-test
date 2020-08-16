<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>       
    </ul>

    <!-- SEARCH FORM -->
    

    <!-- Right navbar links -->

    <ul class="navbar-nav ml-auto">       
        

        <li  class="nav-item"><a class="nav-link" href="{{ url('/clinic/logout') }}">Logout</a></li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        
        <span class="brand-text font-weight-light">Clinic Portal</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            
            <div class="info">
                <a href="#" class="d-block">
                    @if(isset(Auth::guard('clinic')->getUser()->name))
                    {{Auth::guard('clinic')->getUser()->name}}
                    @endif
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview menu-open">
                   
                    <ul class="nav nav-treeview">
                        @php( $action_name = getActionName() )
                        <li class="nav-item">
                            <a href="{{ url('clinic/dashboard')  }}" class="nav-link  @if($action_name=='' || $action_name=='dashboard') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('clinic/patients')  }}" class="nav-link @if($action_name=='patients') active @endif ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Patients</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('clinic/reports')  }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Report</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>