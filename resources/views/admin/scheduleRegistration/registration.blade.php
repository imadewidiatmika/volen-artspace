<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>New Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler-vendors.min.css" rel="stylesheet"/>
      <link rel="stylesheet" href="{{ asset('css/tabler.css') }}">
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

          <!-- ✅ TABEL BARU -->
          <div class="page-body">
            <div class="card">
              <div class="table-responsive">
                <table class="flat-table">
                  <thead>
                    <tr>
                      <th>NAME</th>
                      <th>WHATSAPP</th>
                      <th>EMAIL</th>
                      <th>DATE</th>
                      <th>TIME</th>
                      <th>ACTIVITY</th>
                      <th>LOCATION</th>
                      <th>PRICE</th>
                      <th>EVIDENCE</th>
                      <th>STATUS</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Megawati</td>
                      <td>0861231</td>
                      <td>MegawatiP@gmail.com</td>
                      <td>Saturday,02/07/2025</td>
                      <td>10.00 WITA</td>
                      <td>Clay Poettery Painting Basic</td>
                      <td>The Patra Exquisite - Ubud, Bali</td>
                      <td class="fst-italic">550,000</td>
                       <td>
                        <a href="#" onclick="showEvidence('/images/evidence/nota1.jpg')" data-bs-toggle="modal" data-bs-target="#evidenceModal">
                          <div style="width: 80px; height: 80px; overflow: hidden; border-radius: 4px; cursor: pointer;">
                            <img src="/images/evidence/nota1.jpg" alt="Evidence" class="img-fluid w-100 h-100 object-fit-cover">
                          </div>
                        </a>
                      </td>
                      <td><a href="#" class="text-info fw-bold">LISTED</a></td>
                      <td>
                        <button class="btn btn-secondary btn-sm" disabled>Send Ticket</button>
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

     <div class="modal fade" id="evidenceModal" tabindex="-1" aria-labelledby="evidenceModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content text-light">
          <div class="modal-header">
            <h1 class="modal-title" id="evidenceModalLabel">Evidence Preview</h1>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-center">
            <img id="modalEvidenceImage" src="" alt="Evidence Full" class="img-fluid rounded">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <a id="downloadEvidenceBtn" href="#" download class="btn btn-success">Download Evidence</a>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>
  </body>
</html>
