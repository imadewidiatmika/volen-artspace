<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Administration & Password</title>
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
                  NEW ADMINISTRATOR
                </a>
              </div>
              <div class="col-auto ms-auto d-print-none">
                <form method="GET" action="{{ route('admin.administrators.index') }}" class="d-flex flex-wrap align-items-center">
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
                      <th>ADMINISTRATOR</th>
                      <th>ID NUM</th>
                      <th>STATUS</th>
                      <th>ADDRESS</th>
                      <th>PHONE</th>
                      <th>ACTIONS</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($administrators as $admin)
                    <tr>
                      <td>{{ $admin->username }}</td>
                      <td>{{ $admin->identity_number }}</td>
                      <td>
                        <span class="badge bg-{{ $admin->is_active ? 'green' : 'red' }}-lt">
                          {{ $admin->is_active ? 'Active' : 'Inactive' }}
                        </span>
                      </td>
                      <td>{{ $admin->address ?? '-' }}</td>
                      <td>{{ $admin->phone_number ?? '-' }}</td>
                      <td>
                        <a href="#" onclick="openEditModal({{ $admin->id }})"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="blue" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg></a>
                        <a href="#" onclick="deleteAdmin({{ $admin->id }})" class="text-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg></a>
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="6" class="text-center text-muted">No administrators found.</td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
              <div class="card-footer d-flex align-items-center">
                <p class="m-0 text-secondary">Showing {{ $administrators->firstItem() ?? 0 }} to {{ $administrators->lastItem() ?? 0 }} of {{ $administrators->total() }} entries</p>
                <div class="ms-auto">{{ $administrators->appends(request()->query())->links() }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="adminModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalTitle"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="adminForm">
            <div class="modal-body">
              <div id="validationErrors" class="alert alert-danger d-none"></div>
              <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Administrator Name</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">ID Number</label>
                    <input type="text" id="identity_number" name="identity_number" class="form-control" required>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea id="address" name="address" class="form-control" rows="2"></textarea>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Phone Number</label>
                    <input type="text" id="phone_number" name="phone_number" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Status</label>
                    <select id="is_active" name="is_active" class="form-select">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
              </div>
              <hr>
              <div class="row">
                  <div class="col-md-6 mb-3">
                      <label class="form-label">New Password</label>
                      <input type="password" id="password" name="password" class="form-control">
                      <small class="form-hint" id="passwordHint">Leave blank to keep current password.</small>
                  </div>
                  <div class="col-md-6 mb-3">
                      <label class="form-label">Confirm Password</label>
                      <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                  </div>
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

    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>
    <script src="{{ asset('js/administrationDatabase.js') }}"></script>
  </body>
</html>