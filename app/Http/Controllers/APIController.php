<?php

namespace App\Http\Controllers;

use App\Imagen;
use App\Categoria;
use App\Establecimiento;
use Illuminate\Http\Request;

class APIController extends Controller
{
    // obtener todos los establecimientos
    public function index()
    {
        // consulta Eager Loading, permite obtener varias relaciones en la misma consulta
        $establecimientos = Establecimiento::with('categoria')->get();
        return response()->json($establecimientos);
    }

    // obtener todas las categorias
    public function categorias()
    {
        $categorias = Categoria::all();

        // siempre se response en objeto Json
        return response()->json($categorias);
    }

    public function categoria(Categoria $categoria)
    {
        // se carga todas las establecimientos y con el with se carga la categoria a la que pertenece el establecimiento
        $establecimientos = Establecimiento::where('categoria_id', $categoria->id)->with('categoria')->take(3)->get();

        return response()->json($establecimientos);
    }

    public function show(Establecimiento $establecimiento)
    {
        $imagenes = Imagen::where('id_establecimiento', $establecimiento->uuid)->get();

        // asignar valores al arreglo
        $establecimiento->imagenes = $imagenes;

        return $establecimiento;
    }
}
