<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineStore - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#050a12] text-white font-sans min-h-screen">

    <div class="flex">
        <aside class="w-64 bg-black min-h-screen border-r border-gray-800 p-6">
            <h1 class="text-xl font-black text-white uppercase italic tracking-tighter mb-10">
                Cine<span class="text-yellow-400">Store</span>
            </h1>
            <nav class="space-y-4">
                <a href="{{ route('home') }}" class="block text-[10px] font-black uppercase tracking-widest text-gray-500 hover:text-yellow-400 transition">Ver Loja</a>
                <a href="/products" class="block text-[10px] font-black uppercase tracking-widest text-yellow-400">Produtos</a>
                <a href="#" class="block text-[10px] font-black uppercase tracking-widest text-gray-500 hover:text-yellow-400 transition">Tipos</a>
            </nav>
        </aside>

        <main class="flex-1 p-10">
            <div class="max-w-6xl mx-auto">
                
                <div class="flex justify-between items-end mb-10">
                    <h2 class="text-3xl font-black uppercase tracking-tighter border-l-4 border-yellow-400 pl-4">Produtos</h2>
                    <div class="flex gap-4">
                        <a href="{{ route('products.report') }}" class="px-6 py-2 border border-gray-700 text-[10px] font-black uppercase tracking-widest hover:bg-white hover:text-black transition">Relatório</a>
                        <a href="{{ url('products/new') }}" class="px-6 py-2 bg-yellow-400 text-black text-[10px] font-black uppercase tracking-widest hover:bg-white transition">Cadastrar</a>
                    </div>
                </div>

                <div class="bg-[#0b121f] border border-gray-800 shadow-2xl rounded-sm overflow-hidden">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-black border-b border-gray-800">
                                <th class="p-5 text-[10px] font-black uppercase tracking-widest text-gray-500">Imagem</th>
                                <th class="p-5 text-[10px] font-black uppercase tracking-widest text-gray-500">Nome</th>
                                <th class="p-5 text-[10px] font-black uppercase tracking-widest text-gray-500">Preço</th>
                                <th class="p-5 text-[10px] font-black uppercase tracking-widest text-gray-500 text-center">Qtd</th>
                                <th class="p-5 text-[10px] font-black uppercase tracking-widest text-gray-500">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-800">
                            @foreach($products as $product)
                            <tr class="hover:bg-yellow-400/5 transition">
                                <td class="p-5">
                                    <img src="{{ asset('storage/' . $product->image) }}" class="w-12 h-16 object-cover border border-gray-800">
                                </td>
                                <td class="p-5 font-bold text-sm uppercase">{{ $product->name }}</td>
                                <td class="p-5 text-sm font-black text-yellow-400">R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                                <td class="p-5 text-center text-sm font-mono">{{ $product->quantity }}</td>
                                <td class="p-5 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ url('/products/update/'.$product->id) }}" class="bg-gray-800 hover:bg-white hover:text-black px-3 py-2 text-[9px] font-black uppercase transition">Editar</a>
                                        <a href="{{ url('/products/delete/'.$product->id) }}" class="bg-red-900/20 text-red-500 hover:bg-red-600 hover:text-white px-3 py-2 text-[9px] font-black uppercase transition">Excluir</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </main>
    </div>

</body>
</html>