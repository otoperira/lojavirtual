<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineStore - Novo DVD</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#050a12] text-white font-sans">

    <header class="bg-black p-6 border-b border-gray-800 shadow-xl">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-black text-white uppercase italic tracking-tighter">
                Cine<span class="text-yellow-400">Store</span> <span class="text-gray-600 text-sm normal-case ml-2">/ Cadastro</span>
            </h1>
            <a href="/products" class="text-[10px] font-black uppercase tracking-widest text-gray-500 hover:text-white transition">
                Cancelar e Voltar
            </a>
        </div>
    </header>

    <main class="py-12 px-6">
        <div class="max-w-3xl mx-auto bg-[#0b121f] border border-gray-800 p-8 shadow-2xl rounded-sm">
            
            <h2 class="text-xl font-black uppercase tracking-widest mb-8 border-l-4 border-yellow-400 pl-4">
                Novo DVD no Acervo
            </h2>

            <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Título do Filme</label>
                        <input type="text" name="name" required placeholder="Ex: Star Wars: Episódio III"
                            class="w-full bg-black border border-gray-700 text-white p-3 text-sm focus:border-yellow-400 outline-none transition">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Gênero / Categoria</label>
                        <select name="type_id" required class="w-full bg-black border border-gray-700 text-white p-3 text-sm focus:border-yellow-400 outline-none">
                            <option value="">Selecione um gênero...</option>
                            @foreach($types as $type)
                                <option value="{{ $type->id }}">{{ strtoupper($type->name) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Qtd Inicial</label>
                            <input type="number" name="quantity" required
                                class="w-full bg-black border border-gray-700 text-white p-3 text-sm focus:border-yellow-400 outline-none">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Preço (R$)</label>
                            <input type="number" step="0.01" name="price" required
                                class="w-full bg-black border border-gray-700 text-white p-3 text-sm focus:border-yellow-400 outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Breve Sinopse</label>
                        <textarea name="description" rows="3" 
                            class="w-full bg-black border border-gray-700 text-white p-3 text-sm focus:border-yellow-400 outline-none"></textarea>
                    </div>

                    <div class="border-t border-gray-800 pt-6">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Capa do DVD (Imagem)</label>
                        <input type="file" name="image" required
                            class="text-xs text-gray-400 file:bg-white file:text-black file:px-4 file:py-2 file:border-0 file:font-black file:uppercase file:mr-4 file:cursor-pointer hover:file:bg-yellow-400 transition">
                    </div>
                </div>

                <div class="flex justify-end mt-10">
                    <button type="submit" class="bg-yellow-400 text-black px-12 py-4 text-xs font-black uppercase tracking-widest hover:bg-white transition shadow-lg">
                        Cadastrar no Sistema
                    </button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>