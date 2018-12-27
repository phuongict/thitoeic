@include("master.layouts.header")
<header class="main-header">
    <nav class="navbar navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a href="../../index2.html" class="navbar-brand"><b>Hoc</b>TiengAnh</a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Trang chủ <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">Giới thiệu</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                            <li class="divider"></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
                    </div>
                </form>
            </div>
            <!-- /.navbar-collapse -->
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="dropdown messages-menu">
                        <!-- Menu toggle button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="label label-success">4</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 4 messages</li>
                            <li>
                                <!-- inner menu: contains the messages -->
                                <ul class="menu">
                                    <li><!-- start message -->
                                        <a href="#">
                                            <div class="pull-left">
                                                <!-- User Image -->
                                                <img src="{{ asset('/public/front/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
                                            </div>
                                            <!-- Message title and timestamp -->
                                            <h4>
                                                Support Team
                                                <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                            </h4>
                                            <!-- The message -->
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                    <!-- end message -->
                                </ul>
                                <!-- /.menu -->
                            </li>
                            <li class="footer"><a href="#">See All Messages</a></li>
                        </ul>
                    </li>
                    <!-- /.messages-menu -->

                    <!-- Notifications Menu -->
                    <li class="dropdown notifications-menu">
                        <!-- Menu toggle button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning">10</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 10 notifications</li>
                            <li>
                                <!-- Inner Menu: contains the notifications -->
                                <ul class="menu">
                                    <li><!-- start notification -->
                                        <a href="#">
                                            <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                        </a>
                                    </li>
                                    <!-- end notification -->
                                </ul>
                            </li>
                            <li class="footer"><a href="#">View all</a></li>
                        </ul>
                    </li>
                    <!-- Tasks Menu -->
                    <li class="dropdown tasks-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-flag-o"></i>
                            <span class="label label-danger">9</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 9 tasks</li>
                            <li>
                                <!-- Inner menu: contains the tasks -->
                                <ul class="menu">
                                    <li><!-- Task item -->
                                        <a href="#">
                                            <!-- Task title and progress text -->
                                            <h3>
                                                Design some buttons
                                                <small class="pull-right">20%</small>
                                            </h3>
                                            <!-- The progress bar -->
                                            <div class="progress xs">
                                                <!-- Change the css width attribute to simulate progress -->
                                                <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">20% Complete</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <!-- end task item -->
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="#">View all tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="{{ asset('/public/front/dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">Phạm Phương</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="{{ asset('/public/front/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">

                                <p>
                                    Alexander Pierce - Web Developer
                                    <small>Member since Nov. 2012</small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="row">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="#" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-custom-menu -->
        </div>
        <!-- /.container-fluid -->
    </nav>
</header>
<!-- Full Width Column -->
<div class="content-wrapper">
    <div class="container">
        <!-- Main content -->
        <section class="content">
            <div id="msg-box">

                @isset($errors)
                    @foreach ($errors  as $error)
                        <div class="callout callout-danger" style="margin-bottom:0;">{{ $error }}</div>
                    @endforeach
                @endisset
                @isset($success)
                    @foreach ($success  as $msg)
                        <div class="callout callout-success" style="margin-bottom:0;">{{ $msg }}</div>
                    @endforeach
                @endisset
                @isset($success)
                    @foreach ($warnings  as $msg)
                        <div class="callout callout-warning" style="margin-bottom:0;">{{ $msg }}</div>
                    @endforeach
                @endisset
            </div>
            @yield('slide')
            <section class="content-header" style="padding:15px;">
                <h1>
                    Design
                    <small>v1.0</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="#">Layout</a></li>
                    <li class="active">Top Navigation</li>
                </ol>
            </section>
            <div class="row">
                <div class="col-md-9">
                    @yield("content")
                </div>
                <div class="col-md-3">
                    @include('master.layouts.sidebar')
                    @yield("sidebar")
                </div>
            </div>
            <div class="box box-danger">
                <div class="box-header">
                    <div class="box-title">
                        Danh mục nổi bật
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="owl-carousel owl-theme">
                        <div class="item-feature">
                            <img src="http://placehold.it/150x100" alt="">
                            <div class="content-item-feature">
                                <h4><a href="#">Tài liệu PHP nâng cao</a></h4>
                                <div class="info-item-feature">
                                    <span class="text-center" style="display: block;"> 100 tài liệu</span>
                                </div>
                            </div>
                        </div>
                        <div class="item-feature">
                            <img src="http://placehold.it/150x100" alt="">
                            <div class="content-item-feature">
                                <h4><a href="#">Tài liệu PHP nâng cao</a></h4>
                                <div class="info-item-feature">
                                    <span class="text-center" style="display: block;"> 100 tài liệu</span>
                                </div>
                            </div>
                        </div>
                        <div class="item-feature">
                            <img src="http://placehold.it/150x100" alt="">
                            <div class="content-item-feature">
                                <h4><a href="#">Tài liệu PHP nâng cao</a></h4>
                                <div class="info-item-feature">
                                    <span class="text-center" style="display: block;"> 100 tài liệu</span>
                                </div>
                            </div>
                        </div>
                        <div class="item-feature">
                            <img src="http://placehold.it/150x100" alt="">
                            <div class="content-item-feature">
                                <h4><a href="#">Tài liệu PHP nâng cao</a></h4>
                                <div class="info-item-feature">
                                    <span class="text-center" style="display: block;"> 100 tài liệu</span>
                                </div>
                            </div>
                        </div>
                        <div class="item-feature">
                            <img src="http://placehold.it/150x100" alt="">
                            <div class="content-item-feature">
                                <h4><a href="#">Tài liệu PHP nâng cao</a></h4>
                                <div class="info-item-feature">
                                    <span class="text-center" style="display: block;"> 100 tài liệu</span>
                                </div>
                            </div>
                        </div>
                        <div class="item-feature">
                            <img src="http://placehold.it/150x100" alt="">
                            <div class="content-item-feature">
                                <h4><a href="#">Tài liệu PHP nâng cao</a></h4>
                                <div class="info-item-feature">
                                    <span class="text-center" style="display: block;"> 100 tài liệu</span>
                                </div>
                            </div>
                        </div>
                        <div class="item-feature">
                            <img src="http://placehold.it/150x100" alt="">
                            <div class="content-item-feature">
                                <h4><a href="#">Tài liệu PHP nâng cao</a></h4>
                                <div class="info-item-feature">
                                    <span class="text-center" style="display: block;"> 100 tài liệu</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <!-- /.box -->
        </section>
        <!-- /.content -->
        {{--info--}}
        <section id="info" class="content">
            <div class="row">
                {{--<div class="col-xs-12">--}}
                    <!-- title row -->
                    {{--<div class="row">--}}
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <i class="fa fa-globe"></i> MocChauIT, Inc.
                                <small class="pull-right _myDate"></small>
                            </h2>
                        </div>
                        <!-- /.col -->

                    {{--</div>--}}
                    <!-- info row -->
                    {{--<div class="row invoice-info">--}}
                        <div class="col-sm-4 ">
                            <h4 class="title-info">
                                {{ __('Giới thiệu') }}
                            </h4>
                            <address class="info-content">
                                <p>
                                    Chia sẻ tài liệu là trang trao đổi, chia sẻ tài liệu miễn phí.
                                    Chúng tôi không chịu trách nhiệm về nội dung, bản quyền tài liệu do thanh viên đăng tải.
                                </p>
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <h4 class="title-info">
                                {{ __('Liên hệ') }}
                            </h4>
                            <address class="info-content">
                                <strong>Phạm Phương</strong><br>
                                Mộc châu, Sơn la<br>
                                Phone: 0981914596<br>
                                Email: phamphuongict@gmail.com
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <h4 class="title-info">
                                {{ __('Thống kê') }}
                            </h4>
                            <div class="table-responsive info-content">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Thành viên:</th>
                                        <td>2.500</td>
                                    </tr>
                                    <tr>
                                        <th>Danh mục</th>
                                        <td>100</td>
                                    </tr>
                                    <tr>
                                        <th>Tài liệu</th>
                                        <td>10.000</td>
                                    </tr>
                                    <tr>
                                        <th>Bình luận</th>
                                        <td>15.000</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    {{--</div>--}}
                {{--</div>--}}
            </div>

            <!-- /.row -->
        </section>

    </div>
    <!-- /.container -->
</div>

<!-- /.content-wrapper -->




<footer class="main-footer">
    <div class="container">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2018 <a href="https://mocchauit.com">Phạm Phương</a>.</strong> All rights
                                                                                                       reserved.
    </div>
    <!-- /.container -->
</footer>
@include("master.layouts.footer")
