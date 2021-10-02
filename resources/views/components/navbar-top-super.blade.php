<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow" style="background-color: #4e73df !important;">
    <div class="d-flex flex-column text-sm-left text-center justify-content-center" style="color: #fff;">
        <a href="#" class="navbar-brand mr-0 mr-md-3 active"><i class="fab fa-korvue" style="color: #fff;font-size: 35px;margin-right: 5px;"></i> <span style="font-size: 35px; font-weight: bold; margin-right: 30px;color: #fff;">VIRTUAL ADMIN</span> </a>
    </div>
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a href="/tours" class="nav-link" data-widget="fullscreen" href="#" role="button" style="color: #fff;font-weight:600;padding:0 1.5rem">
             <i class="fas fa-torii-gate" style="margin-right: 8px"></i>  Tours
            </a>
        </li>
        <li class="nav-item">
            <a href="/profile" class="nav-link" data-widget="fullscreen" href="#" role="button" style="color: #fff;font-weight:600;padding:0 1.5rem">
              <i class="fas fa-align-right" style="margin-right: 8px"></i>  Profile
            </a>
        </li>
        <div class="topbar-divider d-none d-sm-block"></div>
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline" style="font-size:0.9rem; color: #fff;">Khai nguyễn Hữu Minh</span>
                <img class="img-profile rounded-circle" src="{{ asset('admin-master/asset/images/undraw_profile_3.svg')}}" />
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#"> <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Profile </a>
                <a class="dropdown-item" href="#"> <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i> Settings </a>
                <a class="dropdown-item" href="#"> <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i> Activity Log </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"> <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout </a>
            </div>
        </li>
    </ul>
</nav>