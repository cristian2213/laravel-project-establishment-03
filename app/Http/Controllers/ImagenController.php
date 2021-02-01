<?php

namespace App\Http\Controllers;

use App\Imagen;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    // Utilizando intevation image
    public function store(Request $request)
    {
        if (request()->ajax()) {
            // leer imagen y almacenar imagen 
            $ruta_imagen = $request->file('file')->store('establecimientos', 'public');

            // resize img
            $imagen = Image::make(public_path("/storage/{$ruta_imagen}"))->fit(800, 450);

            $imagen->save();

            // almacenar con modelo
            $imagenDB = new Imagen();
            $imagenDB->id_establecimiento = $request['uuid'];
            $imagenDB->ruta_imagen = $ruta_imagen;
            $imagenDB->save();

            $respuesta = [
                'archivo' => $ruta_imagen
            ];

            return response()->json($respuesta);
        }
    }
}
