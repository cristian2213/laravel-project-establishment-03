<?php

namespace App\Http\Controllers;

use App\Imagen;
use App\Establecimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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

    public function destroy(Request $request)
    {
        if ($request->ajax()) {

            // obtener la uuid para verificar que exista el establecimiento
            $uuid = $request->get('uuid');
            $establecimiento = Establecimiento::where('uuid', $uuid)->first();

            $this->authorize('delete', $establecimiento);

            $imagen = $request->get('imagen'); // obtener la ruta de la imagen

            if (File::exists('storage/' . $imagen)) {
                File::delete('storage/' . $imagen); // eliminar la imagen si existe

                // eliminar registro de la db
                Imagen::where('ruta_imagen', '=', $imagen)->delete();

                //* alternativa a eliminar
                //$imagenEliminar = Imagen::where('ruta_imagen', '=', //$imagen)->firstOrFail();
                //Imagen::destroy($imagenEliminar->id);

                $respuesta = [
                    'imagen_eliminar' => $imagen
                ];

                return response()->json($respuesta);
            }


            return response()->json(['imagen_eliminar' => false]);
        }
    }
}
