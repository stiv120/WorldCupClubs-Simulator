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
                <img src="{{ url('storage/'.$jugador?->url_foto) }}"
                     alt="Foto de {{ $jugador?->nombre }}"
                     width="50"
                     class="rounded-circle">
            @endif
        </td>
    </tr>
@endforeach
