<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineStore - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#050a12] text-white flex flex-col min-h-screen font-sans">
    
    <header class="p-8">
        <a href="/" class="text-3xl font-black uppercase italic tracking-tighter">
            CINE<span class="text-yellow-400">STORE</span>
        </a>
    </header>

    <main class="flex-1 flex items-center justify-center p-6">
        <div class="w-full max-w-md bg-black border border-gray-800 p-10 shadow-2xl">
            <h2 class="text-xl font-black uppercase border-l-4 border-yellow-400 pl-4 mb-8 tracking-widest">
                Acessar Conta
            </h2>

            {{-- Bloco de Erros --}}
            @if ($errors->any())
                <div class="mb-6 p-3 bg-red-900/20 border border-red-500 text-red-500 text-[10px] font-black uppercase tracking-widest">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf {{-- Proteção obrigatória do Laravel --}}

                <div>
                    <label class="block text-[10px] font-black uppercase text-gray-500 mb-2 tracking-widest">E-Mail</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus 
                        class="w-full bg-[#0b121f] border border-gray-700 p-3 text-white focus:border-yellow-400 outline-none transition">
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase text-gray-500 mb-2 tracking-widest">Senha</label>
                    <input type="password" name="password" required 
                        class="w-full bg-[#0b121f] border border-gray-700 p-3 text-white focus:border-yellow-400 outline-none transition">
                </div>

                <button type="submit" class="w-full bg-yellow-400 text-black font-black uppercase p-4 hover:bg-white transition tracking-widest text-xs">
                    Entrar
                </button>
            </form>

            <div class="mt-8 text-center">
                <a href="/register" class="text-[9px] font-bold uppercase text-gray-600 hover:text-white transition tracking-widest">
                    Não possui uma conta? Criar agora
                </a>
            </div>
        </div>
    </main>

    <footer class="p-8 text-center text-[8px] text-gray-800 uppercase tracking-[0.3em]">
        CineStore Security Protocol &copy; 2026
    </footer>
</body>
</html>