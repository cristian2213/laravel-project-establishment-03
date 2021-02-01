@extends('layouts.app')

@section('styles')

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />

    <!-- Esri Leaflet Geocoder -->
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder/dist/esri-leaflet-geocoder.css" />

    {{-- Dropzone --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.min.css"
        integrity="sha512-0ns35ZLjozd6e3fJtuze7XJCQXMWmb4kPRbb+H/hacbqu6XfIX0ZRGt6SrmNmv5btrBpbzfdISSd8BAsXJ4t1Q=="
        crossorigin="anonymous" />
@endsection

@section('content')
    <div class="container">
        <h1>Registrar Establecimiento</h1>

        <div class="row justify-content-center mt-5">
            <form action="{{ route('establecimientos.store') }}" method="POST" class="col-xs-12 col-md-9 card card-body"
                enctype="multipart/form-data">

                @csrf

                <fieldset class="border p-4 mb-4">
                    <legend class="text-primary text-center font-weight-bold">Nombre, Categoria e Imagen Pricipal</legend>

                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre"
                            class="form-control @error('nombre') is-invalid @enderror" placeholder="Nombre Establecimiento"
                            value="{{ old('nombre') }}">

                        @error('nombre')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label for="categoria_select">Categorias</label>

                        <select name="categoria_select" id="categoria_select"
                            class="form-control @error('categoria_select') is-invalid @enderror">

                            <option value="" selected>-- Selecciona --</option>
                            @foreach ($categorias as $categoria)
                                <option {{ old('categoria_select') == $categoria->id ? 'selected' : '' }}
                                    value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>

                        @error('categoria_select')
                            <div class="invalid-feedback">
                                {{ $message }}

                            </div>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label for="imagen_pricipal">Imagen Pricipal</label>

                        <input type="file" name="imagen_principal" id="imagen_pricipal"
                            class="form-control @error('imagen_principal') is-invalid @enderror"
                            value="{{ old('imagen_principal') }}" accept="image/*">

                        @error('imagen_principal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>
                </fieldset>


                <fieldset class="border p-4 mb-4 mt-5">
                    <legend class="text-primary text-center font-weight-bold">Ubicación</legend>

                    {{-- <div class="form-group">
                        <label for="form_buscador">Coloca la dirección del Establecimiento</label>
                        <input type="text" name="form_buscador" id="form_buscador"
                            placeholder="Calle del Negocio o Establecimiento" class="form-control">
                        <p class="text-secondary mt-5 mb-3 text-center">El asistente colocará una dirección estimada, mueve
                            el Pin hacia el lugar correcto</p>
                    </div>

                    <div class="form-group">
                        <div id="mapa" style="height: 400px"></div>
                    </div>

                    <p class="informacion">
                        Confirma que los siguientes campos son correctos
                    </p> --}}
                    <div class="form-group">
                        <label for="direccion">dirección</label>

                        <input type="text" id="direccion" placeholder="Dirreción" value="{{ old('direccion') }}"
                            name="direccion" class="form-control @error('direccion') is-invalid @enderror">

                        @error('direccion')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="barrio">Barrio</label>
                        <input type="text" id="barrio" placeholder="Dirreción" value="{{ old('barrio') }}" name="barrio"
                            class="form-control @error('barrio') is-invalid @enderror">

                        @error('barrio')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    {{-- <input type="hidden" name="lat" id="lat" value="{{ old('lat') }}">

                    <input type="hidden" name="lng" id="lng" value="{{ old('lng') }}"> --}}
                </fieldset>


                <fieldset class="border p-4 mt-5">
                    <legend class="text-primary">Información Establecimiento: </legend>
                    <div class="form-group">
                        <label for="nombre">Teléfono</label>
                        <input type="tel" class="form-control @error('telefono')  is-invalid  @enderror" id="telefono"
                            placeholder="Teléfono Establecimiento" name="telefono" value="{{ old('telefono') }}">

                        @error('telefono')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>



                    <div class="form-group">
                        <label for="nombre">Descripción</label>
                        <textarea class="form-control  @error('descripcion')  is-invalid  @enderror"
                            name="descripcion">{{ old('descripcion') }}</textarea>

                        @error('descripcion')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nombre">Hora Apertura:</label>
                        <input type="time" class="form-control @error('apertura')  is-invalid  @enderror" id="apertura"
                            name="apertura" value="{{ old('apertura') }}">
                        @error('apertura')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nombre">Hora Cierre:</label>
                        <input type="time" class="form-control @error('cierre')  is-invalid  @enderror" id="cierre"
                            name="cierre" value="{{ old('cierre') }}">
                        @error('cierre')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </fieldset>


                <fieldset class="border p-4 mt-5">
                    <legend class="text-primary">Imagenes del establecimiento: </legend>
                    <div class="form-group">
                        <label for="imagenes">Imagenes</label>
                        {{-- aqui se coloca dropzone --}}
                        <div id="dropzone" class="dropzone form-control"></div>
                    </div>
                </fieldset>

                {{-- Imagen dropzone --}}
                <input type="hidden" name="uuid" id="uuid" value="{{ Str::uuid()->toString() }}">

                <input type="submit" class="btn btn-primary mt-3 d-block" value="Register Establecimientos">
            </form>
        </div>
    </div>
@endsection


@section('scripts')
    <!-- Load Leaflet from CDN-->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin="" defer></script>

    <!-- Load Esri Leaflet from CDN -->
    <script src="https://unpkg.com/esri-leaflet" defer></script>

    <script src="https://unpkg.com/esri-leaflet-geocoder" defer></script>


    <!-- Dropzone -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.js"
        integrity="sha512-Mn7ASMLjh+iTYruSWoq2nhoLJ/xcaCbCzFs0ZrltJn7ksDBx+e7r5TS7Ce5WH02jDr0w5CmGgklFoP9pejfCNA=="
        crossorigin="anonymous" defer></script>
@endsection
