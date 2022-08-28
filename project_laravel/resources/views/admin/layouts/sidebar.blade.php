<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('dashboard')}}" class="brand-link">
        <img src="{{asset('admin_files/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route('dashboard')}}" class="nav-link">
                       <!--     <i class="nav-icon fas fa-tachometer-alt"></i> -->
                        <p>Dashboard</p>
                    </a>
                </li>

                @can('role.view', Auth::user())
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Roles
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('role.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Roles</p>
                                </a>
                            </li>
                            @can('role.create', Auth::user())
                                <li class="nav-item">
                                    <a href="{{route('role.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create Role</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('permission.view', Auth::user())
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Permissions
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('permission.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Permissions</p>
                                </a>
                            </li>
                            @can('permission.create', Auth::user())
                                <li class="nav-item">
                                    <a href="{{route('permission.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create Permission</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('user.view', Auth::user())
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Users
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('user.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Users</p>
                                </a>
                            </li>
                            @can('user.view', Auth::user())
                                <li class="nav-item">
                                    <a href="{{route('user.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create User</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('category.view', Auth::user())
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Categories
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('category.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Categories</p>
                                </a>
                            </li>
                            @can('category.create', Auth::user())
                                <li class="nav-item">
                                    <a href="{{route('category.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create Category</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('post.view', Auth::user())
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Posts
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('post.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Posts</p>
                                </a>
                            </li>
                            @can('post.create', Auth::user())
                                <li class="nav-item">
                                    <a href="{{route('post.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create Post</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('comment.view', Auth::user())
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Comments
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('comment.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Comments</p>
                                </a>
                            </li>
                            @can('comment.create', Auth::user())
                                <li class="nav-item">
                                    <a href="{{route('comment.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create Comment</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
