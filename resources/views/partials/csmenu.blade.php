<div class="sidebar">
    <nav class="sidebar-nav ps ps--active-y">

        <ul class="nav">
            <li class="nav-item">
                <a href="{{ route("admin.home") }}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
          


             <li class="nav-item nav-dropdown">
                <a class="nav-link  nav-dropdown-toggle">
                    <i class="fas fa-users nav-icon">

                    </i>
                    Advertisement
                </a>
                <ul class="nav-dropdown-items">
                  
                     <li class="nav-item">
                        <a href="{{ route("admin.campaigns.index") }}" class="nav-link {{ request()->is('admin/campaigns/*') || request()->is('admin/campaigns/*') ? 'active' : '' }}">
                            <i class="fas fa-users nav-icon">

                            </i>
                            All Campaigns
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route("admin.programs.index") }}" class="nav-link {{ request()->is('admin/programs/*') || request()->is('admin/programs/*') ? 'active' : '' }}">
                            <i class="fas fa-users nav-icon">

                            </i>
                            All Programs
                        </a>
                    </li>

                     <li class="nav-item">
                        <a href="{{route('admin.vendors.index')}}" class="nav-link active">
                            <i class="fas fa-briefcase nav-icon">

                            </i>
                            Vendors
                        </a>
                    </li>
                   
                </ul>
            </li>

           
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>

        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; height: 869px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 415px;"></div>
        </div>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>