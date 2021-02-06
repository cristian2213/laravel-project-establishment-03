<?php

namespace App\Http\Controllers;

use App\Imagen;
use App\Categoria;
use App\Establecimiento;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class EstablecimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();

        return view('establecimientos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validar que la categoria existe
        // valida que la hora sea despues de la apertura


        $data = $request->validate([
            'nombre' => 'required',
            'categoria_select' => 'required|exists:App\Categoria,id',
            'imagen_principal' => 'required|image|max:1000',
            'direccion' => 'required|string',
            'barrio' => 'required|string',
            /* 'lat' => 'required',
            'lng' => 'required', */
            'telefono' => 'required|numeric',
            'descripcion' => 'required|min:100',

            'apertura' => 'date_format:H:i',
            'cierre' => 'date_format:H:i|after:apertura',
            'uuid' => 'required',

        ]);

        // guardar imagen usando intervation image
        $ruta_imagen = $request['imagen_principal']->store('imgs_pricipales', 'public');

        $imagen = Image::make(public_path("storage/{$ruta_imagen}"))->fit(800, 600);

        $imagen->save();


        // guardar en la db (un solo usuario puede registrar un solo establecimiento)
        auth()->user()->establecimiento()->create([
            'nombre' => $data['nombre'],
            'categoria_id' => $data['categoria_select'],
            'imagen_principal' => $ruta_imagen,
            'direccion' => $data['direccion'],
            'colonia' => $data['barrio'],
            /*  'lat' => $data['lat'],
            'lng' => $data['lng'], */
            'telefono' => $data['telefono'],
            'descripcion' => $data['descripcion'],

            'apertura' => $data['apertura'],
            'cierre' => $data['cierre'],
            'uuid' => $data['uuid']

        ]);


        return back()->with('estado', 'Tu información se almacenó correctamente ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function show(Establecimiento $establecimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Establecimiento $establecimiento)
    {
        $this->authorize('view', $establecimiento);

        $categorias = Categoria::all();
        // cambiar el formato de hora
        $establecimiento->apertura = date('H:i', strtotime($establecimiento->apertura));
        $establecimiento->cierre = date('H:i', strtotime($establecimiento->cierre));

        // obtener imagenes de un establecimiento
        $imagenes = Imagen::where('id_establecimiento', $establecimiento->uuid)->get();

        return view('establecimientos.edit', compact('categorias', 'establecimiento', 'imagenes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Establecimiento $establecimiento)
    {
        $this->authorize('update', $establecimiento);

        $data = $request->validate([
            'nombre' => 'required',
            'categoria_select' => 'required|exists:App\Categoria,id',
            'imagen_principal' => 'max:1000',
            'direccion' => 'required|string',
            'barrio' => 'required|string',
            /* 'lat' => 'required',
            'lng' => 'required', */
            'telefono' => 'required|numeric',
            'descripcion' => 'required|min:100',

            'apertura' => 'date_format:H:i',
            'cierre' => 'date_format:H:i|after:apertura',
            'uuid' => 'required',
        ]);


        if ($request['imagen_principal']) {
            // get the image path
            $ruta_imagen = $request['imagen_principal']->store('imgs_pricipales', 'public');

            // save image
            $imagen = Image::make(public_path("storage/{$ruta_imagen}"))->fit(800, 600);

            // save image
            $imagen->save();
        }

        $establecimiento->update([
            'nombre' => $data['nombre'],
            'categoria_id' => $data['categoria_select'],
            'direccion' => $data['direccion'],
            'colonia' => $data['barrio'],
            'imagen_principal' => $ruta_imagen ?? $establecimiento->imagen_principal,
            /*  'lat' => $data['lat'],
            'lng' => $data['lng'], */
            'telefono' => $data['telefono'],
            'descripcion' => $data['descripcion'],

            'apertura' => $data['apertura'],
            'cierre' => $data['cierre'],
            'uuid' => $data['uuid']
        ]);

        return back()->with('estado', 'Se actualizo correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Establecimiento $establecimiento)
    {
        //
    }
}
