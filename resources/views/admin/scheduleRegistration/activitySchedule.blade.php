<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Activity Scheduling</title>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler-vendors.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="css/tabler.css">
  </head>

  <body class="theme-dark">
    <div class="page">
      <x-aside />
      <!-- ✅ KONTEN -->
      <div class="page-wrapper">
        <div class="container-fluid">
          <div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col-auto">
                <a href="#" class="btn btn-primary d-none d-sm-inline-block">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M12 5l0 14" />
                    <path d="M5 12l14 0" />
                  </svg>
                  ADD NEW SCHEDULE
                </a>
              </div>
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

          <!-- ✅ TABEL BARU -->
          <div class="page-body">
            <div class="card">
              <div class="table-responsive">
                <table class="flat-table">
                  <thead>
                    <tr>
                      <th>DATE</th>
                      <th>TIME</th>
                      <th>ACTIVITY</th>
                      <th>LOCATION</th>
                      <th>PRICE</th>
                      <th>REG. PRTCP.</th>
                      <th>ATT. PRTCP.</th>
                      <th>STATUS</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Saturday, 02/07/2025</td>
                      <td>10.00 WITA</td>
                      <td>Clay Pottery Painting Basic</td>
                      <td>The Patra Exquisite - Ubud, Bali</td>
                      <td>550,000</td>
                      <td><a href="#" class="text-primary">0</a></td>
                      <td><a href="#" class="text-primary">0</a></td>
                      <td><span class="badge bg-green-lt">Open Registration</span></td>
                      <td>
                        <a href="#" ><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="blue"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg></a>
                        <a href="#" class="text-danger"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="red"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg></a>
                      </td>
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
  </body>
</html>
