<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('dashboard.index') ? '' : 'collapsed' }}" href="{{ route('dashboard.index') }}">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->
  


  <li class="nav-item">
        <a href="{{ route('jadwal-siswa.index') }}" class="nav-link {{ request()->routeIs('jadwal-siswa.*') ? '' : 'collapsed' }}">
            <i class="bi bi-circle"></i><span>Jadwal Siswa</span>
        </a>
  </li><!-- End Forms guru Nav -->

  <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('logout') }}" onclick="return confirm('Apakah anda yakin ingin keluar?')">
          <i class="fa-solid fa-right-from-bracket"></i>
          <span>Keluar</span>
        </a>
      </li><!-- End Contact Page Nav -->

</ul>

</aside><!-- End Sidebar-->
