<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account System</title>
    @vite('resources/css/app.css')
    {{-- Bootstarp css link --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"> --}}

</head>
<body class="font-sans bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-white shadow p-4 mb-6 flex justify-between items-center">
        <a class="text-xl font-bold" href="{{ route('dashboard') }}">Account System</a>
        <div class="flex gap-2">
            <a class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300" href="{{ route('categories.index') }}">Categories</a>
            <a class="px-3 py-1 bg-green-200 rounded hover:bg-green-300" href="{{ route('incomes.index') }}">Incomes</a>
            <a class="px-3 py-1 bg-red-200 rounded hover:bg-red-300" href="{{ route('expenses.index') }}">Expenses</a>
        </div>
    </nav>

    <div class="container mx-auto px-4">
        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>
      {{-- Bootstarp js link --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> --}}
</body>
</html>
