<table class="w-full text-left">
    <thead>
        <tr class="text-[9px] uppercase text-white/20 tracking-[0.3em] border-b border-white/5">
            @if(count($data) > 0)
                @foreach(array_keys((array)$data[0]) as $column)
                    @if(!in_array($column, ['password', 'remember_token', 'ultima_var'])) <th class="p-8 font-black">{{ $column }}</th> @endif
                @endforeach
                <th class="p-8 text-right font-black">Acción</th>
            @endif
        </tr>
    </thead>
    <tbody class="divide-y divide-white/5">
        @foreach($data as $row)
        <tr class="group hover:bg-white/[0.02] transition-all">
            @foreach((array)$row as $key => $value)
                @if(!in_array($key, ['password', 'remember_token', 'ultima_var']))
                <td class="p-8 text-xs font-bold tracking-widest text-white">
                    @if($key == 'username')
                        <a href="{{ route('perfil', ['type' => $type, 'id' => $row->id]) }}" class="text-white hover:line-through transition-all uppercase decoration-white/20">
                            {{ $value }}
                        </a>
                    @elseif($key == 'balance')
                        @php
                            $val = (float)$value;
                            if($val <= 90) { $color = 'text-red-500'; $icon = '↓'; }
                            elseif($val <= 150) { $color = 'text-yellow-500'; $icon = '—'; }
                            elseif($val <= 300) { $color = 'text-green-500'; $icon = '↑'; }
                            else { $color = 'text-blue-400'; $icon = '◆'; }
                        @endphp
                        <div class="flex items-center gap-2 {{ $color }}">
                            <span class="text-[14px] font-black">{{ $icon }}</span>
                            <span>${{ number_format($val, 2) }}</span>
                        </div>
                    @else
                        <span class="opacity-30 uppercase">{{ $value }}</span>
                    @endif
                </td>
                @endif
            @endforeach
            <td class="p-8 text-right">
                <button onclick="editRow('{{ $type }}', {{ json_encode($row) }})" class="opacity-0 group-hover:opacity-100 bg-white/5 hover:bg-white hover:text-[#171718] border border-white/10 px-6 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest transition-all">
                    Editar
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
