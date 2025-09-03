<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>VOLEN ARTSPACE | Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container d-flex flex-column justify-content-center align-items-center min-vh-100">
        <h1 class="volen-artspace-title text-center mb-2">VOLEN ARTSPACE</h1>
        <p class="registration-system-text text-center mb-5">REGISTRATION SYSTEM</p>

        <div class="card p-4 shadow-sm w-100" style="max-width: 600px; border: none;">
            
            <form method="POST" action="{{ route('registration.storeStep3') }}" enctype="multipart/form-data">
                @csrf
                <p class="card-title fw-bold mb-3">Bank Transfer Receipt :</p>
                
                <div id="uploadArea" class="upload-area text-center d-flex flex-column justify-content-center align-items-center mb-4">
                    <div id="uploadDefaultContent">
                        <div class="plus-icon-container mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/></svg>
                        </div>
                        <p class="text-muted">Please insert your bank transfer receipt here to complete the registration process</p>
                    </div>
                    <img id="imagePreview" src="#" alt="Image Preview" class="upload-preview d-none"/>
                </div>
                
                <input type="file" id="receiptInput" name="receipt" class="d-none" accept="image/*" required>
                @error('receipt')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <p class="small text-center mb-4">
                    Please complete by transfer to <span class="fw-bold">BCA (Bank Central Asia)</span><br>
                    account no : <span id="accountNumber" class="fw-bold">6485277068</span> (Esmeralda Purwa Kustari) for<br>
                    nominals : <span class="fw-bold">Rp.{{ number_format($registration->schedule->price, 0, ',', '.') }},-</span>
                </p>

                <div id="initialButtons" class="d-grid gap-2">
                    <button type="button" id="copyButton" class="btn btn-dark btn-lg">COPY ACCOUNT NUMBER</button>
                </div>

                <div id="finalButtons" class="btn-container d-none">
                    <a href="{{ route('registration.showStep2', $registration->schedule) }}" class="btn btn-back">BACK</a>
                    <button type="submit" class="btn btn-next">FINISH</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/registration3.js') }}"></script>
</body>
</html>