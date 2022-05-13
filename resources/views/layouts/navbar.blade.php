<ul class="navbar-nav">
    <li class="nav-item {{ Request::is('/') ? ' active' : '' }}">
        <a href="{{ route('home') }}" class="nav-link"><i class="fas fa-fire"></i><span>Home</span></a>
    </li>
</ul>