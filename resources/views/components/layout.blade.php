<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>INOV Library</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-800 text-white font-hanken-grotesk mb-10">
<div class="px-10">
    <nav class="relative flex items-center bg-gray-800 py-4 border-b border-white/30">
        <div class="absolute left-10">
            <a href="/">
                <img src="{{ Vite::asset('resources/images/logo.svg') }}" alt="" class="size-10">
            </a>
        </div>

        <div class="mx-auto space-x-6 font-bold text-xl">
            <a href="/">Books</a>
            <a href="/authors">Authors</a>
            <a href="/publishers">Publishers</a>
        </div>

        @auth
            <div class="absolute right-10 space-x-6 font-bold flex items-center">
                <a href="/dashboard">Dashboard</a>

                <form method="POST" action="/logout">
                    @csrf

                    <button>Log Out</button>
                </form>
            </div>


        @endauth

        @guest
            <div class=" absolute right-10 space-x-6 font-hanken-grotesk">
                <a href="{{ route('login') }}" class="hover:font-bold">Log In</a>
                <a href="{{ route('register') }}" class="hover:font-bold">Register</a>
            </div>
        @endguest
    </nav>

    <main class="mt-10 max-w-[986px] mx-auto">
        {{ $slot }}
    </main>
</div>
</body>
</html>
