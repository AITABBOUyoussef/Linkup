<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LinkUp - Le Réseau Professionnel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans">

    <nav class="bg-white shadow-md fixed w-full z-10 top-0">
        <div class="max-w-5xl mx-auto px-4 py-3 flex justify-between items-center">
            <div class="text-2xl font-extrabold text-blue-700 tracking-tight">
                LinkUp
            </div>
            <div>
                <a href="/feed" class="text-gray-600 hover:text-blue-700 font-semibold transition">Accueil (Feed)</a>
            </div>
        </div>
    </nav>

    <main class="max-w-2xl mx-auto pt-24 pb-10 px-4">
        @yield('content')
    </main>

</body>
</html>
