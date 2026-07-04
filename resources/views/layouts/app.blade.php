<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name', 'CihuyFootwear') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="/css/landing.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/cihuylogo.svg') }}">
    @stack('styles')
</head>
<body class="bg-white text-body">
    @include('sections.header')

    <div class="container-fluid p-0">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) entry.target.classList.add('visible');
                });
            }, { threshold: 0.1 });
            document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el));
        });
    </script>
</body>
</html>