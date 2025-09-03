<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Registrants of Activities</title>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler-vendors.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/tabler.css') }}">
  </head>
  <body class="theme-dark">
    <div class="page">
      <x-aside />
      <div class="page-wrapper">
        <div class="container-fluid">
                   {{-- Header dengan Search dan Records Per-Page --}}
          <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
              <div class="col">
                <h2 class="page-title">Registrants of Activities</h2>
              </div>
              <div class="col-auto ms-auto d-print-none">
                <div class="d-flex">
                  <div class="me-3">
                    <div class="input-icon">
                      <input type="text" id="searchInput" class="form-control" placeholder="Search by name/email...">
                    </div>
                  </div>
                  <div class="btn-list d-flex align-items-center me-3">
                    <select class="form-select" id="perPageSelect" style="width: auto;">
                      <option value="15">15</option>
                      <option value="25">25</option>
                      <option value="50">50</option>
                    </select>
                    <span class="ms-2 text-secondary">Records per-page</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
                    <div id="registrants-filter-card" class="card card-body mb-4"
                data-get-dates-url="{{ route('admin.api.registrants.getDates') }}"
                data-get-times-url="{{ route('admin.api.registrants.getTimes') }}"
                data-get-data-url="{{ route('admin.api.registrants.getData') }}">
            <div class="row g-3">

          {{-- Filter Card --}}
          <div class="card mb-4">
            <div class="card-body">
              <div class="row g-3">
                <div class="col-md-4 text-dark">
                  <label class="form-label">Activity</label>
                  <select class="form-select text-dark bg-white" id="activitySelect">
                    <option value="" selected disabled>Select Activity</option>
                    @foreach($activities as $activity)
                      <option value="{{ $activity->id }}">{{ $activity->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-4 text-dark">
                  <label class="form-label">Date</label>
                  <select class="form-select text-dark bg-white" id="dateSelect" disabled></select>
                </div>
                <div class="col-md-4 text-dark">
                  <label class="form-label">Time</label>
                  <select class="form-select text-dark bg-white" id="timeSelect" disabled></select>
                </div>
                <div class="col-md-4 text-dark">
                  <label class="form-label">Location</label>
                  <div id="locationText" class="form-control-plaintext ps-1 text-dark">-</div>
                </div>
                <div class="col-md-4 text-dark">
                  <label class="form-label">Status</label>
                  <div id="statusText" class="form-control-plaintext ps-1 text-dark">-</div>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                  <button id="seeAttendantsButton" class="btn btn-dark w-100" disabled>See Attendants</button>
                </div>
              </div>
            </div>
          </div>

          {{-- Tabel Pendaftar --}}
          <div class="page-body">
            <div class="card">
              <div class="table-responsive">
                <table class="flat-table table">
                  <thead>
                    <tr>
                      <th>Participant ID</th><th>Name</th><th>Ph.</th><th>Email</th><th>Country</th><th>Prtcp. Remark</th><th>Receipt</th><th>Status</th>
                    </tr>
                  </thead>
                  <tbody id="registrants-table-body">
                    <tr><td colspan="8" class="text-center text-muted">Please select a schedule to see attendants.</td></tr>
                  </tbody>
                </table>
              </div>
              <div class="card-footer d-flex align-items-center">
                <p id="pagination-info" class="m-0 text-secondary">Showing 0 entries</p>
                <div id="pagination-links" class="ms-auto"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Modal untuk melihat bukti transfer --}}
    <div class="modal fade" id="evidenceModal" tabindex="-1">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Transfer Receipt</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body text-center">
            <img id="modalEvidenceImage" src="" alt="Receipt" class="img-fluid">
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>
    <script src="{{ asset('js/registrant.js') }}"></script>
  </body>
</html>