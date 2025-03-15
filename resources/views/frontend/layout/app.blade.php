<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />

    @stack('midtrans-css')

    <style>
         .import {
            display: none;
            transition: transform 0.5s ease-in-out; /* Transisi untuk efek muncul */
            transform: translateX(100%); /* Mulai dari kanan */
        }

        .import.active {
            display: block;
            transform: translateX(0); /* Muncul dari kanan ke kiri */
        }
    </style>

    @stack('css')

  
    <title>{{ $title }}</title>
</head>
<body>
    
    @include('frontend.partials.header')

    <div class="container">
        <!-- START FORM -->
        <div class="my-3">
            @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ Session::get('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>    
            @endif
            @if(Session::has('success-danger'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ Session::get('success-danger') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>    
            @endif
        </div>

        @yield('content')

      
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    @stack('js')
</body>
</html>