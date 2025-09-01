<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VOLEN ARTSPACE | Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .hidden { display: none; } /* Helper class */
        .spinner-border { width: 1.5rem; height: 1.5rem; }
    </style>
</head>
<body>
    <div class="container d-flex flex-column justify-content-center align-items-center min-vh-100">
        <h1 class="volen-artspace-title text-center mb-2">VOLEN ARTSPACE</h1>
        <p class="registration-system-text text-center mb-5">REGISTRATION SYSTEM</p>

        <div class="container-custom">
            <form id="registrationForm" 
                data-get-dates-url="{{ route('registration.getDates') }}" 
                data-get-times-url="{{ route('registration.getTimes') }}"
                data-next-step-base-url="{{ url('/registration/step2') }}">

                {{-- Dropdown Aktivitas --}}
                <div class="mb-4">
                    <label for="activitySelect" class="form-label form-label-custom">Activities :</label>
                    <select class="form-select" id="activitySelect" name="activity_id">
                        <option value="" selected disabled>Select Activity</option>
                        @foreach ($activities as $activity)
                            <option value="{{ $activity->id }}">{{ $activity->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Dropdown Tanggal (awalnya disembunyikan) --}}
                <div id="dateWrapper" class="mb-4 hidden">
                    <label for="dateSelect" class="form-label form-label-custom">Date :</label>
                    <select class="form-select" id="dateSelect" name="date"></select>
                </div>

                {{-- Dropdown Waktu (awalnya disembunyikan) --}}
                <div id="timeWrapper" class="mb-4 hidden">
                    <label for="timeSelect" class="form-label form-label-custom">Time :</label>
                    <select class="form-select" id="timeSelect" name="schedule_id"></select>
                </div>
                
                {{-- Loader/Spinner --}}
                <div id="loader" class="text-center mb-4 hidden">
                    <div class="spinner-border text-secondary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>

                {{-- Detail Lokasi & Harga (awalnya disembunyikan) --}}
                <div id="detailsWrapper" class="hidden">
                    <div class="mb-2">
                        <p id="locationText" class="location-text mb-1"><strong>Location:</strong> <span></span></p>
                        <p id="priceText" class="location-text"><strong>Price:</strong> IDR <span></span></p>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                         <a href="#" id="nextButton" class="btn btn-dark btn-lg">NEXT</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>