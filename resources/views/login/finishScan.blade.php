<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VOLEN ARTSPACE | Scan Result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container d-flex flex-column justify-content-center align-items-center min-vh-100">
        
            <h1 class="volen-artspace-title text-center mb-2">VOLEN ARTSPACE</h1>
            <p class="registration-system-text text-center mb-5">SCAN TICKET QR CODE</p>
        <div class="container-custom">
            <div class="participant-details-wrapper mb-5">
                <p class="participant-detail-text">Participant : Meyza Patricia</p>
                <p class="participant-detail-text">Activity : Clay Painting</p>
                <p class="participant-detail-text">Date : Sunday, 03/08/2025</p>
                <p class="participant-detail-text">Time : 10.00 WITA</p>
            </div>

            <div class="d-grid"> {{-- Using d-grid for full width button, centered if needed by child --}}
                <button type="submit" class="btn btn-dark btn-set-attendance p-3">SET ATTENDANCE</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eP0WOxIK7R7JqmkzwP" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>
</html>