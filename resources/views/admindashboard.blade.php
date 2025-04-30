<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/css/app.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script type="module" src="/node_modules/alpinejs/dist/cdn.js"></script>
</head>

<body x-data="{ sidebarOpen: true }" class="relative">
    <x-sidebar></x-sidebar>
    <div
        class="transition-all duration-300 p-4"
        :class="sidebarOpen ? 'pl-52' : 'pl-12'">
        <h1 class="text-2xl pt-20 font-bold">Konten Utama</h1>
        <p>Ini adalah area konten utama.</p>
    </div>
</body>

</html>