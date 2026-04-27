<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\Categoria;
use App\Models\Institucion;
use App\Models\Ciudad;

class SearchController extends Controller
{
    public function show(Request $request)
    {
        $query = trim($request->input('query', ''));

        $words = collect(
            preg_split('/\s+/', mb_strtolower($query))
        )->filter()->unique();

        // Detectar ciudad
        $ciudadEncontrada = Ciudad::whereRaw(
            'LOWER(nombre) LIKE ?',
            ['%' . mb_strtolower($query) . '%']
        )->first();

        // Palabras ignoradas
        $ignoreWords = [
            'en',
            'de',
            'la',
            'el',
            'las',
            'los',
            'un',
            'una',
            'y'
        ];

        // Normalizar palabras
        $keywords = $words
            ->reject(fn($w) => in_array($w, $ignoreWords))
            ->map(function ($word) {

                // singular/plural simple
                if (mb_substr($word, -2) === 'es') {
                    $word = mb_substr($word, 0, -2);
                } elseif (mb_substr($word, -1) === 's') {
                    $word = mb_substr($word, 0, -1);
                }

                return $word;
            })

            // quitar nombre de ciudad detectada
            ->reject(function ($word) use ($ciudadEncontrada) {

                if (!$ciudadEncontrada) {
                    return false;
                }

                return str_contains(
                    mb_strtolower($ciudadEncontrada->nombre),
                    $word
                );
            });

        $empresas = Empresa::query()
            ->with(['categoria', 'ciudad'])
            ->where('activo', 1);

        // FILTRO OBLIGATORIO DE CIUDAD
        if ($ciudadEncontrada) {

            $empresas->where('ciudad_id', $ciudadEncontrada->id);
        }

        // FILTRO OBLIGATORIO DE PALABRAS
        if ($keywords->count()) {

            $empresas->where(function ($q) use ($keywords) {

                foreach ($keywords as $word) {

                    $q->where(function ($sub) use ($word) {

                        $sub->whereRaw(
                            'LOWER(nombre) LIKE ?',
                            ["%{$word}%"]
                        )

                        ->orWhereRaw(
                            'LOWER(descripcion) LIKE ?',
                            ["%{$word}%"]
                        )

                        ->orWhereHas('categoria', function ($cat) use ($word) {

                            $cat->whereRaw(
                                'LOWER(nombre) LIKE ?',
                                ["%{$word}%"]
                            )

                            ->orWhereRaw(
                                'LOWER(descripcion) LIKE ?',
                                ["%{$word}%"]
                            );
                        });
                    });
                }
            });
        }

        $empresas = $empresas
            ->paginate(12)
            ->withQueryString();

        return view('empresas', compact('empresas', 'query'));
    }

    /**
     * Sugerencias de autocompletado (JSON)
     */
    public function data(Request $request)
    {
        $query = trim($request->input('query', ''));

        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $words = collect(
            preg_split('/\s+/', mb_strtolower($query))
        )->filter()->unique();

        $empresas = Empresa::query()
            ->where('activo', 1)

            ->where(function ($q) use ($words) {

                foreach ($words as $word) {

                    $q->orWhereRaw('LOWER(nombre) LIKE ?', ["%{$word}%"])

                        ->orWhereHas('categoria', function ($cat) use ($word) {

                            $cat->whereRaw('LOWER(nombre) LIKE ?', ["%{$word}%"])
                                ->orWhereRaw('LOWER(descripcion) LIKE ?', ["%{$word}%"]);
                        })

                        ->orWhereHas('ciudad', function ($ciudad) use ($word) {

                            $ciudad->whereRaw('LOWER(nombre) LIKE ?', ["%{$word}%"]);
                        });
                }
            })

            ->with(['categoria', 'ciudad'])
            ->limit(6)
            ->get([
                'id',
                'nombre',
                'slug',
                'imagen',
                'descuento'
            ]);

        return response()->json($empresas->map(function ($e) {

            return [
                'id'        => $e->id,
                'nombre'    => $e->nombre,
                'slug'      => $e->slug,
                'imagen'    => $e->imagen,
                'descuento' => $e->descuento,
                'categoria' => $e->categoria->nombre ?? null,
                'ciudad'    => $e->ciudad->nombre ?? null,
            ];
        }));
    }
}