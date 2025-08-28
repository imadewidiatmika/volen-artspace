<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VOLEN ARTSPACE | Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container d-flex flex-column justify-content-center align-items-center min-vh-100">
        <h1 class="volen-artspace-title text-center mb-2">VOLEN ARTSPACE</h1>
        <p class="registration-system-text text-center mb-5">REGISTRATION SYSTEM</p>

        <div class="container-custom">
            <form id="registrationForm">
                <div class="mb-3">
                    <label for="participantName" class="form-label form-label-custom">Nama :</label>
                    <input type="text" class="form-control" id="participantName" name="participantName" placeholder="Cari Nama Peserta" required>
                </div>
                
                <div id="searchResults" class="hidden mb-3">
                    <div id="loadingMessage" class="text-center hidden">
                        <div class="spinner-border text-dark" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2">Mencari...</p>
                    </div>
                    <ul id="resultsList" class="list-group">
                    </ul>
                    <p id="noResultsMessage" class="text-center mt-3 hidden">Nama tidak ditemukan.</p>
                </div>

                <div id="selectedParticipantDetails" class="hidden mb-3">
                    <div class="card p-3">
                        <div class="mb-2"><strong>Peserta :</strong> <span id="selectedName"></span></div>
                        <div class="mb-2"><strong>Aktivitas :</strong> <span id="selectedActivity"></span></div>
                    </div>
                </div>

                <div class="btn-container">
                    <button type="button" class="btn btn-back">BACK</button>
                    <button type="submit" class="btn btn-next" id="nextButton">CARI</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eP0WOxIK7R7JqmkzwP" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>
</html>