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
                <form method="GET" action="{{ route('admin.registrations.new') }}" class="d-flex">
                  <div class="input-icon me-3">
                    <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
                  </div>
                  <div class="d-flex align-items-center">
                    <select class="form-select" name="per_page" onchange="this.form.submit()" style="width: auto;">
                      <option value="15" @if(request('per_page', 15) == 15) selected @endif>15</option>
                      <option value="25" @if(request('per_page') == 25) selected @endif>25</option>
                      <option value="50" @if(request('per_page') == 50) selected @endif>50</option>
                    </select>
                    <span class="ms-2 text-secondary">records per page</span>
                  </div>
                </form>
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
                    @forelse ($registrations as $reg)
                    <tr>
                      <td>
                        <div>{{ $reg->participant->name }}</div>
                      </td>
                      <td>
                        <div>{{ $reg->participant->phone }}</div>
                      </td>
                      <td>
                        <div class="text-muted"><a href="mailto:{{ $reg->participant->email }}">{{ $reg->participant->email }}</a></div>
                      </td>
                      <td>
                        <div class="text-muted">{{ $reg->schedule->date->format('l, d M Y') }}</div>
                      </td>
                      <td>
                        {{ \Carbon\Carbon::parse($reg->schedule->time)->format('H:i') }}
                      </td>
                      <td>
                        <div><strong>{{ $reg->schedule->activity->name }}</strong></div>
                      </td>
                      <td>
                        <div class="text-muted">{{ $reg->schedule->location }}</div>
                      </td>
                      <td class="fst-italic">Rp{{ number_format($reg->schedule->price, 0, ',', '.') }}</td>
                       <td>
                        @if ($reg->receipt_path)
                          <a href="#" onclick="showEvidence('{{ asset('storage/' . $reg->receipt_path) }}')" data-bs-toggle="modal" data-bs-target="#evidenceModal">
                            <div class="receipt-thumbnail">
                              <img src="{{ asset('storage/' . $reg->receipt_path) }}" alt="Receipt">
                            </div>
                          </a>
                        @else
                          <span class="text-muted">N/A</span>
                        @endif
                      </td>
                      <td>
                        <span class="badge bg-{{ $reg->status === 'LISTED' ? 'info' : 'warning' }}-lt">{{ str_replace('_', ' ', $reg->status) }}</span>
                      </td>
                      <td>
                        {{-- Logika untuk tombol bisa ditambahkan di sini --}}
                        <button class="btn btn-secondary btn-sm" disabled>Send Ticket</button>
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="7" class="text-center text-muted py-4">No new registrations found.</td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>

              <!-- ✅ FOOTER PAGINATION -->
<div class="card-footer d-flex align-items-center">
                <p class="m-0 text-secondary">Showing <span>{{ $registrations->firstItem() }}</span> to <span>{{ $registrations->lastItem() }}</span> of <span>{{ $registrations->total() }}</span> entries</p>
                {{ $registrations->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


               <div class="modal modal-blur fade" id="evidenceModal" tabindex="-1">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header"><h5 class="modal-title">Evidence Preview</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
          <div class="modal-body text-center p-2"><img id="modalEvidenceImage" src="" alt="Evidence Full" class="img-fluid rounded"></div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>
            <script>
      function showEvidence(src) {
        document.getElementById('modalEvidenceImage').src = src;
      }
    </script>
  </body>
</html>
