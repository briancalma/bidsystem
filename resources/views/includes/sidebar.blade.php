<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('vendor/almasaeed2010/dist/img/avatar.png')}}" class="img-circle" alt="User Image">
            </div>
        <div class="pull-left info">
            <p>{{ auth()->user()->name }}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                    </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li @if($data['title'] === 'Home') class="active" @endif>
                <a href="/dashboard"><i class="fa fa-home"></i> <span>HOME</span></a>
            </li>
            
            @if( auth()->user()->account_type == "client")
                <li @if($data['title'] === 'Projects') class="active" @endif>
                    <a href="/projects"><i class="fa fa-address-card"></i> <span>PROJECTS</span></a>
                </li>

                <li @if($data['title'] === 'Proposals') class="active" @endif>
                    <a href="/proposals"><i class="fa fa-edit"></i> <span>PROPOSALS</span></a>
                </li>
            @else
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-address-card"></i> <span>PROJECTS</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="/projects/create"><i class="fa fa-plus-circle"></i> Add New Project</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> Pending Projects</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> On-Going Projects</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> Finished Projects</a></li>
                    </ul>
                </li>
            @endif
        </ul>
    </section>
        <!-- /.sidebar -->
</aside>