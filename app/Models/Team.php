<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory;

        /**
     * Atributo que especifica el nombre de la secuencia asociado a la Tabla/Modelo
     */
    public $sequence = 's_equipos';

    /**
     * Atributo que especifica el nombre de la tabla asociado al modelo.
     */
    protected $table = 'equipos';

    protected $fillable = [
        'pais',
        'nombre',
        'url_bandera'
    ];

    protected $dates = [
        'fecha_creacion',
        'fecha_actualizacion'
    ];

    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_actualizacion';
}
