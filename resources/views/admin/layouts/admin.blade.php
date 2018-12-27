@include('admin.layouts.header')
<div class="wrapper">
    <div class="sidebar" data-active-color="red" data-background-color="black" data-image="{{ asset('/public/admin/assets/img/sidebar-1.jpg') }}">
        <!--
    Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
    Tip 2: you can also add an image using data-image tag
    Tip 3: you can change the color of the sidebar with data-background-color="white | black"
-->
        <div class="logo">
            <a href="/" class="simple-text">
                HocTiengAnh
            </a>
        </div>
        <div class="logo logo-mini">
            <a href="/" class="simple-text">
                HTA
            </a>
        </div>
        <div class="sidebar-wrapper">
            <div class="user">
                {{--<div class="photo">--}}
                    {{--<img src="{{ asset('/public/admin/assets/img/faces/marc.jpg') }}" />--}}
                {{--</div>--}}
                <div class="info">

                    <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                        <span style="padding-left: 15px;">{{ Auth::user()->username }}</span>
                        <b class="caret" style="margin-top: 10px;position: absolute;right: 32px;"></b>
                    </a>
                    <div class="collapse" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#">My Profile</a>
                            </li>
                            <li>
                                <a href="{{ route('route_admin_user_get_edit',['id'=>Auth::id()]) }}">Edit Profile</a>
                            </li>
                            <li>
                                {{--<a class="dropdown-item" href="{{ route('logout') }}">--}}
                                    {{--{{ __('Logout') }}--}}
                                {{--</a>--}}
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav">
                <li class="active">
                    <a href="#">
                        <i class="material-icons">dashboard</i>
                        <p>Dashboard</p>
                    </a>
                </li>
                {{--<li>--}}
                    {{--<a data-toggle="collapse" href="#roles">--}}
                        {{--<i class="material-icons">apps</i>--}}
                        {{--<p>Roles--}}
                            {{--<b class="caret"></b>--}}
                        {{--</p>--}}
                    {{--</a>--}}
                    {{--<div class="collapse" id="roles">--}}
                        {{--<ul class="nav">--}}
                            {{--<li>--}}
                                {{--<a href="{{ route('route_admin_role_list') }}">List Roles</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a href="{{ route('route_admin_role_get_add') }}">Add Role</a>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a data-toggle="collapse" href="#permission">--}}
                        {{--<i class="material-icons">apps</i>--}}
                        {{--<p>Permission--}}
                            {{--<b class="caret"></b>--}}
                        {{--</p>--}}
                    {{--</a>--}}
                    {{--<div class="collapse" id="permission">--}}
                        {{--<ul class="nav">--}}
                            {{--<li>--}}
                                {{--<a href="{{ route('route_admin_permission_list') }}">List Permisson</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a href="{{ route('route_admin_permission_get_add') }}">Add Permisson</a>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a data-toggle="collapse" href="#user">--}}
                        {{--<i class="material-icons">apps</i>--}}
                        {{--<p>User--}}
                            {{--<b class="caret"></b>--}}
                        {{--</p>--}}
                    {{--</a>--}}
                    {{--<div class="collapse" id="user">--}}
                        {{--<ul class="nav">--}}
                            {{--<li>--}}
                                {{--<a href="{{ route('route_admin_user_list') }}">List User</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a href="{{ route('route_admin_user_get_add') }}">Add User</a>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a href="calendar.html">--}}
                        {{--<i class="material-icons">date_range</i>--}}
                        {{--<p>Calendar</p>--}}
                    {{--</a>--}}
                {{--</li>--}}
                @foreach($main_menu as $value)
                    {!! $value !!}
                    @endforeach
            </ul>
        </div>
    </div>
    <div class="main-panel">
        <nav class="navbar navbar-transparent navbar-absolute">
            <div class="container-fluid">
                <div class="navbar-minimize">
                    <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">
                        <i class="material-icons visible-on-sidebar-regular">more_vert</i>
                        <i class="material-icons visible-on-sidebar-mini">view_list</i>
                    </button>
                </div>
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"> Dashboard </a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="material-icons">dashboard</i>
                                <p class="hidden-lg hidden-md">Dashboard</p>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="material-icons">notifications</i>
                                <span class="notification">5</span>
                                <p class="hidden-lg hidden-md">
                                    Notifications
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="#">Mike John responded to your email</a>
                                </li>
                                <li>
                                    <a href="#">You have 5 new tasks</a>
                                </li>
                                <li>
                                    <a href="#">You're now friend with Andrew</a>
                                </li>
                                <li>
                                    <a href="#">Another Notification</a>
                                </li>
                                <li>
                                    <a href="#">Another One</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="material-icons">person</i>
                                <p class="hidden-lg hidden-md">Profile</p>
                            </a>
                        </li>
                        <li class="separator hidden-lg hidden-md"></li>
                    </ul>
                    <form class="navbar-form navbar-right" role="search">
                        <div class="form-group form-search is-empty">
                            <input type="text" class="form-control" placeholder="Search">
                            <span class="material-input"></span>
                        </div>
                        <button type="submit" class="btn btn-white btn-round btn-just-icon">
                            <i class="material-icons">search</i>
                            <div class="ripple-container"></div>
                        </button>
                    </form>
                </div>
            </div>
        </nav>
        <div class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    <!-- /#wrapper -->
        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Company
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Portfolio
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Blog
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                    <a href="http://mocchauit.com/">Pham Phuong</a>, made with love for a better web
                </p>
            </div>
        </footer>
    </div>
</div>
@include('admin.layouts.footer')