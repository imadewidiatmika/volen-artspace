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
        <div class="container-custom">
            <form>
                <div class="mb-4 text-start">
                    <label for="nameInput" class="form-label form-label-custom">Name :</label>
                    <input type="text" class="form-control" id="nameInput" name="name" placeholder="Enter Your Name">
                    <div class="invalid-feedback">
                        Name is required.
                    </div>
                </div>

                <div class="mb-4 text-start">
                    <label for="emailInput" class="form-label form-label-custom">Email Address :</label>
                    <input type="email" class="form-control" id="emailInput" name="email" placeholder="Enter Email Address">
                    <div class="invalid-feedback">
                        Email Address is required.
                    </div>
                </div>

                <div class="mb-4 text-start">
                    <label for="whatsappInput" class="form-label form-label-custom">Phone Number (Whatsapp) :</label>
                    <div class="input-group">
                        <select class="form-select" id="countryCodeSelect" name="country_code" style="max-width: 120px;"></select>
                        <input type="tel" class="form-control" id="whatsappInput" name="whatsapp" placeholder="Enter Whatsapp Number">
                    </div>
                    <div class="invalid-feedback">
                        Whatsapp Number is required.
                    </div>
                </div>
                <div class="btn-container">
                    <a href="{{ route('registration.step1') }}" class="btn btn-back">BACK</a>
                    <a href="{{ route('registration.step3') }}" class="btn btn-next">NEXT</a>
                </div>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eP0WOxIK7R7JqmkzwP" crossorigin="anonymous"></script>
        
        <script src="js/countries.js"></script>
    </body>
</html>