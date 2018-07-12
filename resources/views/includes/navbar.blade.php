<header class="main-header">
        <!-- Logo -->
        <a href="../../index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><img src="{{asset('img/dpwh_logo.png')}}" style="width:40px;height:40px;"></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><img src="{{asset('img/dpwh_logo.png')}}" style="width:40px;height:40px;"><b>DPWHBid</b>Sys</span>
        </a>
            <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </a>
    
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="{{ route('logout') }}" data-toggle="control-sidebar" class="btn btn" onclick="event.preventDefault();document.getElementById('logout-form').submit();">LOGOUT</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                    </li>
                </ul>
            </div>
        </nav>
    </header>