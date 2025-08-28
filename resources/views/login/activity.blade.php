<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VOLEN ARTSPACE | Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container d-flex flex-column justify-content-center align-items-center min-vh-100">
        <h1 class="volen-artspace-title text-center mb-2">VOLEN ARTSPACE</h1>
        <p class="registration-system-text text-center mb-5">REGISTRATION SYSTEM</p>

        <div class="container-custom"> {{-- Laravel form: method POST, action ke route 'registration.step2' --}}
            <form >
                @csrf {{-- CSRF token for Laravel security --}}

                <div class="mb-4">
                    <label for="activitySelect" class="form-label form-label-custom">Activities :</label>
                    <select class="form-select" name="activity" aria-label="Activities selection">
                        <option value="" selected disabled>Open Registration Activities</option>
                        <option value="clay_painting">Clay Painting</option>
                        <option value="pottery_class">Pottery Class</option>
                        <option value="sculpture_workshop">Sculpture Workshop</option>
                        <option value="drawing_session">Drawing Session</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="dateInput" class="form-label form-label-custom">Date :</label>
                    <select class="form-select" name="date" aria-label="Available Dates selection">
                        <option value="" selected disabled>Select Available Date</option>
                        <option value="2025-08-01">August 1, 2025</option>
                        <option value="2025-08-05">August 5, 2025</option>
                        <option value="2025-08-10">August 10, 2025</option>
                        <option value="2025-08-15">August 15, 2025</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="timeInput" class="form-label form-label-custom">Time :</label>
                    <select class="form-select" name="time" aria-label="Available Times selection">
                        <option value="" selected disabled>Select Available Time</option>
                        <option value="09:00-11:00">09:00 AM - 11:00 AM</option>
                        <option value="13:00-15:00">01:00 PM - 03:00 PM</option>
                        <option value="16:00-18:00">04:00 PM - 06:00 PM</option>
                    </select>
                </div>

                <div>
                    <div class="mb-4">
                        <p class="location-text">Location : The Patra Ubud</p>
                    </div>

                    <div class="btn-container">
                            <a href="{{ route('registration.step1') }}" class="btn btn-back">BACK</a>
                            <a href="{{ route('registration.step3') }}" class="btn btn-next">SCAN QR</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eP0WOxIK7R7JqmkzwP" crossorigin="anonymous"></script>
    <script src="js/script.js"></script> {{-- Keep this if you have other JS not related to visibility --}}
</body>
</html>