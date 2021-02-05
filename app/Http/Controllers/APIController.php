<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Establecimiento;
use Illuminate\Http\Request;

class APIController extends Controller
{
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
        return $establecimiento;
    }
}
