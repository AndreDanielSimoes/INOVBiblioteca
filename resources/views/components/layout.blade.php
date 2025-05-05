<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>INOV Library</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <div>
        <nav class="flex justify-between">
            <div>
                <a href="/">
                    <img src="{{ Vite::asset('resources/images/logo.svg') }}" alt="" class="size-10">
                </a>
            </div>

            <div>
                <a href="#">Books</a>
                <a href="#">Authors</a>
                <a href="#">Publishers</a>
            </div>

            <div>
                <a href="#">Add a Book</a>
            </div>
        </nav>
    </div>

    <main>
        {{ $slot }}
    </main>

</body>
</html>
