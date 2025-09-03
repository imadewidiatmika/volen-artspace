<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Activity Scheduling</title>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler-vendors.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/tabler.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>

  <body class="theme-dark">
    <div class="page">
      <x-aside />
      <div class="page-wrapper">
        <div class="container-fluid">
          
          @if(session('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
              <div>{{ session('success') }}</div>
              <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
          @endif
          @if(session('error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
              <div>{{ session('error') }}</div>
              <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
          @endif

          <div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col-auto">
                <a href="#" class="btn btn-add d-none d-sm-inline-block" onclick="openAddModal()">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                  ADD NEW SCHEDULE
                </a>
              </div>
              <div class="col-auto ms-auto d-print-none">
                <div class="d-flex flex-wrap align-items-center">
                  <form method="GET" action="{{ route('admin.activity-schedules.index') }}" class="d-flex align-items-center">
                    <div class="input-icon me-3">
                      <input type="text" name="search" class="form-control" placeholder="Search keywords..." value="{{ request('search') }}" aria-label="Search keywords">
                    </div>
                    <div class="btn-list d-flex align-items-center me-3">
                      <select class="form-select" style="width: auto; name="per_page" onchange="this.form.submit()">
                        <option value="10" @if(request('per_page') == 10) selected @endif>10</option>
                        <option value="15" @if(request('per_page', 15) == 15) selected @endif>15</option>
                        <option value="25" @if(request('per_page') == 25) selected @endif>25</option>
                        <option value="50" @if(request('per_page') == 50) selected @endif>50</option>
                      </select>
                      <span class="text-secondary">Records per-page</span>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div class="page-body">
            <div class="card">
              <div class="table-responsive">
                <table class="flat-table">
                  <thead>
                    <tr>
                      <th>DATE</th><th>TIME</th><th>ACTIVITY</th><th>LOCATION</th><th>PRICE</th><th>REG. PRTCP.</th><th>ATT. PRTCP.</th><th>STATUS</th><th>ACTIONS</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($schedules as $schedule)
                      <tr>
                        <td>{{ \Carbon\Carbon::parse($schedule->date)->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($schedule->time)->format('H:i') }}</td>
                        {{-- Menampilkan nama aktivitas dari relasi --}}
                        <td>{{ $schedule->activity->name ?? 'N/A' }}</td>
                        <td>{{ $schedule->location }}</td>
                        <td>{{ number_format($schedule->price, 0, ',', '.') }}</td>
                        <td><a href="#" class="text-primary">{{ $schedule->registered_participants ?? 0 }}</a></td>
                        <td><a href="#" class="text-primary">{{ $schedule->attended_participants ?? 0 }}</a></td>
                        <td>
                          <span class="badge bg-{{ $schedule->status === 'Open Registration' ? 'green' : ($schedule->status === 'Closed Registration' ? 'yellow' : ($schedule->status === 'Completed' ? 'blue' : 'red')) }}-lt">
                            {{ $schedule->status }}
                          </span>
                        </td>
                        <td>
                          <a href="#" onclick="openEditModal('{{ $schedule->id }}')" class="me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="blue" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                          </a>
                          <a href="#" onclick="deleteSchedule('{{ $schedule->id }}')" class="text-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                          </a>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="9" class="text-center text-muted">No schedules found. <a href="#" onclick="openAddModal()">Add your first schedule</a></td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
              <div class="card-footer d-flex align-items-center">
                <p class="m-0 text-secondary">Showing {{ $schedules->firstItem() ?? 0 }} to {{ $schedules->lastItem() ?? 0 }} of {{ $schedules->total() }} entries</p>
                <div class="ms-auto">{{ $schedules->appends(request()->query())->links() }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="scheduleModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalTitle"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="scheduleForm" data-store-url="{{ route('admin.activity-schedules.store') }}">
            <div class="modal-body">
              <div id="validationErrors" class="alert alert-danger d-none"></div>
              <div class="row">
                <div class="col-md-6 mb-3"><label class="form-label">Date</label><input type="date" id="date" name="date" class="form-control" required></div>
                <div class="col-md-6 mb-3"><label class="form-label">Time</label><input type="time" id="time" name="time" class="form-control" required></div>
              </div>
              
              {{-- Input teks diubah menjadi Select Dropdown --}}
              <div class="mb-3">
                <label class="form-label">Activity</label>
                <select id="activity" name="activity_id" class="form-select" required>
                    <option value="" disabled selected>-- Select Activity --</option>
                    {{-- Loop data $activities yang dikirim dari controller --}}
                    @if(isset($activities))
                      @foreach ($activities as $activity)
                          <option value="{{ $activity->id }}">{{ $activity->name }}</option>
                      @endforeach
                    @endif
                </select>
              </div>

              <div class="mb-3"><label class="form-label">Location</label><input type="text" id="location" name="location" class="form-control" placeholder="e.g., The Patra Exquisite - Ubud, Bali" required></div>
              <div class="row">
                <div class="col-md-6 mb-3"><label class="form-label">Price (IDR)</label><input type="number" id="price" name="price" class="form-control" placeholder="550000" required></div>
                <div class="col-md-6 mb-3"><label class="form-label">Max Participants</label><input type="number" id="max_participants" name="max_participants" class="form-control" placeholder="15" min="1" max="100" required></div>
              </div>
              <div class="mb-3">
                <label class="form-label">Status</label>
                <select id="status" name="status" class="form-select">
                  <option value="#">- Select Status -</option>
                    <option value="Open Registration">Open Registration</option>
                    <option value="Closed Registration">Closed Registration</option>
                </select>
              </div>
              <div class="mb-3"><label class="form-label">Description (Optional)</label><textarea id="description" name="description" class="form-control" rows="3" placeholder="Brief description of the activity..."></textarea></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Save Schedule</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>
    <script src="{{ asset('js/activitySchedule.js') }}"></script>
  </body>
</html>