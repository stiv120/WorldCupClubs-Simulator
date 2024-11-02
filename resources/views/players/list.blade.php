@foreach ($jugadores as $jugador)
    <tr>
        <td>{{ $jugador?->nombre }}</td>
        <td>{{ $jugador?->nacionalidad }}</td>
        <td>{{ $jugador?->edad }}</td>
        <td>{{ $jugador?->posicion }}</td>
        <td>{{ $jugador?->numero_camiseta }}</td>
        <td>{{ $jugador?->team->nombre }}</td>
        <td>
            @if($jugador?->url_foto)
                @php
                    $imagePath = Str::startsWith($jugador->url_foto, ['http://', 'https://'])
                        ? $jugador->url_foto
                        : (Str::startsWith($jugador->url_foto, 'players/')
                            ? asset($jugador->url_foto)
                            : url('storage/'.$jugador->url_foto));
                @endphp
                <img src="{{ $imagePath }}"
                     alt="Foto de {{ $jugador?->nombre }}"
                     width="50"
                     class="rounded-circle"
                     onerror="this.onerror=null; this.remove(); this.parentElement.innerText='{{ $jugador?->nombre }}';">
            @else
                {{ $jugador?->nombre }}
            @endif
        </td>
    </tr>
@endforeach
