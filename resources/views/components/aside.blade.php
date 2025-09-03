<aside class="navbar navbar-vertical navbar-expand-lg">
  <div class="container-fluid">
    <div class="navbar-brand">
      <div class="ms-1 d-flex flex-column lh-1">
        <div class="h5 m-0 p-0">Ida Ayu Widyari Anggal...</div>
        <div class="d-flex align-items-center badge bg-green-lt px-2 py-1">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="green" class="icon icon-tabler icons-tabler-filled icon-tabler-point"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M12 7a5 5 0 1 1 -4.995 5.217l-.005 -.217l.005 -.217a5 5 0 0 1 4.995 -4.783z" /></svg>
          <span class="small">Online</span>
        </div>
      </div>
    </div>

    <div class="collapse navbar-collapse" id="sidebar-menu">
      <ul class="navbar-nav pt-lg-3">

        <li class="nav-item dropdown {{ request()->routeIs('admin.administrators.*', 'admin.activities.*') ? 'active show' : '' }}">
          <a class="nav-link dropdown-toggle" href="#navbar-users" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="{{ request()->routeIs('admin.administrators.*', 'admin.activities.*') ? 'true' : 'false' }}">
            <span class="nav-link-title">Users & Activities</span>
          </a>
          <div class="dropdown-menu {{ request()->routeIs('admin.administrators.*', 'admin.activities.*') ? 'show' : '' }}">
            <a class="dropdown-item {{ request()->routeIs('admin.administrators.*') ? 'active' : '' }}" href="{{ route('admin.administrators.index') }}">
              <span class="nav-link-icon d-md-none d-lg-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z"></path><path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0"></path><path d="M8 11v-4a4 4 0 1 1 8 0v4"></path></svg>
              </span>
              Administrator & Password
            </a>
            <a class="dropdown-item {{ request()->routeIs('admin.activities.*') ? 'active' : '' }}" href="{{ route('admin.activities.index') }}">
              <span class="nav-link-icon d-md-none d-lg-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-database" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 6m-8 0a8 3 0 1 0 16 0a8 3 0 1 0 -16 0"></path><path d="M4 6v6l8 0"></path><path d="M12 12l8 0v6l-8 0"></path><path d="M4 18l16 0"></path></svg>
              </span>
              Activities Database
            </a>
          </div>
        </li>

        <li class="nav-item dropdown {{ request()->routeIs('admin.activity-schedules.*', 'admin.registrations.new', 'admin.detailAttendance', 'admin.registrants') ? 'active show' : '' }}">
          <a class="nav-link dropdown-toggle" href="#navbar-schedule" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="{{ request()->routeIs('admin.activity-schedules.*', 'admin.registrations.new', 'admin.detailAttendance', 'admin.registrants') ? 'true' : 'false' }}">
            <span class="nav-link-title">Schedule & Registration</span>
          </a>
          <div class="dropdown-menu {{ request()->routeIs('admin.activity-schedules.*', 'admin.registrations.new', 'admin.detailAttendance', 'admin.registrants') ? 'show' : '' }}">
            <a class="dropdown-item {{ request()->routeIs('admin.activity-schedules.*') ? 'active' : '' }}" href="{{ route('admin.activity-schedules.index') }}">
              <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-time"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11.795 21h-6.795a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M18 16.5v1.5l.5 .5" /></svg></span>
              Activity Scheduling
            </a>
            <a class="dropdown-item {{ request()->routeIs('admin.registrations.new') ? 'active' : '' }}" href="{{ route('admin.registrations.new') }}">
              <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M16 19h6" /><path d="M19 16v6" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4" /></svg></span>
              New Registration 
              @if(isset($newRegistrationCount) && $newRegistrationCount > 0)
                <span class="badge bg-green-lt ms-auto">{{ $newRegistrationCount }}</span>
              @endif
            </a>
            <a class="dropdown-item {{ request()->routeIs('admin.registrants') ? 'active' : '' }}" href="{{ route('admin.registrants') }}">
              <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h1a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg></span>
              Registrants of Activities
            </a>
            <a class="dropdown-item {{ request()->routeIs('admin.detailAttendance') ? 'active' : '' }}" href="{{ route('admin.detailAttendance') }}">
              <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-clipboard-list"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M9 12h6" /><path d="M9 16h6" /></svg></span>
              Detail Attendance
            </a>
          </div>
        </li>

        {{-- PERBAIKAN: Menggunakan `admin.participants.*` untuk routeIs agar menu tetap aktif --}}
        <li class="nav-item dropdown {{ request()->routeIs('admin.participants.*') ? 'active show' : '' }}">
          <a class="nav-link dropdown-toggle" href="#navbar-participants" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="{{ request()->routeIs('admin.participants.*') ? 'true' : 'false' }}">
            <span class="nav-link-title">Participants</span>
          </a>
          <div class="dropdown-menu {{ request()->routeIs('admin.participants.*') ? 'show' : '' }}">
            {{-- PERBAIKAN: Menggunakan `admin.participants.index` untuk nama route --}}
            <a class="dropdown-item {{ request()->routeIs('admin.participants.index') ? 'active' : '' }}" href="{{ route('admin.participants.index') }}">
              <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users-group"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" /><path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M17 10h2a2 2 0 0 1 2 2v1" /><path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M3 13v-1a2 2 0 0 1 2 -2h2" /></svg></span>
              Participants Database
            </a>
          </div>
        </li>
      </ul>
    </div>

    <div class="mt-auto p-3 d-flex align-items-center">
      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" /><path d="M9 12h12l-3 -3" /><path d="M18 15l3 -3" /></svg>
      <a href="#" class="h5 m-0 ps-2 text-decoration-none">Log Out</a>
    </div>
  </div>
</aside>