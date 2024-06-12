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
    <a class="nav-link {{ request()->routeIs('daftar-guru.*','absensi.*','absensi-guru.*') ? '' : 'collapsed' }}" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-journal-text"></i><span>Data Guru</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="forms-nav" class="nav-content collapse {{ request()->routeIs('daftar-guru.*','absensi.*','absensi-guru.*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
      <li>
        <a href="{{ route('daftar-guru.index') }}" class="nav-link {{ request()->routeIs('daftar-guru.*') ? '' : 'collapsed' }}">
          <i class="bi bi-circle"></i><span>Data Guru</span>
        </a>
      </li>
      <li>
        <a href="{{ route('absensi.index') }}" class="nav-link {{ request()->routeIs('absensi.*','absensi-guru.*') ? '' : 'collapsed' }}">
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

  <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('siswa.*') ? '' : 'collapsed' }}" data-bs-target="#forms-siswaCrud-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Data Siswa</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-siswaCrud-nav" class="nav-content collapse {{ request()->routeIs('siswa.*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">

          <li>
            <a href="/siswa" class="nav-link {{ request()->routeIs('siswa.*') ? '' : 'collapsed' }}">
              <i class="bi bi-circle"></i><span>Data Siswa</span>
            </a>
          </li>
          <li>
            <a href="/ekstrakurikuler" class="nav-link {{ request()->routeIs('ekstrakurikuler.*') ? '' : 'collapsed' }}">
              <i class="bi bi-circle"></i><span>ekstrakurikuler</span>
            </a>
          </li>
        </ul>
    </li><!-- End Forms Nav -->

  <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('daftar-kelas.index') ? '' : 'collapsed' }}" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-journal-text"></i><span>Data Kelas</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="forms-nav" class="nav-content collapse {{ request()->routeIs('daftar-kelas.*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
      <li>
        <a href="{{ route('daftar-kelas.index') }}" class="nav-link {{ request()->routeIs('daftar-kelas.index') ? '' : 'collapsed' }}">
          <i class="bi bi-circle"></i><span>Daftar Kelas</span>
        </a>
      </li>
      {{-- <li>
        <a href="{{ route('daftar-kelas.index') }}" class="nav-link {{ request()->routeIs('daftar-kelas.index') ? '' : 'collapsed' }}">
          <i class="bi bi-circle"></i><span>Kelas 2</span>
        </a>
      </li>
      <li>
        <a href="{{ route('daftar-kelas.index') }}" class="nav-link {{ request()->routeIs('daftar-kelas.index') ? '' : 'collapsed' }}">
          <i class="bi bi-circle"></i><span>Kelas 3</span>
        </a>
      </li> --}}
    </ul>
  </li><!-- End Forms Nav -->

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
