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
    <a class="nav-link {{ request()->routeIs('daftar-guru.*','absensi.*','absensi-guru.*','absensi-siswa.*') ? '' : 'collapsed' }}" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-journal-text"></i><span>Data Siswa</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="forms-nav" class="nav-content collapse {{ request()->routeIs('daftar-guru.*','absensi.*','absensi-guru.*','absensi-siswa.*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
      <li>
        <a href="{{ route('absensi.index') }}" class="nav-link {{ request()->routeIs('absensi.*','absensi-guru.*','absensi-siswa.*') ? '' : 'collapsed' }}">
          <i class="bi bi-circle"></i><span>Absensi</span>
        </a>
      </li>
      <li>
        <a href="forms-editors.html">
          <i class="bi bi-circle"></i><span>Jadwal Guru</span>
        </a>
      </li>

    </ul>
  </li><!-- End Forms guru Nav -->


  <li class="nav-heading">Pages</li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="users-profile.html">
      <i class="bi bi-person"></i>
      <span>Profile</span>
    </a>
  </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('logout') }}" onclick="return confirm('Apakah anda yakin ingin keluar?')">
          <i class="fa-solid fa-right-from-bracket"></i>
          <span>Keluar</span>
        </a>
      </li><!-- End Contact Page Nav -->

</ul>

</aside><!-- End Sidebar-->
