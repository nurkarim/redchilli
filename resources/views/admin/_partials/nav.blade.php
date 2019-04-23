<?php
$rname = Route::currentRouteName();
?>
<div class="sidebar-inner leftscroll">

			<div id="sidebar-menu">
        
			<ul>

					<li class="submenu">
						<a  href="{{ url('admin') }}" class="@if($rname=='admin') active @endif"><i class="fa fa-fw fa-bars"></i><span> Dashboard </span> </a>
                    </li>
					<li class="submenu">
                        <a href="#" class="@if($rname=='orders.index' || $rname=='orders.pending' || $rname=='orders.cancel') active @endif"><i class="fa fa-fw fa-table"></i> <span> Orders </span> <span class="menu-arrow"></span></a>
							<ul class="list-unstyled">
								<li class="@if($rname=='orders.index') active @endif"><a href="{{ route('orders.index') }}">Completed Orders</a></li>
								<li class="@if($rname=='orders.pending') active @endif"><a href="{{ route('orders.pending') }}">Pending Orders</a></li>
								<li class="@if($rname=='orders.cancel') active @endif"><a href="{{ route('orders.cancel') }}">Canceled Orders</a></li>
							</ul>
                    </li>
					<li class="submenu">
                        <a href="{{ route('categories.index') }}" class="@if($rname=='categories.index') active @endif"><i class="fa fa-fw fa-desktop"></i><span> Categories </span> </a>
                    </li>
                    <li class="submenu">
                        <a href="{{ route('foodMenus.index') }}" class="@if($rname=='foodMenus.index') active @endif"><i class="fa fa-fw fa-desktop"></i><span> Food Menus </span> </a>
                    </li>
					<li class="submenu">
                        <a href="{{ route('products.index') }}" class="@if($rname=='products.index') active @endif"><i class="fa fa-fw fa-image"></i><span> Items </span> </a>
                    </li>
                    <li class="submenu">
                        <a href="{{ route('discounts.index') }}" class="@if($rname=='discounts.index') active @endif"><i class="fa fa-fw fa-code"></i><span> Discounts </span> </a>
                    </li>
                    <li class="submenu">
                        <a href="#" class="@if($rname=='settings.app') active @endif"><i class="fa fa-fw fa-cogs"></i> <span> Settings </span> <span class="menu-arrow"></span></a>
							<ul class="list-unstyled">
								<li class="@if($rname=='settings.app') active @endif"><a href="{{ route('settings.app') }}">App Setting</a></li>
							
							</ul>
                    </li>
	
            </ul>

            <div class="clearfix"></div>

			</div>
        
			<div class="clearfix"></div>

		</div>