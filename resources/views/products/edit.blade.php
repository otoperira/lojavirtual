<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar DVD - CineStore</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white font-sans">

    <header class="border-b border-gray-800 p-6 bg-[#111]">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-black text-yellow-400 uppercase italic italic">CineStore / Editor</h1>
            <a href="/products" class="text-xs font-bold uppercase text-gray-500 hover:text-white">Voltar</a>
        </div>
    </header>

    <main class="py-12 px-6">
        <div class="max-w-3xl mx-auto bg-[#111] border border-gray-800 p-8 shadow-2xl">
            
            <h2 class="text-xl font-black uppercase tracking-tighter mb-8 border-l-4 border-yellow-400 pl-4">
                Alterar Informações: <span class="text-gray-400">{{ $product->name }}</span>
            </h2>

            <form method="POST" action="{{ route('products.update') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <input type="hidden" name="id" value="{{ $product->id }}">

                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Título do Filme</label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                            class="w-full bg-black border-gray-700 text-white p-3 text-sm focus:border-yellow-400 outline-none transition">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Gênero</label>
                        <select name="type_id" required class="w-full bg-black border-gray-700 text-white p-3 text-sm focus:border-yellow-400 outline-none">
                            @foreach($types as $type)
                                <option value="{{ $type->id }}" {{ $product->type_id == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Qtd em Estoque</label>
                            <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}" required
                                class="w-full bg-black border-gray-700 text-white p-3 text-sm focus:border-yellow-400 outline-none">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Preço de Venda (R$)</label>
                            <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" required
                                class="w-full bg-black border-gray-700 text-white p-3 text-sm focus:border-yellow-400 outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Sinopse</label>
                        <textarea name="description" rows="4" 
                            class="w-full bg-black border-gray-700 text-white p-3 text-sm focus:border-yellow-400 outline-none">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="border-t border-gray-800 pt-6">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Capa do DVD</label>
                        <div class="flex items-start gap-4">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="w-24 h-32 object-cover border border-gray-700 shadow-lg">
                            @endif
                            <div class="flex-1">
                                <p class="text-[9px] text-gray-500 uppercase mb-2 italic">Selecione um arquivo para trocar a imagem atual:</p>
                                <input type="file" name="image" class="text-xs text-gray-400 file:bg-yellow-400 file:text-black file:px-4 file:py-2 file:border-0 file:font-black file:uppercase file:cursor-pointer hover:file:bg-yellow-300">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-4 mt-10">
                    <button type="submit" class="bg-yellow-400 text-black px-12 py-4 text-xs font-black uppercase tracking-widest hover:bg-yellow-300 transition shadow-lg">
                        Salvar Alterações
                    </button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>