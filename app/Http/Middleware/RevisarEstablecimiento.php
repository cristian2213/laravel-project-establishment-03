<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RevisarEstablecimiento
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //* Comprobar que el usuario este autenticado y redirigir a la ruta edit
        $establecimiento = Auth::user()->establecimiento;
        if ($establecimiento) {
            $id = $establecimiento->id;
            return redirect()->route('establecimientos.edit', $id);
        }
        return $next($request);
    }
}
