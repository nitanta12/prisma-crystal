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
                            Campaigns
                        </a>
                    </li>

                </ul>
            </li>

            <li class="nav-item nav-dropdown">
                <a class="nav-link  nav-dropdown-toggle">
                    <i class="fas fa-users nav-icon">

                    </i>
                    Bills
                </a>
                <ul class="nav-dropdown-items">
                  
                     <li class="nav-item">
                        <a href="{{ route("admin.vendor_bill_report") }}" class="nav-link {{ request()->is('admin/vendor_bill_report/*') || request()->is('admin/vendor_bill_report/*') ? 'active' : '' }}">
                            <i class="fas fa-users nav-icon">

                            </i>
                            Vendor Bills
                        </a>
                    </li>

                    <li class="nav-item">
                         <a href="{{ route("admin.client_bill_report") }}" class="nav-link {{ request()->is('admin/client_bill_report/*') || request()->is('admin/client_bill_report/*') ? 'active' : '' }}">
                            <i class="fas fa-users nav-icon">

                            </i>
                            Client Bills
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
