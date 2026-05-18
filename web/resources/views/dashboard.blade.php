<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Control</title>
    <style>
        body { background-color: #0f0f0f; color: #ffffff; cursor: crosshair; }
        .bg-dark-panel { background-color: #171718; }
        .tab-active { background-color: #ffffff !important; color: #171718 !important; box-shadow: 0 0 30px rgba(255,255,255,0.15); }
        .bg-grid { background-image: radial-gradient(rgba(255,255,255,0.03) 1px, transparent 0); background-size: 30px 30px; }
        .tooltip-box:hover .tooltip-text { visibility: visible; opacity: 1; }
        @keyframes scan { 0% { top: 0%; } 100% { top: 100%; } }
        .scanner-line { height: 2px; background: rgba(255,255,255,0.1); position: absolute; width: 100%; animation: scan 3s linear infinite; }
    </style>
</head>
<body class="font-sans antialiased bg-grid">
    <nav class="bg-dark-panel/90 backdrop-blur-3xl border-b border-white/5 px-10 py-5 flex justify-between items-center sticky top-0 z-50">
        <div class="flex items-center gap-6">
            <div class="w-12 h-12 bg-white flex items-center justify-center rounded-2xl">
                <span class="text-[#171718] font-black text-2xl">N</span>
            </div>
            <div>
                <h1 class="text-xl font-black tracking-tighter uppercase italic">Next</h1>
                <p class="text-[8px] font-black tracking-[0.4em] text-white/30 uppercase text-blue-400">Snapshot 1.1.2</p>
            </div>
        </div>
        <div class="flex items-center gap-10">
            <div class="relative tooltip-box">
                <p class="text-[9px] font-black text-white/20 uppercase mb-1">Estado de Red</p>
                <div class="flex gap-1">
                    <div class="w-1 h-3 bg-green-500/50 rounded-full"></div>
                    <div class="w-1 h-3 bg-green-500 rounded-full animate-pulse"></div>
                    <div class="w-1 h-3 bg-green-500/50 rounded-full"></div>
                </div>
                <div class="tooltip-text invisible opacity-0 absolute top-full mt-3 right-0 w-56 bg-white text-[#171718] text-[9px] p-4 rounded-xl font-bold shadow-2xl transition-all z-50">
                    SISTEMA: OPERACIONAL<br>NÚCLEOS: 16 ACTIVOS<br>MEMORIA: 84% EN USO<br>VOLATILIDAD: ALTA
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-white/5 hover:bg-red-600 px-6 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">Desconexión</button>
            </form>
        </div>
    </nav>

    <div class="flex">
        <aside class="w-24 bg-dark-panel border-r border-white/5 min-h-screen flex flex-col items-center py-12 gap-8">
            <div onclick="alert('Notificaciones Next: Sincronización completada.')" class="w-12 h-12 rounded-2xl border border-white/5 flex items-center justify-center text-white/20 hover:text-white hover:bg-white/5 transition-all cursor-pointer group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
            </div>
            <div onclick="alert('Logs Next: Fluctuación de mercado detectada.')" class="w-12 h-12 rounded-2xl border border-white/5 flex items-center justify-center text-white/20 hover:text-white hover:bg-white/5 transition-all cursor-pointer group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
            </div>
        </aside>

        <main class="flex-1 p-12">
            <div class="flex justify-between items-center mb-16">
                <div class="flex gap-2 p-1.5 bg-dark-panel rounded-2xl border border-white/5">
                    @if(auth()->guard('admin')->check())
                        <button onclick="showTab('analytics')" id="btn-analytics" class="tab-btn px-8 py-3 rounded-xl font-black text-[10px] uppercase tracking-widest transition-all">Analítica</button>
                        <button onclick="showTab('full')" id="btn-full" class="tab-btn px-8 py-3 rounded-xl font-black text-[10px] uppercase tracking-widest transition-all text-blue-400">Reporte Maestro</button>
                        <button onclick="showTab('admins')" id="btn-admins" class="tab-btn px-8 py-3 rounded-xl font-black text-[10px] uppercase tracking-widest transition-all">Admins</button>
                        <button onclick="showTab('support')" id="btn-support" class="tab-btn px-8 py-3 rounded-xl font-black text-[10px] uppercase tracking-widest transition-all text-white/40">Soporte</button>
                    @endif
                    <button onclick="showTab('users')" id="btn-users" class="tab-btn px-8 py-3 rounded-xl font-black text-[10px] uppercase tracking-widest transition-all text-white/40">Usuarios</button>
                </div>

                <div id="create-buttons" class="flex gap-4">
                    <a href="{{ route('exportar.csv') }}" class="bg-blue-600 hover:bg-blue-500 text-white px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-lg shadow-blue-500/20">CSV</a>
                    @if(auth()->guard('admin')->check())
                        <button onclick="openCreateModal('admins')" class="btn-admins-create hidden bg-white text-black px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest hover:invert transition-all shadow-xl">Nuevo Admin</button>
                    @endif
                    <button onclick="openCreateModal('users')" class="btn-users-create hidden bg-white text-black px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest hover:invert transition-all shadow-xl">Nuevo Usuario</button>
                </div>
            </div>

            @if(auth()->guard('admin')->check())
            <div id="tab-analytics" class="tab-content hidden animate-in fade-in duration-500">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                    <div class="bg-dark-panel p-10 rounded-[3rem] border border-white/5 shadow-2xl relative overflow-hidden">
                        <div class="scanner-line"></div>
                        <p class="text-[9px] font-black text-white/20 uppercase tracking-[0.4em] mb-4 italic">Mayor Subida</p>
                        <p class="text-2xl font-black text-green-500 uppercase tracking-tighter">{{ $stats['max_subida']->username ?? '---' }}</p>
                        <p class="text-sm font-bold mt-2 text-white/50">+$ {{ number_format($stats['max_subida']->ultima_var ?? 0, 2) }}</p>
                    </div>
                    <div class="bg-dark-panel p-10 rounded-[3rem] border border-white/5 shadow-2xl relative overflow-hidden">
                        <p class="text-[9px] font-black text-white/20 uppercase tracking-[0.4em] mb-4 italic text-red-500/50">Mayor Caída</p>
                        <p class="text-2xl font-black text-red-500 uppercase tracking-tighter">{{ $stats['max_caida']->username ?? '---' }}</p>
                        <p class="text-sm font-bold mt-2 text-white/50">-$ {{ number_format(abs($stats['max_caida']->ultima_var ?? 0), 2) }}</p>
                    </div>
                    <div class="bg-dark-panel p-10 rounded-[3rem] border border-white/5 shadow-2xl relative overflow-hidden">
                        <p class="text-[9px] font-black text-white/20 uppercase tracking-[0.4em] mb-4 italic text-blue-500/50">Más Estable</p>
                        <p class="text-2xl font-black text-blue-400 uppercase tracking-tighter">{{ $stats['mas_estable']->username ?? '---' }}</p>
                        <p class="text-sm font-bold mt-2 text-white/50">VAR: {{ number_format(abs($stats['mas_estable']->ultima_var ?? 0), 3) }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                    <div class="bg-dark-panel p-12 rounded-[4rem] border border-white/5 md:col-span-2">
                        <h4 class="text-[10px] font-black uppercase tracking-[0.5em] mb-12 text-white/20">Fluctuación Global Next</h4>
                        <div class="h-96"><canvas id="mainChart"></canvas></div>
                    </div>
                    <div class="bg-dark-panel p-12 rounded-[4rem] border border-white/5">
                        <h4 class="text-[10px] font-black uppercase tracking-[0.5em] mb-12 text-white/20">Distribución de Activos</h4>
                        <div class="h-96"><canvas id="rangeChart"></canvas></div>
                    </div>
                </div>
            </div>

            <div id="tab-full" class="tab-content hidden">
                <div class="bg-dark-panel rounded-[5rem] border border-white/10 p-20 shadow-2xl relative overflow-hidden text-white">
                    <div class="flex justify-between items-center mb-24">
                        <h2 class="text-7xl font-black uppercase tracking-tighter italic">Auditoría</h2>
                        <a href="{{ route('exportar.csv') }}" class="text-[10px] font-black uppercase tracking-widest text-blue-400 border border-blue-400/20 px-6 py-3 rounded-xl hover:bg-blue-400 hover:text-black transition-all">Exportar CSV</a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-24">
                        <div class="space-y-6">
                            <h5 class="text-[10px] font-black text-white/40 uppercase tracking-[0.4em] mb-10 border-b border-white/5 pb-4 italic">Top 10 Capitales</h5>
                            @foreach($stats['top_10'] as $u)
                            <div class="flex justify-between items-center bg-white/5 p-6 rounded-3xl hover:bg-white hover:text-black transition-all">
                                <span class="text-xs font-black uppercase tracking-widest">{{ $u->username }}</span>
                                <span class="text-sm font-black italic underline decoration-blue-500/50">${{ number_format($u->balance, 2) }}</span>
                            </div>
                            @endforeach
                        </div>
                        <div class="bg-white/5 p-12 rounded-[3.5rem] border border-white/5">
                            <h5 class="text-[10px] font-black text-red-500 uppercase tracking-[0.4em] mb-8 italic italic">Zonas de Riesgo</h5>
                            <div class="grid grid-cols-2 gap-4">
                                @foreach($users->where('balance', '<=', 90)->take(8) as $u)
                                <div class="bg-black/40 border border-red-500/20 p-5 rounded-2xl">
                                    <p class="text-[9px] font-black text-red-500 uppercase mb-1">{{ $u->username }}</p>
                                    <p class="text-xs font-bold">${{ number_format($u->balance, 2) }}</p>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div id="tab-admins" class="tab-content hidden">@include('partials.table', ['data' => $admins, 'type' => 'admins'])</div>
            <div id="tab-support" class="tab-content hidden">@include('partials.table', ['data' => $support, 'type' => 'support'])</div>
            <div id="tab-users" class="tab-content hidden">@include('partials.table', ['data' => $users, 'type' => 'users'])</div>
        </main>
    </div>

    <div id="modal" class="fixed inset-0 bg-black/95 backdrop-blur-3xl hidden flex items-center justify-center p-4 z-[100] text-white">
        <div class="bg-dark-panel w-full max-w-xl rounded-[4rem] border border-white/10 shadow-2xl p-16">
            <form id="modalForm" method="POST">
                @csrf
                <h3 id="modalTitle" class="text-4xl font-black mb-12 tracking-tighter uppercase italic text-center underline decoration-white/5">Acción</h3>
                <div id="inputsContainer" class="space-y-8"></div>
                <div class="flex justify-between items-center mt-16">
                    <button type="button" onclick="closeModal()" class="text-[10px] font-black uppercase tracking-widest text-white/10 hover:text-white transition">Cancelar</button>
                    <button type="submit" class="bg-white text-black px-16 py-5 rounded-[2rem] font-black text-[11px] uppercase tracking-widest shadow-2xl hover:invert transition-all">Confirmar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showTab(name) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('.tab-btn').forEach(el => {
                el.classList.remove('tab-active');
                el.classList.add('text-white/40', 'hover:text-white');
            });
            const createBtnContainer = document.getElementById('create-buttons');
            createBtnContainer.querySelectorAll('button').forEach(b => b.classList.add('hidden'));

            const target = document.getElementById('tab-' + name);
            if(target) target.classList.remove('hidden');
            const btn = document.getElementById('btn-' + name);
            if(btn) btn.classList.add('tab-active');
            
            const specificCreateBtn = createBtnContainer.querySelector('.btn-' + name + '-create');
            if(specificCreateBtn) specificCreateBtn.classList.remove('hidden');
        }

        function openCreateModal(type) {
            const container = document.getElementById('inputsContainer');
            document.getElementById('modalTitle').innerText = 'Crear ' + type;
            document.getElementById('modalForm').action = `/store/${type}`;
            container.innerHTML = `
                <input type="text" name="username" placeholder="NOMBRE DE USUARIO" required class="w-full bg-black/40 border border-white/10 p-5 rounded-2xl outline-none focus:border-white font-bold text-sm uppercase tracking-widest text-white">
                <input type="text" name="email" placeholder="CORREO" required class="w-full bg-black/40 border border-white/10 p-5 rounded-2xl outline-none focus:border-white font-bold text-sm uppercase tracking-widest text-white">
                <input type="password" name="password" placeholder="CONTRASEÑA" required class="w-full bg-black/40 border border-white/10 p-5 rounded-2xl outline-none focus:border-white font-bold text-sm uppercase tracking-widest text-white">
                ${type === 'users' ? '<input type="number" step="0.01" name="balance" placeholder="BALANCE INICIAL" class="w-full bg-black/40 border border-white/10 p-5 rounded-2xl outline-none focus:border-white font-bold text-sm uppercase tracking-widest text-white">' : ''}
            `;
            document.getElementById('modal').classList.remove('hidden');
        }

        function editRow(type, data) {
            const container = document.getElementById('inputsContainer');
            document.getElementById('modalTitle').innerText = 'Modificar';
            document.getElementById('modalForm').action = `/update/${type}/${data.id}`;
            container.innerHTML = '';
            Object.keys(data).forEach(key => {
                if(['id', 'remember_token', 'ultima_var'].includes(key)) return;
                const value = data[key] || '';
                container.innerHTML += `
                    <div>
                        <label class="text-[9px] font-black text-white/10 uppercase tracking-[0.4em] ml-4 mb-2 block italic">${key}</label>
                        <input type="${key === 'password' ? 'password' : 'text'}" name="${key}" value="${key === 'password' ? '' : value}" 
                        class="w-full bg-black/60 border border-white/5 p-6 rounded-[1.5rem] outline-none font-black text-sm uppercase tracking-widest text-white focus:border-white/20 transition-all">
                    </div>`;
            });
            document.getElementById('modal').classList.remove('hidden');
        }

        function closeModal() { document.getElementById('modal').classList.add('hidden'); }

        @if(auth()->guard('admin')->check())
        new Chart(document.getElementById('mainChart'), {
            type: 'line',
            data: {
                labels: {!! json_encode($users->pluck('username')->take(12)) !!},
                datasets: [{
                    data: {!! json_encode($users->pluck('balance')->take(12)) !!},
                    borderColor: '#ffffff',
                    borderWidth: 4,
                    backgroundColor: 'rgba(255,255,255,0.02)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 6,
                    pointBackgroundColor: '#ffffff',
                    pointHoverRadius: 10,
                    pointHoverBorderWidth: 4,
                    pointHoverBorderColor: '#3b82f6'
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: { legend: { display: false } },
                scales: {
                    y: { grid: { color: 'rgba(255,255,255,0.01)' }, ticks: { color: 'rgba(255,255,255,0.1)' } },
                    x: { grid: { display: false }, ticks: { display: false } }
                }
            }
        });

        new Chart(document.getElementById('rangeChart'), {
            type: 'doughnut',
            data: {
                labels: ['BAJO', 'ESTABLE', 'SALUDABLE', 'SOBRESALIENTE'],
                datasets: [{
                    data: [{{ $stats['ranges']['bajo'] }}, {{ $stats['ranges']['estable'] }}, {{ $stats['ranges']['saludable'] }}, {{ $stats['ranges']['sobresaliente'] }}],
                    backgroundColor: ['#ef4444', '#f59e0b', '#10b981', '#60a5fa'],
                    borderWidth: 0, cutout: '90%'
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom', labels: { color: 'rgba(255,255,255,0.3)', font: { size: 10, weight: 'bold' } } } }
            }
        });
        @endif

        document.addEventListener('DOMContentLoaded', () => { 
            @if(auth()->guard('admin')->check()) showTab('analytics'); @else showTab('users'); @endif 
            setTimeout(() => { location.reload(); }, 60000);
        });
    </script>
</body>
</html>
