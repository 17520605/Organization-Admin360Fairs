<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center btn-page-loader" href="{{env('APP_URL')}}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('admin-master/asset/images/S-logo.png')}}" width="40" alt="">
        </div>
        <div class="sidebar-brand-text mx-3" style="margin-top: 4px">Tour Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0" />

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link btn-page-loader" href="{{env('APP_URL')}}">
            <i class="fas fa-align-left"></i>
            <span>List Tours</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider" />

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    {{-- <li class="nav-item">
        <a class="nav-link btn-page-loader">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li> --}}
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed btn-page-loader" href="/administrator/tours/{{$tour->id}}">
            <i class="fas fa-torii-gate"></i><span>Tour</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed"  href="/administrator/tours/{{$tour->id}}/partners" >
            <i class="fas fa-building"></i>
            <span>Partners</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="/administrator/tours/{{$tour->id}}/zones">
            <i class="fas fa-layer-group"></i>
            <span>Zones</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="/administrator/tours/{{$tour->id}}/booths">
            <i class="fas fa-store"></i>
            <span>Booths</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsewebina" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-calendar-week"></i>
            <span>Events</span>
        </a>
        <div id="collapsewebina" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Options</h6>
                <a class="collapse-item btn-page-loader" href="/administrator/tours/{{$tour->id}}/events/webinars/schedule">Schedule</a>
                <a class="collapse-item btn-page-loader" href="/administrator/tours/{{$tour->id}}/events/webinars">Webinars</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="/administrator/tours/{{$tour->id}}/articles">
            <i class="fas fa-newspaper"></i>
            <span>Articles</span>
        </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider" />
    <!-- Heading -->
    <div class="sidebar-heading">
        File
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="/administrator/tours/{{$tour->id}}/assets">
            <i class="fas fa-folder"></i>
            <span>Assets</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed btn-page-loader" href="/administrator/tours/{{$tour->id}}/requests">
            <i class="fas fa-torii-gate"></i><span>Request <span id="navbar-left__request-count" class="badge bg-danger" style="float: right; display: none"></span></span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="/administrator/tours/{{$tour->id}}/notifications" >
            <i class="fas fa-comments"></i>
            <span>Notifications</span>
        </a>
    </li>
    
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block" />

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>