<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Search</title>
</head>

<body>
    <x-navbar :categories="$categories" />
    <x-search></x-search>
    <div class="items-center justify-center grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6 py-1 pt-4">
    @foreach ($products as $product)
    <x-card :product="$product" :categories="$categories" />
    @endforeach
    </div>
</body>

</html>