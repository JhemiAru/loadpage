<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Categoria;
use App\Models\Ciudad;
use App\Models\Institucion;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale('es');
        View::share('categorias', Categoria::whereHas('empresas', function ($query) {
            $query->where('activo', 1);
        })->get());
        View::share('ciudades', Ciudad::whereHas('m_empresas', function ($query) {
            $query->where('activo', 1);
        })->get());
        View::share('institucion', Institucion::find(1));
        View::share('institucion2', Institucion::find(2));
    }
}
