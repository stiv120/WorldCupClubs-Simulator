<?php

namespace Tests\Feature\Import\Infrastructure\Controllers;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ImportControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_view()
    {
        $response = $this->get(route('imports.index'));

        $response->assertStatus(200);
        $response->assertViewIs('imports.index');
    }

    public function test_store_imports_file()
    {
        Storage::fake('local');

        $csvContent = "equipo,pais,url_bandera,jugador,numero_camiseta,posicion,nacionalidad,edad,url_foto\n";
        $csvContent .= "Real Madrid,España,http://example.com/madrid.jpg,Karim Benzema,9,Delantero,Francia,34,http://example.com/benzema.jpg\n";
        $csvContent .= "Real Madrid,España,http://example.com/madrid.jpg,Luka Modric,10,Mediocampista,Croacia,36,http://example.com/modric.jpg\n";
        $csvContent .= "Barcelona,España,http://example.com/barca.jpg,Robert Lewandowski,9,Delantero,Polonia,33,http://example.com/lewandowski.jpg\n";
        $csvContent .= "Barcelona,España,http://example.com/barca.jpg,Pedri,8,Mediocampista,España,19,http://example.com/pedri.jpg";

        $file = UploadedFile::fake()->createWithContent(
            'equipos_jugadores.csv',
            $csvContent
        );

        $response = $this->post(route('imports.store'), [
            'archivo' => $file
        ]);

        $response->assertStatus(201);
        $response->assertJson(['message' => 'Archivo importado correctamente.']);
    }
}
