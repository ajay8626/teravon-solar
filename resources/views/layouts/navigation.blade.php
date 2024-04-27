<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
            <a href="{{ route('profile.show') }}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('admin.home') }}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        {{ __('Dashboard') }}
                    </p>
                </a>
            </li>

            
            <li class="nav-item">
                <a href="{{ route('admin.categories.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p> {{ __('Category') }} </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    
                    <li class="nav-item">
                        <a href="{{ route('admin.categories.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Category</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.categories.add') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Category</p>
                        </a>
                    </li>
                    
                </ul>
            </li>
            
            <li class="nav-item">
                <a href="{{ route('admin.users.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        {{ __('All User') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.sub-categories.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        {{ __('Sub Category') }}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.durations.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        {{ __('All Durations') }}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.projects.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        {{ __('Project') }}
                    </p>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="{{ route('admin.general-check-points.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        {{ __('Questions') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('about') }}" class="nav-link">
                    <i class="nav-icon far fa-address-card"></i>
                    <p>
                        {{ __('About us') }}
                    </p>
                </a>
            </li>

            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#category" aria-expanded="true" aria-controls="category" style="padding-top: inherit;">
                    <i class="fas fa-fw fa-list-alt"></i>
                    <span>{{ __('All Permission') }}</span></a>
                    <div id="category" class="collapse" aria-labelledby="headingTwo" data-parent="#category">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.all.permission') }}">All Permission</a>
                    </div>
                </div> 
            </li> -->

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-circle nav-icon"></i>
                    <p>
                        All Permission
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="{{ route('admin.all.permission') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Permission</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.all.roles') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Roles</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.add.roles.permission') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Role Permission</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.all.roles.permission') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Role Permission</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->