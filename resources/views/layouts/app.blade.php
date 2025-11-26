<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Account System</title>
@vite('resources/css/app.css')
<link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.0/dist/flowbite.min.css" rel="stylesheet">

<style>
    /* Glass Card / Table / Modal / Form Override */
    .glass-card,
    .bg-white,
    .shadow-sm,
    .rounded-2xl,
    .rounded-xl,
    .p-4, .p-6 {
        background-color: rgba(255,255,255,0.05) !important;
        backdrop-filter: blur(12px) !important;
        border: 1px solid rgba(255,255,255,0.07) !important;
        color: #e5e7eb !important;
    }

    th, td {
        background-color: rgba(255,255,255,0.05) !important;
    }

    /* Buttons glass */
    .btn-glass {
        background-color: rgba(255,255,255,0.05);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255,255,255,0.1);
        color: #fff;
        transition: all 0.3s ease;
    }
    .btn-glass:hover {
        background-color: rgba(255,255,255,0.15);
    }

    /* Input glass */
    input, select, textarea {
        background-color: rgba(255,255,255,0.05) !important;
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255,255,255,0.1) !important;
        color: #e5e7eb !important;
    }
    input:focus, select:focus, textarea:focus {
        border-color: rgba(99,102,241,0.7);
        outline: none;
        ring: none;
    }
</style>
</head>
<body class="font-sans min-h-screen relative bg-slate-950 text-white">

<!-- Line Gradient Background -->
<div class="absolute inset-0 -z-10 
    bg-[linear-gradient(to_right,#4f4f4f2e_1px,transparent_1px),
        linear-gradient(to_bottom,#4f4f4f2e_1px,transparent_1px)]
    bg-[size:14px_24px]"></div>

<!-- Navbar -->
<nav class="backdrop-blur-xl bg-white/5 border-b border-white/10 p-4 mb-6 flex justify-between items-center rounded-xl container mx-auto mt-4">
    <a href="{{ route('dashboard') }}" class="text-2xl font-bold hover:text-indigo-300 transition">Account Management System</a>
    <div class="flex gap-3">
        <a href="{{ route('categories.index') }}" class="btn-glass px-4 py-2 rounded-lg">Categories</a>
        <a href="{{ route('incomes.index') }}" class="btn-glass px-4 py-2 rounded-lg text-green-300 border-green-400/20">Incomes</a>
        <a href="{{ route('expenses.index') }}" class="btn-glass px-4 py-2 rounded-lg text-red-300 border-red-400/20">Expenses</a>
    </div>
</nav>

<div class="container mx-auto px-4">
    @if(session('success'))
    <div class="mb-6">
        <div class="flex items-center backdrop-blur-xl bg-green-500/10 border border-green-500/20 text-green-200 px-4 py-3 rounded-lg shadow-lg">
            <svg class="w-6 h-6 mr-2 fill-current"><path d="M20.285 6.709l-11.39 11.392-5.657-5.656 1.414-1.414 4.243 4.242 9.976-9.978z"/></svg>
            <span>{{ session('success') }}</span>
        </div>
    </div>
    @endif

    <div class="glass-card p-6 rounded-xl shadow-xl">
        @yield('content')
    </div>
</div>
<!-- app.blade.php bottom, before </body> -->
<script>
document.querySelectorAll("[command='show-modal']").forEach(btn => {
    btn.addEventListener("click", () => {
        let id = btn.getAttribute("commandfor");
        let dialog = document.getElementById(id);
        dialog.classList.remove("hidden");
        dialog.showModal();
    });
});

document.querySelectorAll("[data-close]").forEach(btn => {
    btn.addEventListener("click", () => {
        let id = btn.getAttribute("data-close");
        let dialog = document.getElementById(id);
        dialog.close();
        dialog.classList.add("hidden");
    });
});
</script>


<script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.0/dist/flowbite.min.js"></script>
</body>
</html>
