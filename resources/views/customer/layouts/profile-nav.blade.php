<ul class="profile__tabs list-unstyled ps-3">
    <li class="profile__tab {{ request()->routeIs('customer.profile') ? 'active' : 'collapsed' }}">
        <a class="py-2 px-3 text-black text-decoration-none" href="{{ route('customer.profile') }}">لوحة التحكم</a>
    </li>
    <li class="profile__tab {{ request()->routeIs('orders.index') ? 'active' : 'collapsed' }}">
        <a class="py-2 px-3 text-black text-decoration-none" href="{{ route('orders.index') }}">الطلبات</a>
    </li>

    <li class="profile__tab {{ request()->routeIs('customer.account_details') ? 'active' : 'collapsed' }}">
        <a class="py-2 px-3 text-black text-decoration-none" href="{{ route('customer.account_details') }}">تفاصيل
            الحساب</a>
    </li>
    <li class="profile__tab {{ request()->routeIs('customer.wishlist') ? 'active' : 'collapsed' }}">
        <a class="py-2 px-3 text-black text-decoration-none" href="{{ route('customer.wishlist') }}">المفضلة</a>
    </li>
    <li class="profile__tab">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="py-2 px-3 text-black text-decoration-none" style="background: none; border: none; color: inherit;">
                تسجيل الخروج
            </button>
        </form>
    </li>
</ul>
