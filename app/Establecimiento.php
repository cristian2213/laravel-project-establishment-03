<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Establecimiento extends Model
{
    protected $fillable = [
        'nombre',
        'categoria_id',
        'imagen_principal',
        'direccion',
        'colonia',
        /*  'lat',
        'lng', */
        'telefono',
        'descripcion',
        'apertura',
        'cierre',
        'uuid'
    ];

    // relacion 1:1 de establecimiento a categoria Fk
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
