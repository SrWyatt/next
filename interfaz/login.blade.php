<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Next | Acceso</title>
</head>
<body class="bg-[#171718] h-screen flex items-center justify-center font-sans antialiased">
    <div class="w-full max-w-sm p-10 text-white">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-black tracking-tighter italic uppercase underline decoration-white/10 decoration-4">Next <span class="text-white/20 font-light not-italic text-xl">Acceso</span></h2>
        </div>

        <form action="/login" method="POST" class="space-y-4">
            @csrf
            <div class="space-y-2">
                <label class="text-[9px] font-black text-white/30 uppercase tracking-[0.2em] ml-2">Identidad</label>
                <input type="text" name="username" placeholder="USUARIO" required 
                       class="w-full bg-black/20 border border-white/5 p-5 rounded-2xl outline-none focus:border-white/20 text-white font-bold text-sm tracking-widest transition-all">
            </div>
            <div class="space-y-2">
                <label class="text-[9px] font-black text-white/30 uppercase tracking-[0.2em] ml-2">Clave de Seguridad</label>
                <input type="password" name="password" placeholder="••••••••" required 
                       class="w-full bg-black/20 border border-white/5 p-5 rounded-2xl outline-none focus:border-white/20 text-white font-bold text-sm tracking-widest transition-all">
            </div>
            
            @if($errors->any())
                <p class="text-red-500 text-[10px] font-black uppercase text-center mt-4 tracking-widest animate-pulse">{{ $errors->first() }}</p>
            @endif

            <button type="submit" class="w-full bg-white text-[#171718] py-5 rounded-2xl font-black text-xs uppercase tracking-widest mt-8 hover:bg-slate-200 transition-all shadow-2xl">
                Autorizar Entrada
            </button>
        </form>
    </div>
</body>
</html>
