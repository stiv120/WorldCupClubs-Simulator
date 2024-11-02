<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Modelo Eloquent para la tabla de jugadores
 */
class Player extends Model
{
    use HasFactory;

    /**
     * Atributo que especifica el nombre de la secuencia asociado a la Tabla/Modelo
     * @var string
     */
    public $sequence = 's_jugadores';

    /**
     * Atributo que especifica el nombre de la tabla asociado al modelo.
     * @var string
     */
    protected $table = 'jugadores';

    /**
     * Los atributos que son asignables masivamente.
     * @var array
     */
    protected $fillable = [
        'edad',
        'nombre',
        'posicion',
        'url_foto',
        'equipo_id',
        'nacionalidad',
        'numero_camiseta'
    ];

    /**
     * Los atributos que deben ser convertidos a fechas.
     * @var array
     */
    protected $dates = [
        'fecha_creacion',
        'fecha_actualizacion'
    ];

    /**
     * Nombres personalizados para las marcas de tiempo
     */
    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_actualizacion';

    /**
     * Relación con el modelo Team
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team()
    {
        return $this->belongsTo(Team::class, 'equipo_id');
    }
}
