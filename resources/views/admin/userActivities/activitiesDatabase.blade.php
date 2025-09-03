<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Activities Database</title>
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
          <div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col-auto">
                <a href="#" class="btn btn-add d-none d-sm-inline-block" onclick="openAddModal()">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                  NEW ACTIVITY
                </a>
              </div>
              <div class="col-auto ms-auto d-print-none">
                <form method="GET" action="{{ route('admin.activities.index') }}" class="d-flex flex-wrap align-items-center">
                  <div class="input-icon me-3">
                    <input type="text" name="search" class="form-control" placeholder="Search keywords..." value="{{ request('search') }}">
                  </div>
                  <div class="btn-list d-flex align-items-center me-3">
                    <select class="form-select" style="width: auto;" name="per_page" onchange="this.form.submit()">
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

          <div class="page-body">
            <div class="card">
              <div class="table-responsive">
                <table class="flat-table">
                  <thead>
                    <tr>
                      <th>ID</th><th>ACTIVITY NAME</th><th>ACTIONS</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($activities as $activity)
                    <tr>
                      <td>{{ $activity->id }}</td>
                      <td>{{ $activity->name }}</td>
                      <td>
                        <a href="#" onclick="openEditModal('{{ $activity->id }}')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="blue" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg></a>
                        <a href="#" onclick="deleteActivity('{{ $activity->id }}')" class="text-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg></a>
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="3" class="text-center text-muted">No activities found.</td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
              <div class="card-footer d-flex align-items-center">
                <p class="m-0 text-secondary">Showing {{ $activities->firstItem() ?? 0 }} to {{ $activities->lastItem() ?? 0 }} of {{ $activities->total() }} entries</p>
                <div class="ms-auto">{{ $activities->appends(request()->query())->links() }}</div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="activityModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalTitle"></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="activityForm"
                      data-store-url="{{ route('admin.activities.store') }}"
                      data-update-url="{{ route('admin.activities.update', ['activity' => 'ACTIVITY_ID']) }}">
                  <div class="modal-body">
                    <div id="validationErrors" class="alert alert-danger d-none"></div>
                    <div class="mb-3">
                      <label class="form-label">Activity Name</label>
                      <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>
    <script src="{{ asset('js/activities.js') }}"></script>
  </body>
</html>