<!DOCTYPE html>
<html lang="en" class="font-sans antialiased">

<head>
    <!-- Meta Information -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Scopic - Auction application</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Passion+One&display=swap" rel="stylesheet">

    <!-- Style sheets-->
    <link href='{{ mix('css/app.css') }}' rel='stylesheet' type='text/css'>
</head>

<body style="font-family: Poppins">

    <div id="app"></div>

    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
