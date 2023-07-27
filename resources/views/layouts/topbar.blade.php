<a href="index.html" class="navbar-brand sidebar-gone-hide">Manajemen Kelas</a>
    <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
    <div class="nav-collapse">
        <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#">
            <i class="fas fa-ellipsis-v"></i>   
        </a>
    </div>
    <form class="form-inline ml-auto">
    </form>
    <ul class="navbar-nav navbar-right">
    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
        <img alt="image" src="{{ auth()->user()->avatar_url }}" class="rounded-circle mr-1">
        <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->name }}</div></a>
        <div class="dropdown-menu dropdown-menu-right">
        <div class="dropdown-title">Active</div>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item has-icon text-danger" href="{{ route('logout') }}"
        onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
         <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
        </a>
  
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        </div>
    </li>
</ul>