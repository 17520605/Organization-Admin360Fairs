<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center btn-page-loader" href="/administrator/tours/{{$tour->id}}">
        <div class="sidebar-brand-icon">
            <i class="fab fa-korvue"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Tour Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0" />

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link btn-page-loader" href="/administrator/tours/{{$tour->id}}/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider" />

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed btn-page-loader" href="/administrator/tours/{{$tour->id}}">
            <i class="fas fa-torii-gate"></i><span>Tour</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed"  href="#" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-building"></i>
            <span>Partners</span>
        </a>
        <div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Partners:</h6>
                <a class="collapse-item btn-page-loader" href="/administrator/tours/{{$tour->id}}/partners">Partners</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-layer-group"></i>
            <span>Zones</span>
        </a>
        <div id="collapse3" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Zones Manager </h6>
                <a class="collapse-item btn-page-loader" href="/administrator/tours/{{$tour->id}}/zones">Zones</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse3-1" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-store"></i>
            <span>Booths</span>
        </a>
        <div id="collapse3-1" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Booths Manager</h6>
                <a class="collapse-item btn-page-loader" href="/administrator/tours/{{$tour->id}}/booths">Booths</a>
            </div>
        </div>
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
    <!-- Divider -->
    <hr class="sidebar-divider" />
    <!-- Heading -->
    <div class="sidebar-heading">
        File
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseresource" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-folder"></i>
            <span>Assets</span>
        </a>
        <div id="collapseresource" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header"> Options </h6>
                <a class="collapse-item btn-page-loader" href="/administrator/tours/{{$tour->id}}/assets" >Assets</a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider" />
    <!-- Heading -->
    <div class="sidebar-heading">
        Notifications
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed btn-page-loader" href="/administrator/tours/{{$tour->id}}/requests">
            <i class="fas fa-torii-gate"></i><span>Request <span id="navbar-left__request-count" class="badge bg-danger" style="float: right; display: none"></span></span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse8" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-comments"></i>
            <span>Notifications</span>
        </a>
        <div id="collapse8" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Notifications:</h6>
                <a class="collapse-item btn-page-loader"  href="/administrator/tours/{{$tour->id}}/notifications">Notifications</a>
            </div>
        </div>
    </li>
    
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block" />

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>