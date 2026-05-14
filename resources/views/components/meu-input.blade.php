<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-yellow-400 leading-tight">
            {{ __('Relatório de Acervo - CineStore') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-white dark:bg-[#0f0f0f] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-[#1a1a1a] overflow-hidden shadow-xl border border-gray-200 dark:border-gray-800 p-8">
                
                <form method="GET" action="{{ route('products.report') }}" class="mb-10 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Título do Filme</label>
                            <input type="text" name="name" value="{{ request('name') }}" 
                                class="w-full bg-gray-50 dark:bg-black border-gray-200 dark:border-gray-700 text-sm focus:ring-yellow-400 focus:border-yellow-400 dark:text-white">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Gênero / Tipo</label>
                            <select name="type_id" class="w-full bg-gray-50 dark:bg-black border-gray-200 dark:border-gray-700 text-sm focus:ring-yellow-400 focus:border-yellow-400 dark:text-white">
                                <option value="">Todos os Gêneros</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}" {{ request('type_id') == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Qtd Mínima</label>
                            <input type="number" name="min_quantity" value="{{ request('min_quantity') }}" 
                                class="w-full bg-gray-50 dark:bg-black border-gray-200 dark:border-gray-700 text-sm">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Qtd Máxima</label>
                            <input type="number" name="max_quantity" value="{{ request('max_quantity') }}" 
                                class="w-full bg-gray-50 dark:bg-black border-gray-200 dark:border-gray-700 text-sm">
                        </div>
                    </div>

                    <div class="flex items-center gap-4 pt-2">
                        <button type="submit" class="bg-black dark:bg-yellow-400 text-white dark:text-black px-8 py-3 text-[10px] font-black uppercase tracking-widest hover:opacity-80 transition">
                            Gerar Relatório
                        </button>
                        <a href="{{ route('products.report') }}" class="text-[10px] font-bold uppercase tracking-widest text-gray-400 hover:text-yellow-400 transition">
                            Limpar Filtros
                        </a>
                    </div>
                </form>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-100 dark:border-gray-800">
                                <th class="py-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">DVD / Filme</th>
                                <th class="py-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 text-center">Gênero</th>
                                <th class="py-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 text-center">Estoque</th>
                                <th class="py-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 text-right">Preço Unitário</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 dark:divide-gray-800/50">
                            @forelse($products as $product)
                            <tr class="group hover:bg-gray-50 dark:hover:bg-black/20 transition-colors">
                                <td class="py-5">
                                    <span class="text-sm font-bold text-gray-800 dark:text-gray-200 uppercase tracking-tight group-hover:text-yellow-400 transition-colors">
                                        {{ $product->name }}
                                    </span>
                                </td>
                                <td class="py-5 text-center">
                                    <span class="text-[10px] font-bold py-1 px-3 bg-gray-100 dark:bg-gray-800 text-gray-500 uppercase rounded-full">
                                        {{ $product->type->name }}
                                    </span>
                                </td>
                                <td class="py-5 text-center">
                                    <span class="text-sm font-medium {{ $product->quantity < 5 ? 'text-red-500 font-bold' : 'text-gray-400' }}">
                                        {{ $product->quantity }} unid.
                                    </span>
                                </td>
                                <td class="py-5 text-right font-black text-sm text-black dark:text-white">
                                    R$ {{ number_format($product->price, 2, ',', '.') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="py-10 text-center text-[10px] uppercase tracking-widest text-gray-400 italic">
                                    Nenhum título encontrado para os filtros selecionados.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>