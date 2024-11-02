<div class="container mx-auto px-4 py-8">
    @if(empty($results))
        <div class="text-center p-8">
            <h2 class="text-2xl font-bold text-gray-700">No hay simulaciones disponibles</h2>
        </div>
    @else
        <!-- Campeón del Torneo -->
        @if(isset($results['campeon']))
            <h2 class="text-3xl font-bold text-center mb-4">¡{{ $results['campeon']['equipo']['nombre'] }} Campeón del Torneo!</h2>
            <div class="grid grid-cols-4 gap-4 text-center mb-8">
                <div>
                    <p class="text-sm">Partidos Ganados</p>
                    <p class="text-2xl font-bold">{{ $results['campeon']['estadisticas']['partidos_ganados'] }}</p>
                </div>
                <div>
                    <p class="text-sm">Goles a Favor</p>
                    <p class="text-2xl font-bold">{{ $results['campeon']['estadisticas']['goles_favor'] }}</p>
                </div>
                <div>
                    <p class="text-sm">Tarjetas Amarillas</p>
                    <p class="text-2xl font-bold">{{ $results['campeon']['estadisticas']['tarjetas_amarillas'] }}</p>
                </div>
                <div>
                    <p class="text-sm">Tarjetas Rojas</p>
                    <p class="text-2xl font-bold">{{ $results['campeon']['estadisticas']['tarjetas_rojas'] }}</p>
                </div>
            </div>
        @endif

        <!-- Encuentros en formato tabla simple -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-4">Encuentros</h2>
            <table class="w-full">
                <tbody>
                    @foreach(array_chunk($results['encuentros'], 3) as $groupMatches)
                        <tr>
                            @foreach($groupMatches as $match)
                                <td class="p-4 align-top">
                                    <div class="bg-white rounded-lg shadow p-4">
                                        <div class="text-center mb-2">
                                            <span class="font-bold text-gray-700">Partido #{{ $match['orden'] }}</span>
                                        </div>
                                        <!-- Equipo Local -->
                                        <div class="text-center mb-2">
                                            <span class="block">{{ $match['equipo_local']['nombre'] }}</span>
                                            <div class="flex justify-center items-center gap-2">
                                                <span class="text-xl font-bold">{{ $match['goles_local'] }}</span>
                                                <span class="text-sm">
                                                    🟨{{ $match['tarjetas']['local']['amarillas'] }}
                                                    🟥{{ $match['tarjetas']['local']['rojas'] }}
                                                </span>
                                            </div>
                                        </div>

                                        <div class="text-center my-2 font-bold text-gray-500">VS</div>

                                        <!-- Equipo Visitante -->
                                        <div class="text-center mt-2">
                                            <span class="block">{{ $match['equipo_visitante']['nombre'] }}</span>
                                            <div class="flex justify-center items-center gap-2">
                                                <span class="text-xl font-bold">{{ $match['goles_visitante'] }}</span>
                                                <span class="text-sm">
                                                    🟨{{ $match['tarjetas']['visitante']['amarillas'] }}
                                                    🟥{{ $match['tarjetas']['visitante']['rojas'] }}
                                                </span>
                                            </div>
                                        </div>

                                        @if($match['ganador'])
                                            <div class="text-center text-green-600 text-sm font-medium mt-2 bg-green-50 rounded-md py-1">
                                                {{ $match['ganador']['nombre'] }}
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            @endforeach
                            @for($i = count($groupMatches); $i < 3; $i++)
                                <td class="p-4"></td>
                            @endfor
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Estadísticas -->
        <div>
            <h2 class="text-2xl font-bold mb-4">Estadísticas</h2>
            <table class="w-full">
                <tbody>
                    @foreach(array_chunk($results['equipos'], 3) as $groupEquipos)
                        <tr>
                            @foreach($groupEquipos as $equipo)
                                <td class="p-4">
                                    <div class="bg-white rounded-lg shadow p-4 {{ $equipo['eliminado'] ? 'border-l-4 border-red-500' : 'border-l-4 border-green-500' }}">
                                        <table class="w-full text-sm">
                                            <tr>
                                                <td colspan="2" class="font-bold pb-2">{{ $equipo['equipo']['nombre'] }}</td>
                                                <td class="text-right">
                                                    <span class="px-2 py-1 rounded text-xs {{ $equipo['eliminado'] ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                                        {{ $equipo['eliminado'] ? 'Eliminado' : 'Activo' }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Posición</td>
                                                <td class="text-right" colspan="2">{{ $equipo['posicion_final'] ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td>Partidos G/P</td>
                                                <td class="text-right" colspan="2">
                                                    {{ $equipo['estadisticas']['partidos_ganados'] }}/{{ $equipo['estadisticas']['partidos_perdidos'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Goles F/C</td>
                                                <td class="text-right" colspan="2">
                                                    {{ $equipo['estadisticas']['goles_favor'] }}/{{ $equipo['estadisticas']['goles_contra'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tarjetas</td>
                                                <td class="text-right" colspan="2">
                                                    🟨{{ $equipo['estadisticas']['tarjetas_amarillas'] }}
                                                    🟥{{ $equipo['estadisticas']['tarjetas_rojas'] }}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
