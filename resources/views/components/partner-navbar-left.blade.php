<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center btn-page-loader" href="/partner/tours/{{$tour->id}}">
        <div class="sidebar-brand-icon">
            <i class="fab fa-korvue"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Partner AD</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0" />

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link btn-page-loader" href="/partner/tours/{{$tour->id}}/dashboard">
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
    <li class="nav-item">
        <a class="nav-link collapsed btn-page-loader" href="/partner/tours/{{$tour->id}}/booths">
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
                <h6 class="collapse-header">Event types</h6>
                <a class="collapse-item btn-page-loader" href="/partner/tours/{{$tour->id}}/events/webinars">Webinars</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsespeakers" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-user-check"></i>
            <span>Speakers</span>
        </a>
        <div id="collapsespeakers" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Speakers</h6>
                <a class="collapse-item btn-page-loader" href="/partner/tours/{{$tour->id}}/speakers/">Speakers</a>
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
            <span>Objects Manager</span>
        </a>
        <div id="collapseresource" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header"> Types </h6>
                <a class="collapse-item btn-page-loader" href="/partner/tours/{{$tour->id}}/objects/dashboard">Dashboard</a>
                <a class="collapse-item btn-page-loader" href="/partner/tours/{{$tour->id}}/objects" >Objects</a>
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
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse8" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-comments"></i>
            <span>Notifications</span>
        </a>
        <div id="collapse8" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Notifications:</h6>
                <a class="collapse-item btn-page-loader" href="buttons.html">Notifications</a>
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