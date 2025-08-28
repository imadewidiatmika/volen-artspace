<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VOLEN ARTSPACE | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container d-flex flex-column justify-content-center align-items-center min-vh-100">
        <h1 class="volen-artspace-title text-center mb-2">VOLEN ARTSPACE</h1>
        <p class="registration-system-text text-center mb-5">LOGIN</p>

        <div class="container-custom"> {{-- Laravel form: method POST, action ke route 'registration.step2' --}}
            <form >
                @csrf {{-- CSRF token for Laravel security --}}
                <div class="mb-4 text-start">
                    <label for="userInput" class="form-label form-label-custom">User :</label>
                    <input type="text" class="form-control" name="user" placeholder="Open Registration Activities">
                    <div class="invalid-feedback">
                        Username is required.
                    </div>
                </div>

                <div class="mb-4 text-start">
                    <label for="passInput" class="form-label form-label-custom">Password :</label>
                    <input type="password" class="form-control" name="password" placeholder="Open Registration Activities">
                    <div class="invalid-feedback">
                        Password is required.
                    </div>
                </div>
                 <div class="d-grid gap-2">
                         <a href="" class="btn btn-dark btn-lg ">LOGIN</a>
                 </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eP0WOxIK7R7JqmkzwP" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>
</html>