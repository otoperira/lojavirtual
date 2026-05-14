<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineStore - Relatório de Acervo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#050a12] text-white font-sans">

    <header class="bg-black p-6 border-b border-gray-800 shadow-xl">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-black text-white uppercase italic tracking-tighter">
                Cine<span class="text-yellow-400">Store</span> <span class="text-gray-600 text-sm normal-case ml-2">/ Relatórios</span>
            </h1>
            <a href="/" class="text-[10px] font-black uppercase tracking-widest bg-white text-black px-4 py-2 hover:bg-yellow-400 transition">
                Voltar à Loja
            </a>
        </div>
    </header>

    <main class="py-12 px-6">
        <div class="max-w-7xl mx-auto">
            
            <div class="bg-[#0b121f] border border-gray-800 p-8 mb-8 shadow-2xl rounded-sm">
                <form method="GET" action="{{ route('products.report') }}" class="grid grid-cols-1 md:grid-cols-6 gap-6 items-end">
                    
                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Título do Filme</label>
                        <input type="text" name="name" value="{{ request('name') }}" 
                            class="w-full bg-black border border-gray-700 text-white p-2 text-sm focus:border-yellow-400 outline-none transition">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Gênero</label>
                        <select name="type_id" class="w-full bg-black border border-gray-700 text-white p-2 text-sm focus:border-yellow-400 outline-none">
                            <option value="">Todos</option>
                            @foreach($types as $type)
                                <option value="{{ $type->id }}" {{ request('type_id') == $type->id ? 'selected' : '' }}>
                                    {{ strtoupper($type->name) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Qtd Mín</label>
                        <input type="number" name="min_quantity" value="{{ request('min_quantity') }}" 
                            class="w-full bg-black border border-gray-700 text-white p-2 text-sm focus:border-yellow-400 outline-none">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Qtd Máx</label>
                        <input type="number" name="max_quantity" value="{{ request('max_quantity') }}" 
                            class="w-full bg-black border border-gray-700 text-white p-2 text-sm focus:border-yellow-400 outline-none">
                    </div>

                    <div>
                        <button type="submit" class="w-full bg-yellow-400 text-black font-black py-2.5 text-[10px] uppercase tracking-widest hover:bg-white transition duration-300">
                            Filtrar
                        </button>
                    </div>
                </form>
                
                <div class="mt-6 pt-6 border-t border-gray-800 flex justify-end">
                    <a href="{{ route('products.reportPdf', request()->all()) }}" 
                       class="inline-flex items-center gap-2 bg-red-600 text-white font-black px-6 py-2 text-[10px] uppercase tracking-widest hover:bg-red-700 transition">
                       Gerar Relatório em PDF
                    </a>
                </div>
            </div>

            <div class="bg-[#0b121f] border border-gray-800 overflow-hidden shadow-2xl rounded-sm">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-black border-b border-gray-800">
                            <th class="p-5 text-[10px] font-black uppercase tracking-widest text-gray-400">Filme</th>
                            <th class="p-5 text-[10px] font-black uppercase tracking-widest text-gray-400">Gênero</th>
                            <th class="p-5 text-[10px] font-black uppercase tracking-widest text-gray-400 text-center">Estoque</th>
                            <th class="p-5 text-[10px] font-black uppercase tracking-widest text-gray-400 text-right">Preço Unitário</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800">
                        @forelse($products as $product)
                        <tr class="hover:bg-yellow-400/5 transition group">
                            <td class="p-5 font-bold text-sm uppercase tracking-tight group-hover:text-yellow-400">{{ $product->name }}</td>
                            <td class="p-5 text-[10px] text-gray-500 font-bold uppercase">{{ $product->type_name }}</td>
                            <td class="p-5 text-center text-sm font-mono">{{ $product->quantity }}</td>
                            <td class="p-5 text-right font-black text-yellow-400 text-sm">
                                R$ {{ number_format($product->price, 2, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-20 text-center text-gray-600 text-[10px] font-black uppercase tracking-[0.2em]">
                                Nenhum DVD encontrado no acervo.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <footer class="mt-8 text-center">
                <p class="text-[9px] text-gray-600 uppercase font-bold tracking-widest">CineStore Inventory Management System © 2026</p>