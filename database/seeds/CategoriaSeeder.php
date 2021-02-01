<?php

use App\Categoria;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::create([
            'nombre' => 'Restaurant',
            'slug' => Str::slug('Restaurant'),
        ]);

        Categoria::create([
            'nombre' => 'Cafe',
            'slug' => Str::slug('Cafe'),
        ]);

        Categoria::create([
            'nombre' => 'Hoteles',
            'slug' => Str::slug('Hoteles'),
        ]);

        Categoria::create([
            'nombre' => 'Bares',
            'slug' => Str::slug('Bares'),
        ]);

        Categoria::create([
            'nombre' => 'Hospitales',
            'slug' => Str::slug('Hospitales'),
        ]);

        Categoria::create([
            'nombre' => 'Gimnasio',
            'slug' => Str::slug('Gimnasio'),
        ]);

        Categoria::create([
            'nombre' => 'Doctor',
            'slug' => Str::slug('Doctor'),
        ]);
    }
}
