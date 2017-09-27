<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">IMMA Dashboard</a>
    </div>
    <!-- /.navbar-header -->



    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">

                <li>
                    <a href="#"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Ports<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{url('ports')}}">Ports</a>
                        </li>
                        <li>
                            <a href="{{url('suppliers')}}">Port Suppliers</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>

                <li>
                    <a href="#"><i class="fa fa-edit fa-fw"></i> Documents</a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{url('globaldocs')}}">Global Documents</a>
                        </li>
                        <li>
                            <a href="{{url('userdocs')}}">User Documents</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{url('settings')}}"><i class="fa fa-wrench fa-fw"></i> Settings</a>
                    <!-- /.nav-second-level -->
                </li>

                <li>
                    <a href="#"><i class="fa fa-edit fa-fw"></i> Products</a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{url('products')}}">Products</a>
                        </li>
                        <li>
                            <a href="{{url('categories')}}">Categories</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>