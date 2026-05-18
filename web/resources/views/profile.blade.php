<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Perfil | Next</title>
</head>
<body class="bg-[#0f0f0f] text-white font-sans antialiased">
    <nav class="p-10 flex justify-between items-center border-b border-white/5 bg-[#171718]">
        <a href="{{ auth()->guard('web')->check() ? '#' : '/dashboard' }}" class="flex items-center gap-3 group">
            <div class="w-8 h-8 bg-white/5 group-hover:bg-white flex items-center justify-center rounded-lg transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:text-[#171718]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            </div>
            <span class="text-[10px] font-black uppercase tracking-[0.3em] opacity-30 group-hover:opacity-100 ml-2">Volver</span>
        </a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="text-[9px] font-black uppercase tracking-widest text-red-500 opacity-30 hover:opacity-100 transition-all">Salir</button>
        </form>
    </nav>
    <div class="max-w-6xl mx-auto py-24 px-10">
        <div class="bg-[#171718] rounded-[4rem] border border-white/5 shadow-2xl flex flex-col md:flex-row overflow-hidden">
            <div class="md:w-1/3 bg-black/40 p-20 flex flex-col items-center justify-center border-r border-white/5">
                <img src="/perfiles/img.png" class="w-48 h-48 rounded-full border border-white/10 p-3 grayscale hover:grayscale-0 transition-all duration-700 shadow-2xl">
                <h2 class="mt-10 text-4xl font-black uppercase tracking-tighter italic">{{ $user->username }}</h2>
                <div class="mt-4 px-4 py-1 border border-white/10 rounded-full">
                    <span class="text-white/30 text-[9px] font-black uppercase tracking-[0.4em]">{{ $type }}</span>
                </div>
            </div>
            <div class="p-20 md:w-2/3 flex flex-col justify-center">
                <div class="flex justify-between items-start mb-20">
                    <div>
                        <h3 class="text-white/20 text-[9px] font-black uppercase tracking-[0.4em] mb-2">Expediente</h3>
                        <p class="text-4xl font-black uppercase tracking-tighter italic italic underline decoration-white/5">Detalles del Sujeto</p>
                    </div>
                    @if(auth()->user()->id == $user->id)
                    <button onclick="document.getElementById('editModal').classList.remove('hidden')" class="bg-white text-[#171718] px-10 py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:invert transition-all">Actualizar</button>
                    @endif
                </div>
                <div class="space-y-12">
                    <div class="group border-b border-white/5 pb-10">
                        <p class="text-[9px] font-black text-white/20 uppercase tracking-[0.4em] mb-4">Correo Electrónico</p>
                        <p class="text-2xl font-bold tracking-widest opacity-60 uppercase">{{ $user->email ?? 'N/A' }}</p>
                    </div>
                    @if(isset($user->balance))
                    <div class="group">
                        <p class="text-[9px] font-black text-white/20 uppercase tracking-[0.4em] mb-4">Capital</p>
                        @php
                            $val = (float)$user->balance;
                            if($val <= 90) { $color = 'text-red-500'; $icon = '↓'; }
                            elseif($val <= 150) { $color = 'text-yellow-500'; $icon = '—'; }
                            elseif($val <= 300) { $color = 'text-green-500'; $icon = '↑'; }
                            else { $color = 'text-blue-400'; $icon = '◆'; }
                        @endphp
                        <p class="text-5xl font-black tracking-tighter {{ $color }} flex items-center gap-4">
                            <span class="text-4xl opacity-20">{{ $icon }}</span>
                            <span>USD ${{ number_format($val, 2) }}</span>
                        </p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div id="editModal" class="fixed inset-0 bg-black/95 backdrop-blur-3xl hidden flex items-center justify-center p-4 z-[100] text-white">
        <div class="bg-[#171718] w-full max-w-xl rounded-[4rem] border border-white/10 shadow-2xl p-16">
            <form action="/update/{{ $type ?? 'users' }}/{{ $user->id }}" method="POST">
                @csrf
                <h3 class="text-3xl font-black mb-10 tracking-tighter uppercase italic text-center underline decoration-white/5">Modificar Datos</h3>
                <div class="space-y-6">
                    <input type="text" name="username" value="{{ $user->username }}" class="w-full bg-black/40 border border-white/10 p-6 rounded-2xl outline-none font-bold uppercase tracking-widest text-sm text-white">
                    <input type="text" name="email" value="{{ $user->email ?? '' }}" class="w-full bg-black/40 border border-white/10 p-6 rounded-2xl outline-none font-bold uppercase tracking-widest text-sm text-white">
                    <input type="password" name="password" placeholder="NUEVA CONTRASEÑA" class="w-full bg-black/40 border border-white/10 p-6 rounded-2xl outline-none font-bold uppercase tracking-widest text-sm text-white">
                </div>
                <div class="flex justify-between items-center mt-12">
                    <button type="button" onclick="document.getElementById('editModal').classList.add('hidden')" class="text-[10px] font-black uppercase text-white/20">Cancelar</button>
                    <button type="submit" class="bg-white text-[#171718] px-12 py-4 rounded-2xl font-black text-[11px] uppercase tracking-widest shadow-2xl">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
