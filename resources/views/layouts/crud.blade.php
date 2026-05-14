<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>@yield('title', 'CRUD Laravel')</title>
    {{-- AQUI ESTAVA O PROBLEMA: Faltava o resources/js/app.js abaixo --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-100 dark:bg-gray-900">
    
    <div class="min-h-screen flex">

        <aside class="w-64 bg-gray-900 text-white min-h-screen p-4">
            <h1 class="text-2xl font-bold mb-6">Admin</h1>
            <nav class="space-y-2">
                <a href="{{ url('/') }}" class="block rounded px-4 py-2 hover:bg-gray-800">
                    Dashboard
                </a>
                <a href="{{ url('products') }}" class="block rounded px-4 py-2 hover:bg-gray-800">
                    Produtos
                </a>
                <a href="{{ url('types') }}" class="block rounded px-4 py-2 hover:bg-gray-800">
                    Tipos
                </a>
                <a href="{{ url('suppliers') }}" class="block rounded px-4 py-2 hover:bg-gray-800">
                    Fornecedores
                </a>
            </nav>
        </aside>
        
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>
</body>

</html>