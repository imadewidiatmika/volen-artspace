<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>VOLEN ARTSPACE | Registration</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    <body>
        <div class="container d-flex flex-column justify-content-center align-items-center min-vh-100">
             <h1 class="volen-artspace-title text-center mb-2">VOLEN ARTSPACE</h1>
             <p class="registration-system-text text-center mb-5">REGISTRATION SYSTEM</p>
        <div class="container-custom">
            {{-- Ringkasan Jadwal yang Dipilih --}}
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">{{ $schedule->activity->name }}</h5>
                    <p class="card-text mb-1">
                        <strong>Date:</strong> {{ $schedule->date->format('d F Y') }} <br>
                        <strong>Time:</strong> {{ \Carbon\Carbon::parse($schedule->time)->format('H:i') }} WITA <br>
                        <strong>Location:</strong> {{ $schedule->location }}
                    </p>
                </div>
            </div>

            {{-- Ganti form menjadi POST ke route storeStep2 --}}
            <form method="POST" action="{{ route('registration.storeStep2') }}">
                @csrf
                <div class="mb-3 text-start">
                    <label for="nameInput" class="form-label form-label-custom">Name :</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="nameInput" name="name" placeholder="Enter Your Name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 text-start">
                    <label for="emailInput" class="form-label form-label-custom">Email Address :</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="emailInput" name="email" placeholder="Enter Email Address" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4 text-start">
                    <label for="whatsappInput" class="form-label form-label-custom">Phone Number (Whatsapp) :</label>
                    <div class="input-group">
                        <select class="form-select" id="countryCodeSelect" name="country_code" style="max-width: 120px;"></select>
                        <input type="tel" class="form-control @error('whatsapp') is-invalid @enderror" id="whatsappInput" name="whatsapp" placeholder="81234567890" value="{{ old('whatsapp') }}" required>
                    </div>
                    @error('whatsapp')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                    @error('country_code')
                         <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="btn-container">
                    {{-- Tombol BACK kembali ke halaman registrasi awal --}}
                    <a href="{{ route('registration') }}" class="btn btn-back">BACK</a>
                    {{-- Ganti <a> menjadi <button type="submit"> --}}
                    <button type="submit" class="btn btn-next">NEXT</button>
                </div>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        {{-- Pastikan file ini ada di public/js/countries.js --}}
        <script src="{{ asset('js/countries.js') }}"></script>
    </body>
</html>