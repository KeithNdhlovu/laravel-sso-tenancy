<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Information -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Passport {{ config('app.name') ? ' - ' . config('app.name') : '' }}</title>
    @vite(['resources/sass/app.scss'])
</head>

<body>
    <div id="app">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Clients Dashboard</div>

                        <div id="app" class="card-body">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @vite(['resources/js/app.js'])
</body>

</html>
