<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    {{-- sweetalert --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Modak&display=swap" rel="stylesheet">

    {{-- tailwind config --}}
    @vite('resources/css/app.css')
    
</head>

<body class="bg-gray-100 ml-64">
    <div class="bg-blue-500">
        @yield('content')
    </div>
</body>

</html>
