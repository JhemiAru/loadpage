<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Categoria;
use App\Institucion;
use App\Ciudad;


class SearchController extends Controller
{
    // public function  show(Request $request)
    // {
    // 	$query=$request->input('query');
    // 	$institucion=Institucion::first();
    //     $categorias=Categoria::all();
    //     $ciudades=Ciudad::all();
    // 	$empresas=Empresa::where('nombre','like',"%$query%")->where('activo',1 )->get();
    	
    // 	if ($empresas->count()==1) {
    // 		$nombre = $empresas->first()->slug;
    // 		return redirect("empresa/$nombre"); //'empresa/'.$nombre
    		
    // 	}
    // 	return view('inicio.show')->with(compact('empresas','query','institucion','categorias','ciudades'));
    // }

    // public function data()
    // {   $empresas=Empresa::where('activo',1 )->pluck('nombre');
    // 	return $empresas;
    // }

public function show(Request $request)
{
    $query = trim($request->input('query'));

    $empresas = Empresa::query()

        ->with(['categoria', 'ciudad'])

        ->where('activo', 1)

        ->when($query, function ($q) use ($query) {

            $q->where(function ($subquery) use ($query) {

                $subquery->where('nombre', 'LIKE', "%{$query}%")
                    ->orWhere('descripcion', 'LIKE', "%{$query}%")
                    ->orWhere('direccion', 'LIKE', "%{$query}%");

            })

            ->orWhereHas('categoria', function ($categoria) use ($query) {

                $categoria->where(
                    'nombre',
                    'LIKE',
                    "%{$query}%"
                );

            });

        })

        ->paginate(12);

    return view('empresas', compact(
        'empresas'
    ));
}

	public function data(Request $request)
	{
		$query = trim($request->input('query'));

		if (!$query) {
			return response()->json([]);
		}

		$empresas = Empresa::query()

			->where('activo', 1)

			->where(function ($q) use ($query) {

				$q->where('nombre', 'LIKE', "%{$query}%")

				->orWhereHas('categoria', function ($categoria) use ($query) {

						$categoria->where(
							'nombre',
							'LIKE',
							"%{$query}%"
						);

				});

			})

			->limit(5)

			->get([
				'id',
				'nombre',
				'slug',
				'imagen'
			]);

		return response()->json($empresas);
	}
}
