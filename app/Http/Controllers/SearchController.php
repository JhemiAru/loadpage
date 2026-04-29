<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\Categoria;
use App\Models\Institucion;
use App\Models\Ciudad;

class SearchController extends Controller
{
    /* Genera variaciones singular/plural simples*/
    private function keywordVariants($word)
    {
        $variants = [$word];
        // singular -> plural
        $variants[] = $word . 's';
        $variants[] = $word . 'es';
        // plural -> singular
        if (str_ends_with($word, 'es')) {
            $variants[] = substr($word, 0, -2);
        }
        if (str_ends_with($word, 's')) {
            $variants[] = substr($word, 0, -1);
        }
        return array_unique($variants);
    }

    public function show(Request $request)
    {
        $query = trim(mb_strtolower($request->input('query', '')));        
        $stopWords = ['en','de','la','las','el','los','y','o','para','con','a'];
        $ciudad = Ciudad::all()->first(function ($c) use ($query) {
            return str_contains(
                $query,
                mb_strtolower($c->nombre)
            );
        });

        // separar palabras
        $words = collect(preg_split('/\s+/', $query))
            ->filter()
            // quitar stopwords
            ->reject(fn($w) => in_array($w, $stopWords))
            // quitar palabras de ciudad
            ->reject(function ($w) use ($ciudad) {

                if (!$ciudad) {
                    return false;
                }

                return str_contains(
                    mb_strtolower($ciudad->nombre),
                    $w
                );
            })

            ->values();

        $empresas = Empresa::query()
            ->with(['categoria', 'ciudad'])
            ->where('activo', 1);

        // filtro ciudad
        if ($ciudad) {
            $empresas->where('ciudad_id', $ciudad->id);
        }

        // filtro keywords
        if ($words->count()) {
            $empresas->where(function ($queryBuilder) use ($words) {
                foreach ($words as $word) {
                    $variants = $this->keywordVariants($word);
                    $queryBuilder->where(function ($q) use ($variants) {
                        foreach ($variants as $variant) {
                            $q->orWhereRaw(
                                'LOWER(nombre) LIKE ?',
                                ["%{$variant}%"]
                            )
                            ->orWhereRaw(
                                'LOWER(descripcion) LIKE ?',
                                ["%{$variant}%"]
                            )
                            ->orWhereHas('categoria', function ($cat) use ($variant) {
                                $cat->whereRaw(
                                    'LOWER(nombre) LIKE ?',
                                    ["%{$variant}%"]
                                )
                                ->orWhereRaw(
                                    'LOWER(descripcion) LIKE ?',
                                    ["%{$variant}%"]
                                );
                            });
                        }
                    });
                }
            });
        }
        $empresas = $empresas->paginate(18)->withQueryString();
        $countEmpresas = $empresas->total();
        return view('empresas', compact('empresas', 'query','countEmpresas'));
    }

    /*AUTOCOMPLETE */
    public function data(Request $request)
    {
        $query = trim(mb_strtolower($request->input('query', '')));
        if (strlen($query) < 2) {
            return response()->json([]);
        }
        $stopWords = ['en','de','la','las','el','los','y','o','para','con','a'];
        $ciudad = Ciudad::all()->first(function ($c) use ($query) {
            return str_contains(
                $query,
                mb_strtolower($c->nombre)
            );
        });
        $words = collect(preg_split('/\s+/', $query))
            ->filter()
            // quitar palabras vacías
            ->reject(fn($w) => in_array($w, $stopWords))
            // quitar nombre de ciudad
            ->reject(function ($w) use ($ciudad) {
                if (!$ciudad) {
                    return false;
                }
                return str_contains(
                    mb_strtolower($ciudad->nombre),
                    $w
                );
            })

            ->values();

        if ($words->isEmpty()) {
            return response()->json([]);
        }

        $empresas = Empresa::query()
            ->with(['categoria', 'ciudad'])
            ->where('activo', 1);

        // filtro obligatorio por ciudad
        if ($ciudad) {
            $empresas->where('ciudad_id', $ciudad->id);
        }

        // filtro obligatorio por keywords
        $empresas->where(function ($queryBuilder) use ($words) {

            foreach ($words as $word) {

                $variants = $this->keywordVariants($word);

                $queryBuilder->where(function ($q) use ($variants) {

                    foreach ($variants as $variant) {

                        $q->orWhereRaw(
                            'LOWER(nombre) LIKE ?',
                            ["%{$variant}%"]
                        )

                        ->orWhereRaw(
                            'LOWER(descripcion) LIKE ?',
                            ["%{$variant}%"]
                        )

                        ->orWhereHas('categoria', function ($cat) use ($variant) {

                            $cat->whereRaw(
                                'LOWER(nombre) LIKE ?',
                                ["%{$variant}%"]
                            )

                            ->orWhereRaw(
                                'LOWER(descripcion) LIKE ?',
                                ["%{$variant}%"]
                            );
                        });
                    }
                });
            }
        });

        $empresas = $empresas->get(['id','nombre','slug','imagen','descuento']);

        return response()->json(
            $empresas->map(function ($e) {
                return [
                    'id'        => $e->id,
                    'nombre'    => $e->nombre,
                    'slug'      => $e->slug,
                    'imagen'    => $e->imagen,
                    'descuento' => $e->descuento,
                    'categoria' => $e->categoria->nombre ?? null,
                    'ciudad'    => $e->ciudad->nombre ?? null,
                ];
            })
        );
    }


    public function categoria(Request $request, $slug)
    {
        $categoria = Categoria::where('slug', $slug)
            ->firstOrFail();

        $query = trim(
            mb_strtolower($request->input('query', ''))
        );

        $stopWords = [
            'en','de','la','las',
            'el','los','y','o',
            'para','con','a'
        ];

        $words = collect(
            preg_split('/\s+/', $query)
        )
        ->filter()

        ->reject(fn($w) =>
            in_array($w, $stopWords)
        )

        ->values();

        $empresas = Empresa::query()

            ->with(['categoria', 'ciudad'])

            ->where('activo', 1)

            // FILTRO POR CATEGORIA
            ->where('categoria_id', $categoria->id);

        // búsqueda
        if ($words->count()) {

            $empresas->where(function ($queryBuilder)
                use ($words) {

                foreach ($words as $word) {

                    $variants =
                        $this->keywordVariants($word);

                    $queryBuilder->where(function ($q)
                        use ($variants) {

                        foreach ($variants as $variant) {

                            $q->orWhereRaw(
                                'LOWER(nombre) LIKE ?',
                                ["%{$variant}%"]
                            )

                            ->orWhereRaw(
                                'LOWER(descripcion) LIKE ?',
                                ["%{$variant}%"]
                            );
                        }
                    });
                }
            });
        }

        $empresas = $empresas

            ->orderBy('prioridad', 'asc')

            ->paginate(18)

            ->withQueryString();

        $countEmpresas = $empresas->total();

        return view('categorias', compact(
            'categoria',
            'empresas',
            'countEmpresas',
            'query'
        ));
    }

    public function categoriaData(Request $request, $slug)
    {
        $categoria = Categoria::where('slug', $slug)
            ->firstOrFail();

        $query = trim(
            mb_strtolower($request->input('query', ''))
        );

        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $stopWords = ['en','de','la','las','el','los','y','o','para','con','a'];
        $words = collect(
            preg_split('/\s+/', $query)
        )
        ->filter()
        ->reject(fn($w) => in_array($w, $stopWords))
        ->values();

        if ($words->isEmpty()) {
            return response()->json([]);
        }

        $empresas = Empresa::query()
            ->with(['categoria', 'ciudad'])
            ->where('activo', 1)
            ->where('categoria_id', $categoria->id);

        $empresas->where(function ($queryBuilder) use ($words) {

            foreach ($words as $word) {

                $variants = $this->keywordVariants($word);

                $queryBuilder->where(function ($q) use ($variants) {

                    foreach ($variants as $variant) {

                        $q->orWhereRaw(
                            'LOWER(nombre) LIKE ?',
                            ["%{$variant}%"]
                        )

                        ->orWhereRaw(
                            'LOWER(descripcion) LIKE ?',
                            ["%{$variant}%"]
                        );
                    }
                });
            }
        });

        $empresas = $empresas
            ->limit(6)
            ->get([
                'id',
                'nombre',
                'slug',
                'imagen',
                'descuento'
            ]);

        return response()->json(

            $empresas->map(function ($e) {

                return [

                    'id' => $e->id,

                    'nombre' => $e->nombre,

                    'slug' => $e->slug,

                    'imagen' => $e->imagen,

                    'descuento' => $e->descuento,

                    'categoria' =>
                        $e->categoria->nombre ?? null,

                    'ciudad' =>
                        $e->ciudad->nombre ?? null,
                ];
            })
        );
    }
}