<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('vendor.dashboard') ? 'active' : 'collapsed' }}" href="{{ route('vendor.dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('vendor.products.index') ? 'active' : 'collapsed' }}" href="{{ route('vendor.products.index') }}">
                <i class="ri-shopping-bag-line"></i>
                <span>Products</span>
            </a>
        </li><!-- End Dashboard Nav -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('vendor.reviews') ? 'active' : 'collapsed' }}" href="{{ route('vendor.reviews') }}">
                <i class="ri-chat-3-line"></i>
                <span>Reviews</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('vendor.orders') ? 'active' : 'collapsed' }}" href="{{ route('vendor.orders') }}">
                <i class="ri-shopping-cart-2-line"></i>
                <span>Orders</span>
            </a>

        </li><!-- End Orders Nav -->

        <li class="nav-heading">Pages</li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('vendor.profile') ? 'active' : 'collapsed' }}" href="{{ route('vendor.profile') }}">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->

        {{-- <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('vendor.logout') ? 'active' : 'collapsed' }}" href="{{ route('vendor.logout') }}">
                <i class="bi bi-box-arrow-in-left"></i>
                <span>Logout</span>
            </a>
        </li><!-- end Logout Page Nav --> --}}

    </ul>

</aside><!-- End Sidebar-->
