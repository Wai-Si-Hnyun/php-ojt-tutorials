<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Students Management</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <header class="bg-light">
        <div class="container d-flex justify-content-between">
            <h1 class="fs-3 mt-2">Home</h1>
            <nav class="pt-3">
                <ul class="d-flex list-unstyled">
                    <li>
                        <a class="text-decoration-none 
                            {{ Request::is('students*') ? 'text-dark' : 'text-secondary' }}"
                            href="{{ route('students.index') }}">Students</a>
                    </li>
                    <li class="ms-3">
                        <a class="text-decoration-none 
                            {{ Request::is('majors*') ? 'text-dark' : 'text-secondary' }}"
                            href="{{ route('majors.index') }}">Majors</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        @yield('content')
    </main>
    @stack('scripts')
</body>

</html>
