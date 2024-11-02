<?php

namespace Src\Import\Infrastructure\Persistence;

use App\Models\Team;
use League\Csv\Reader;
use App\Models\Player;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Src\Import\Domain\Repositories\ImportRepositoryInterface;

class EloquentImportRepository implements ImportRepositoryInterface
{
    public function importFromCsv(string $csvPath)
    {
        $fullPath = Storage::disk('public')->path($csvPath);

        DB::beginTransaction();

        try {
            $csv = Reader::createFromPath($fullPath, 'r');
            $csv->setHeaderOffset(0);

            foreach ($csv as $record) {
                $team = Team::updateOrCreate(
                    ['nombre' => $record['equipo']],
                    [
                        'pais' => $record['pais'],
                        'url_bandera' => $record['url_bandera']
                    ]
                );

                Player::updateOrCreate(
                    [
                        'equipo_id' => $team->id,
                        'numero_camiseta' => $record['numero_camiseta'],
                        'nombre' => $record['jugador']
                    ],
                    [
                        'posicion' => $record['posicion'],
                        'nacionalidad' => $record['nacionalidad'],
                        'edad' => $record['edad'],
                        'url_foto' => $record['url_foto']
                    ]
                );
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}



