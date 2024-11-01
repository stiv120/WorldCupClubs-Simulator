@foreach ($equipos as $equipo)
    <tr>
        <td>{{ $equipo->nombre }}</td>
        <td>{{ $equipo->pais }}</td>
        <td>
            @if($equipo->url_bandera)
                <img src="{{ url('storage/'.$equipo->url_bandera) }}"
                    alt="{{ $equipo->nombre }}"
                    width="50">
            @endif
        </td>
    </tr>
@endforeach
