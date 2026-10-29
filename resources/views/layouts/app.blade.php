<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'KursusKu')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background-color: #f5f7fb;
            color: #1f2937;
        }

        .navbar-brand {
            font-weight: 700;
            color: #2563eb;
        }

        .navbar-brand:hover {
            color: #1d4ed8;
        }

        .navbar {
            background-color: #ffffff;
        }

        main {
            min-height: 75vh;
        }

        footer {
            background-color: #ffffff;
            color: #6b7280;
        }
    </style>

    @stack('styles')
</head>
<body>

    @include('partials.navbar')

    <main>
        <div class="container py-4">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}

                    <button type="button" class="btn-close"
                            data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <footer class="border-top py-3 mt-4">
        <div class="container text-center small">
            &copy; {{ date('Y') }} KursusKu &mdash; Platform Pendaftaran Kursus
        </div>
    </footer>

    @stack('scripts')
</body>
</html>