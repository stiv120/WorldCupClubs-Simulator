@foreach ($equipos as $equipo)
    <tr>
        <td>{{ $equipo?->nombre }}</td>
        <td>{{ $equipo?->pais }}</td>
        <td>
            @if($equipo?->url_bandera)
                @php
                    $imagePath = Str::startsWith($equipo->url_bandera, ['http://', 'https://'])
                        ? $equipo->url_bandera
                        : (Str::startsWith($equipo->url_bandera, 'teams/')
                            ? asset($equipo->url_bandera)
                            : url('storage/'.$equipo->url_bandera));
                @endphp
                <img src="{{ $imagePath }}"
                    alt="{{ $equipo?->nombre }}"
                    width="50"
                    onerror="this.onerror=null; this.remove(); this.parentElement.innerText='{{ $equipo?->nombre }}';">
            @else
                {{ $equipo?->nombre }}
            @endif
        </td>
    </tr>
@endforeach
