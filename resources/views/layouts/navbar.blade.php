<ul class="navbar-nav">
    <li class="nav-item {{ Request::is('/') ? ' active' : '' }}">
        <a href="{{ route('home') }}" class="nav-link"><i class="fas fa-fire"></i><span>Home</span></a>
    </li>
    <li class="nav-item {{ Request::is('student*') ? ' active' : '' }}">
        <a href="{{ route('student.index') }}" class="nav-link"><i class="fas fa-users"></i><span>Mahasiswa</span></a>
    </li>
</ul>