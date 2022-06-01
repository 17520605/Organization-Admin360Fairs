<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center btn-page-loader" href="/partner/booths/{{$booth->id}}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('admin-master/asset/images/S-logo.png')}}" width="40" alt="">
        </div>
        <div class="sidebar-brand-text mx-3">Booth Manager</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider" />

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed btn-page-loader" href="/partner/booths/{{$booth->id}}">
            <i class="fas fa-store"></i>
            <span>Booth</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsewebina" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-calendar-week"></i>
            <span>Webinars</span>
        </a>
        <div id="collapsewebina" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Options</h6>
                <a class="collapse-item btn-page-loader" href="/partner/booths/{{$booth->id}}/events/webinars/schedule">Schedule</a>
                <a class="collapse-item btn-page-loader" href="/partner/booths/{{$booth->id}}/events/webinars">Webinars</a>
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
            <span>Objects</span>
        </a>
        <div id="collapseresource" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header"> Types </h6>
                <a class="collapse-item btn-page-loader" href="/partner/booths/{{$booth->id}}/assets" >Assets</a>
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
                <h6 class="collapse-header">Notifications:</h6>
                <a class="collapse-item btn-page-loader" href="/partner/booths/{{$booth->id}}/notifications" >Notifications</a>
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