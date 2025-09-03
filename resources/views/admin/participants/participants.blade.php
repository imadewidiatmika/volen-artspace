<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Participants Database</title>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler-vendors.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/tabler.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
  <body class="theme-dark" data-store-url="{{ route('admin.participants.store') }}" data-base-url="{{ url('admin/participants') }}">
    <div class="page">
      <x-aside />
      <div class="page-wrapper">
        <div class="container-xl">
          <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
              <div class="col">
                <h2 class="page-title">Participants Database</h2>
              </div>
              <div class="col-auto ms-auto d-print-none">
                <a href="#" class="btn btn-primary" onclick="openAddModal()">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                  NEW PARTICIPANT
                </a>
              </div>
            </div>
          </div>
          <div class="page-body">
            <div class="card">
              <div class="card-header">
                <form method="GET" action="{{ route('admin.participants.index') }}" class="d-flex w-100">
                  <div class="input-icon me-2">
                    <input type="text" name="search" class="form-control" placeholder="Search by name/email..." value="{{ request('search') }}">
                  </div>
                  <select class="form-select me-2" name="per_page" onchange="this.form.submit()" style="width: auto;">
                    <option value="15" @if(request('per_page', 15) == 15) selected @endif>15</option>
                    <option value="25" @if(request('per_page') == 25) selected @endif>25</option>
                    <option value="50" @if(request('per_page') == 50) selected @endif>50</option>
                  </select>
                  <button type="submit" class="btn btn-secondary">Search</button>
                </form>
              </div>
              <div class="table-responsive">
                <table class="table table-vcenter card-table table-striped">
                  <thead>
                    <tr>
                      <th>Participant</th><th>Contact</th><th>Address</th><th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($participants as $participant)
                    <tr>
                      <td>
                        <div>{{ $participant->name }}</div>
                        <div class="text-muted">{{ $participant->id }}</div>
                      </td>
                      <td>
                        <a href="mailto:{{ $participant->email }}">{{ $participant->email }}</a>
                        <div class="text-muted">{{ $participant->phone }}</div>
                      </td>
                      <td>
                        <div>{{ Str::limit($participant->address, 50) }}</div>
                        <div class="text-muted">{{ $participant->province }}, {{ $participant->country }}</div>
                      </td>
                      <td>
                        <div class="d-flex">
                          <a href="#" class="me-2" onclick="openEditModal('{{ $participant->id }}')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg></a>
                          <a href="#" class="text-danger" onclick="deleteParticipant('{{ $participant->id }}', '{{ route('admin.participants.destroy', $participant) }}')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg></a>
                        </div>
                      </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center text-muted py-4">No participants found.</td></tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
              <div class="card-footer d-flex align-items-center">
                <p class="m-0 text-secondary">Showing <span>{{ $participants->firstItem() }}</span> to <span>{{ $participants->lastItem() }}</span> of <span>{{ $participants->total() }}</span> entries</p>
                {{ $participants->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Modal untuk Add/Edit Participant --}}
    <div class="modal modal-blur fade" id="participantModal" tabindex="-1">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalTitle"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <form id="participantForm">
            <input type="hidden" name="_method" value="POST">
            <div class="modal-body">
              <div id="validationErrors" class="alert alert-danger d-none"></div>
              <div class="row">
                <div class="col-md-6 mb-3"><label class="form-label">Name</label><input type="text" id="name" name="name" class="form-control" required></div>
                <div class="col-md-6 mb-3"><label class="form-label">Email</label><input type="email" id="email" name="email" class="form-control" required></div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3"><label class="form-label">Phone</label><input type="text" id="phone" name="phone" class="form-control"></div>
                <div class="col-md-6 mb-3"><label class="form-label">Country</label><input type="text" id="country" name="country" class="form-control"></div>
              </div>
              <div class="mb-3"><label class="form-label">Province</label><input type="text" id="province" name="province" class="form-control"></div>
              <div class="mb-3"><label class="form-label">Address</label><textarea id="address" name="address" class="form-control" rows="3"></textarea></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Save Participant</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>
    <script src="{{ asset('js/participants.js') }}"></script>
  </body>
</html>