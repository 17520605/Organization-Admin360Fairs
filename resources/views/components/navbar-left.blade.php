<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <i class="fab fa-korvue"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Tour Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0" />

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.html">
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
        <a class="nav-link collapsed" href="#">
            <i class="fas fa-torii-gate"></i>
            <span>Tour</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-building"></i>
            <span>Company</span>
        </a>
        <div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Company:</h6>
                <a class="collapse-item" >Company</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-store"></i>
            <span>Booths</span>
        </a>
        <div id="collapse3" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Booths Manager</h6>
                <a href="/tours/{{$tour->id}}/zones" class="collapse-item" >zones</a>
                <a href="/tours/{{$tour->id}}/booths" class="collapse-item" >Booths</a>
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
                <h6 class="collapse-header">Event types</h6>
                <a class="collapse-item" href="/tours/{{$tour->id}}/events/webinars/1">Webinars</a>
                <a class="collapse-item" href="buttons.html">...</a>
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
                <a href="/tours/{{$tour->id}}/objects/images" class="collapse-item">Images</a>
                <a href="/tours/{{$tour->id}}/objects/videos" class="collapse-item">Videos</a>
                <a href="/tours/{{$tour->id}}/objects/audios" class="collapse-item">Audios</a>
                <a href="/tours/{{$tour->id}}/objects/models" class="collapse-item">3D Model</a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider" />

    <!-- Heading -->
    <div class="sidebar-heading">
        Persons
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#">
            <i class="fas fa-users"></i>
            <span>Viewer</span>
        </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider" />

    <!-- Heading -->
    <div class="sidebar-heading">
        Notifications
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse9" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-envelope-open-text"></i>
            <span>Virtial Mail</span>
        </a>
        <div id="collapse9" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Booths:</h6>
                <a class="collapse-item" href="buttons.html">Inbox</a>
                <a class="collapse-item" href="buttons.html">compose</a>
                <a class="collapse-item" href="buttons.html">Read</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse8" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-comments"></i>
            <span>Notifications</span>
        </a>
        <div id="collapse8" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Notifications:</h6>
                <a class="collapse-item" href="buttons.html">Notifications</a>
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