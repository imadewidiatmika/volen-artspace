<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Detail Attendance</title>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler-vendors.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="css/tabler.css">
    <style>
      .section-title {
        background-color: #f8f9fa;
        font-weight: bold;
        padding: 8px 16px;
        border-top: 1px solid #dee2e6;
        border-bottom: 1px solid #dee2e6;
      }
      .gray-header {
        background-color: #dee2e6;
        font-weight: 600;
      }
      .validated {
        color: green;
        font-weight: bold;
      }
      .card-body-title {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
      }
    </style>
  </head>

  <body class="theme-dark">
    <div class="page">
      <x-aside />
      <!-- ✅ KONTEN -->
      <div class="page-wrapper">
        <div class="container-fluid">
          <div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col-auto ms-auto d-print-none">
                <div class="d-flex flex-wrap align-items-center">
                  <div class="input-icon me-3">
                    <input type="text" class="form-control" placeholder="Search keywords..." aria-label="Search keywords">
                    <span class="input-icon-addon">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                        <path d="M21 21l-6 -6" />
                      </svg>
                    </span>
                  </div>
                  <div class="btn-list d-flex align-items-center me-3">
                    <select class="form-select-sm w-auto me-2" id="recordsPerPage">
                      <option value="10">10</option>
                      <option value="15" selected>15</option>
                      <option value="25">25</option>
                      <option value="50">50</option>
                    </select>
                    <span class="text-secondary">Records per-page</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

<!-- ✅ FILTER CARD -->
<div class="card mb-4">
  <div class="card-body">
    <div class="row g-3">
      <div class="col-md-4 text-dark">
        <label class="form-label">Activity</label>
        <select class="form-select bg-white text-dark">
          <option selected>Clay Painting</option>
        </select>
      </div>
      <div class="col-md-4 text-dark">
        <label class="form-label">Date</label>
        <select class="form-select bg-white text-dark">
          <option selected>Wednesday, 30/06/2025</option>
        </select>
      </div>
      <div class="col-md-4 text-dark">
        <label class="form-label">Time</label>
        <select class="form-select bg-white text-dark">
          <option selected>12.00 WIB</option>
        </select>
      </div>
      <div class="col-md-4">
        <label class="form-label text-dark">Location</label>
        <div class="form-control-plaintext ps-1 text-dark">The Patra Exquisite Ubud - Bali</div>
      </div>
      <div class="col-md-4">
        <label class="form-label text-dark">Status</label>
        <div class="form-control-plaintext ps-1 text-dark">Succeed</div>
      </div>
      <div class="col-md-4 d-flex align-items-end">
        <button class="btn btn-dark w-100">See Attendants</button>
      </div>
    </div>
  </div>
</div>


          
          <!-- ✅ TABEL ATTENDED REGISTRANT -->
          <h1 class="text-dark fst-italic">ATTENDED REGISTRANT</h1>
          <div class="page-body">
            <div class="card">
              <div class="table-responsive">
                <table class="flat-table table">
        <thead>
          <tr>
            <th>Participant ID</th>
            <th>Name</th>
            <th>Ph.</th>
            <th>Email</th>
            <th>Country</th>
            <th>Prtcp. Remark</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>6AA34370-AD2A-4DF2-BF9E-4CFD255630B6</td>
            <td>Emily Putri Diani Novita Dewi</td>
            <td>0895341115908</td>
            <td>emilysimilikiti@gmail.com</td>
            <td>Indonesia</td>
            <td class="text-uppercase">First-Timer</td>
            <td><span class="text-success fw-bold">Validated</span></td>
          </tr>
        </tbody>
      </table>
              </div>

              <!-- ✅ FOOTER PAGINATION -->
              <div class="card-footer d-flex align-items-center">
                <p class="m-0 text-secondary">Showing 1 to 15 of 15 entries</p>
                <ul class="pagination m-0 ms-auto">
                  <li class="page-item active"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">4</a></li>
                  <li class="page-item"><a class="page-link" href="#">›</a></li>
                </ul>
              </div>
            </div>
          </div>

           <!-- ✅ TABEL UNATTENDED REGISTRANT -->
          <h1 class="text-dark fst-italic">UNATTENDED REGISTRANT</h1>
          <div class="page-body">
            <div class="card">
              <div class="table-responsive">
              <table class="flat-table table">
        <thead>
          <tr>
            <th>Participant ID</th>
            <th>Name</th>
            <th>Ph.</th>
            <th>Email</th>
            <th>Country</th>
            <th>Prtcp. Remark</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>6AA34370-AD2A-4DF2-BF9E-4CFD255630B6</td>
            <td>Emily Putri Diani Novita Dewi</td>
            <td>0895341115908</td>
            <td>emilysimilikiti@gmail.com</td>
            <td>Indonesia</td>
            <td class="text-uppercase">First-Timer</td>
            <td><span class="text-success fw-bold">Validated</span></td>
          </tr>
        </tbody>
      </table>
              </div>

              <!-- ✅ FOOTER PAGINATION -->
              <div class="card-footer d-flex align-items-center">
                <p class="m-0 text-secondary">Showing 1 to 15 of 15 entries</p>
                <ul class="pagination m-0 ms-auto">
                  <li class="page-item active"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">4</a></li>
                  <li class="page-item"><a class="page-link" href="#">›</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>
    <script src="js/script.js"></script>
  </body>
</html>
