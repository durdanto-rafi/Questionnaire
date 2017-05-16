<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
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
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview {{ Request::is('cruize') ? 'active' : '' }}">
                <a href="{{ route('cruize.index') }}">
                    <i i class="fa fa-suitcase"></i> <span>Cruize</span>
                    <span class="pull-right-container">
                </span>
                </a>
            </li>
            <li class="treeview {{ Request::is('excursion') ? 'active' : '' }}">
                <a href="{{ route('excursion.index') }}">
                    <i class="fa fa-external-link-square"></i> <span>Excursion</span>
                    <span class="pull-right-container">
                </span>
                </a>
            </li>
            <li class="treeview {{ Request::is('guest') ? 'active' : '' }}">
                <a href="{{ route('guest.index') }}">
                    <i class="fa fa-users"></i> <span>Guest</span>
                    <span class="pull-right-container">
                </span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>