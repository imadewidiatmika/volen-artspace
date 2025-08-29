<!-- ✅ SIDEBAR TETAP -->
<aside class="navbar navbar-vertical navbar-expand-lg">
  <div class="container-fluid">
    <div class="navbar-brand">
      <div class="ms-1 d-flex flex-column lh-1">
        <div class="h5 m-0 p-0">Ida Ayu Widyari Anggal...</div>
        <div class="d-flex align-items-center badge bg-green-lt px-2 py-1">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="green" class="icon icon-tabler icons-tabler-filled icon-tabler-point">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M12 7a5 5 0 1 1 -4.995 5.217l-.005 -.217l.005 -.217a5 5 0 0 1 4.995 -4.783z" />
          </svg>
          <span class="small">Online</span>
        </div>
      </div>
    </div>

    <div class="collapse navbar-collapse" id="sidebar-menu">
      <ul class="navbar-nav pt-lg-3">

        <!-- ✅ USERS & ACTIVITIES -->
        <li class="nav-item dropdown {{ Request::is('activitiesDatabase', 'administration') ? 'active show' : '' }}">
          <a class="nav-link dropdown-toggle" href="#navbar-users" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="{{ Request::is('activitiesDatabase', 'administration') ? 'true' : 'false' }}">
            <span class="nav-link-title">Users & Activities</span>
          </a>
          <div class="dropdown-menu {{ Request::is('activitiesDatabase', 'administration') ? 'show' : '' }}">
            <a class="dropdown-item {{ Request::is('administration') ? 'active' : '' }}" href="/administration">
              <span class="nav-link-icon d-md-none d-lg-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z"></path>
                  <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0"></path>
                  <path d="M8 11v-4a4 4 0 1 1 8 0v4"></path>
                </svg>
              </span>
              Administrator & Password
            </a>
            <a class="dropdown-item {{ Request::is('activitiesDatabase') ? 'active' : '' }}" href="/activitiesDatabase">
              <span class="nav-link-icon d-md-none d-lg-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-database" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M12 6m-8 0a8 3 0 1 0 16 0a8 3 0 1 0 -16 0"></path>
                  <path d="M4 6v6l8 0"></path>
                  <path d="M12 12l8 0v6l-8 0"></path>
                  <path d="M4 18l16 0"></path>
                </svg>
              </span>
              Activities Database
            </a>
          </div>
        </li>

        <!-- ✅ SCHEDULE & REGISTRATION -->
        <li class="nav-item dropdown {{ Request::is('activitySchedule', 'registration', 'detailAttendance', 'registrants') ? 'active show' : '' }}">
          <a class="nav-link dropdown-toggle" href="#navbar-schedule" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="{{ Request::is('activitySchedule', 'registration', 'detailAttendance', 'registrants') ? 'true' : 'false' }}">
            <span class="nav-link-title">Schedule & Registration</span>
          </a>
          <div class="dropdown-menu {{ Request::is('activitySchedule', 'registration', 'detailAttendance', 'registrants') ? 'show' : '' }}">
            <a class="dropdown-item {{ Request::is('activitySchedule') ? 'active' : '' }}" href="/activitySchedule">
              <span class="nav-link-icon d-md-none d-lg-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z"></path>
                  <path d="M16 3v4"></path>
                  <path d="M8 3v4"></path>
                  <path d="M4 11h16"></path>
                </svg>
              </span>
              Activity Scheduling
            </a>
            <a class="dropdown-item {{ Request::is('registration') ? 'active' : '' }}" href="/registration">
              <span class="nav-link-icon d-md-none d-lg-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                  <path d="M16 19h6"></path>
                  <path d="M19 16v6"></path>
                  <path d="M6 21v-2a4 4 0 0 1 4 -4h4"></path>
                </svg>
              </span>
              New Registration <span class="badge bg-green-lt ms-auto">NEW</span>
            </a>
            <a class="dropdown-item {{ Request::is('registrants') ? 'active' : '' }}" href="/registrants">
              <span class="nav-link-icon d-md-none d-lg-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M9 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                  <path d="M3 21v-2a4 4 0 0 1 4 -4h1a4 4 0 0 1 4 4v2"></path>
                  <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                  <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                </svg>
              </span>
              Registrants of Activities
            </a>
            <a class="dropdown-item {{ Request::is('detailAttendance') ? 'active' : '' }}" href="/detailAttendance">
              <span class="nav-link-icon d-md-none d-lg-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clipboard-list" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path>
                  <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path>
                  <path d="M9 12h6"></path>
                  <path d="M9 16h6"></path>
                </svg>
              </span>
              Detail Attendance
            </a>
          </div>
        </li>

        <!-- ✅ PARTICIPANTS -->
        <li class="nav-item dropdown {{ Request::is('participants') ? 'active show' : '' }}">
          <a class="nav-link dropdown-toggle" href="#navbar-participants" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="{{ Request::is('participants') ? 'true' : 'false' }}">
            <span class="nav-link-title">Participants</span>
          </a>
          <div class="dropdown-menu {{ Request::is('participants') ? 'show' : '' }}">
            <a class="dropdown-item {{ Request::is('participants') ? 'active' : '' }}" href="/participants">
              <span class="nav-link-icon d-md-none d-lg-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-database" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M12 6m-8 0a8 3 0 1 0 16 0a8 3 0 1 0 -16 0"></path>
                  <path d="M4 6v6l8 0"></path>
                  <path d="M12 12l8 0v6l-8 0"></path>
                  <path d="M4 18l16 0"></path>
                </svg>
              </span>
              Participants Database
            </a>
          </div>
        </li>
      </ul>
    </div>

    <!-- ✅ FOOTER LOGOUT -->
 <div class="mt-auto p-3 d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .031 2.572 -1.065z"></path>
              <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
            </svg>
            <a href="#" class="h5 m-0 ps-2 text-decoration-none">Log Out</a>
          </div>
  </div>
</aside>
