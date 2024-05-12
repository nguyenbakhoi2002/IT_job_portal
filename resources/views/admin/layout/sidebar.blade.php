<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="{{ asset('assets/admin-bower/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">BaKhoi</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                {{-- <img src="{{ Auth::user()->image ? Stogate::url(Auth::user()->image) : asset('assets/admin-bower/dist/img/avatar.png') }}" 
                class="img-circle elevation-2" alt="User Image">
                --}}
            </div>
            <div class="info">
                {{-- <a href="#" class="d-block">Hello, {{ Auth::User()->name }}</a> --}}
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="{{ __('SEARCH') }}"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item ">
                    <a href="{{route('admin.dashboard')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('Tổng quan') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.company.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p> Công ty </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.post.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p> Công viêc </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{route('admin.candidate.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Ứng viên
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{route('admin.skill.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Kỹ năng
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{route('admin.major.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Chuyên ngành
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            yêu cầu
                            <i class="fas fa-angle-right right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.degree.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Bằng cấp</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.time.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Số năm kinh nghiệm</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.language.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ngoại ngữ</p>
                            </a>
                        </li>
                    </ul>
                  </li>
                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Gói nạp
                            <i class="fas fa-angle-right right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ứng viên</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Công ty</p>
                            </a>
                        </li>
                    </ul>
                  </li> --}}
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="fas fa-users nav-icon"></i>
                        <p>Người dùng</p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-shield"></i>
                        <p>
                            Quản lý ACL
                            <i class="fas fa-angle-right right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Vai trò</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Quyền</p>
                            </a>
                        </li>
                    </ul>
                  </li> --}}
                  <li class="nav-item ">
                    <a href="{{route('admin.logout')}}" class="nav-link">
                        <i class="fa fa-sign-out-alt"></i>
                        <p>
                            Đăng xuất
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
