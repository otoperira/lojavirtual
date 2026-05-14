<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineStore - Catálogo de Filmes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#050a12] text-gray-100 min-h-screen">
    
    <nav class="bg-black text-white p-6 shadow-2xl border-b border-gray-800">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="text-3xl font-black tracking-tighter uppercase italic">
                Cine<span class="text-yellow-400">Store</span>
            </a>
            
            <div class="space-x-6 flex items-center">
                <a href="{{ url('/login') }}" class="text-[10px] font-black uppercase tracking-widest hover:text-gray-400 transition">Entrar</a>
                <a href="{{ url('/register') }}" class="px-5 py-2 bg-white text-black text-[10px] font-black uppercase rounded-sm hover:bg-yellow-400 transition">Criar Conta</a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto p-8">
        
        <div class="mb-12 flex flex-wrap gap-6 justify-center border-b border-gray-800 pb-6">
            <a href="{{ route('home') }}" class="text-[10px] font-black uppercase tracking-widest hover:text-yellow-400 px-4 py-2 {{ !request('type_id') ? 'text-yellow-400 border-b-2 border-yellow-400' : 'text-gray-500' }}">Todos</a>
            @foreach($types as $type)
                <a href="{{ route('home', ['type_id' => $type->id]) }}" 
                   class="text-[10px] font-black uppercase tracking-widest hover:text-yellow-400 px-4 py-2 {{ request('type_id') == $type->id ? 'text-yellow-400 border-b-2 border-yellow-400' : 'text-gray-500' }}">
                    {{ $type->name }}
                </a>
            @endforeach
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-x-8 gap-y-16">
            @foreach($products as $product)
                <div class="group cursor-pointer">
                    <div class="aspect-[2/3] overflow-hidden bg-gray-900 mb-4 border border-gray-800 shadow-lg group-hover:border-yellow-400 transition-colors duration-300">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 opacity-80 group-hover:opacity-100">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-700 uppercase font-black text-[10px]">Sem Capa</div>
                        @endif
                    </div>
                    
                    <div class="text-left space-y-2">
                        <h2 class="text-xs font-black text-white uppercase tracking-tight leading-tight group-hover:text-yellow-400 transition">{{ $product->name }}</h2>
                        <div class="flex justify-between items-end">
                            <p class="text-lg font-black text-yellow-400">R$ {{ number_format($product->price, 2, ',', '.') }}</p>
                            <p class="text-[9px] text-gray-500 uppercase font-bold italic">Estoque: {{ $product->quantity }}</p>
                        </div>
                        
                        <div class="pt-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <button class="w-full py-2 bg-white text-black text-[9px] font-black uppercase tracking-tighter rounded-sm hover:bg-yellow-400 transition">
                                Adicionar ao Carrinho
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </main>

    <footer class="mt-20 border-t border-gray-900 p-12 text-center">
        <p class="text-[9px] uppercase tracking-[0.4em] text-gray-700 font-black mb-2">CineStore / Premium DVD Collection</p>
        <p class="text-[8px] text-gray-800 uppercase">&copy; {{ date('Y') }} - Todos os direitos reservados</p>
    </footer>
</body>
</html>