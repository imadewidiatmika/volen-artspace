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

        <div class="container-custom">
            {{-- Formulir login yang menargetkan rute login.authenticate --}}
            <form method="POST" action="{{ route('login.authenticate') }}">
                @csrf

                {{-- Input untuk name --}}
                <div class="mb-4 text-start">
                    <label for="userInput" class="form-label form-label-custom">Username :</label>
                    <input type="text" class="form-control" name="name" id="userInput" value="{{ old('name') }}" required autofocus placeholder="Masukkan Username Anda">
                    @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Input untuk password --}}
                <div class="mb-4 text-start">
                    <label for="passInput" class="form-label form-label-custom">Password :</label>
                    <input type="password" class="form-control" name="password" id="passInput" required placeholder="Masukkan Password Anda">
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-dark btn-lg">LOGIN</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eP0WOxIK7R7JqmkzwP" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>
</html>