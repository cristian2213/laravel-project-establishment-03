<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    // leer las rutas por el slug "ruta amigable"
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // relacion de 1:n categoria a establecimientos
    public function establecimientos()
    {
        return $this->hasMany(Establecimiento::class);
    }
}
