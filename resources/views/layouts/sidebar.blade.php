<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Waviq</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">


            {{--<li><a href="#"><i class="fa fa-book"></i> <span>Documentation</span></a></li>--}}
            {{--<li class="header">LABELS</li>--}}
            <li><a href="{{url(action('MainController@lendings'))}}"><i class="fa fa-circle-o text-red"></i> <span>Lending</span></a></li>
            <li><a href="{{url(action('MainController@movies'))}}"><i class="fa fa-circle-o text-yellow"></i> <span>Movie</span></a></li>
            <li><a href="{{url(action('MainController@members'))}}"><i class="fa fa-circle-o text-aqua"></i> <span>Member</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>