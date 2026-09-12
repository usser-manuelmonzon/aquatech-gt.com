<?php

namespace App\Http\Controllers;

use App\Services\OficinaAguaApiService;
use Illuminate\View\View;

class QuienesSomosController extends Controller
{
    public function __construct(
        private readonly OficinaAguaApiService $api
    ) {
    }

    /**
     * Muestra la información institucional de AquaTech GT.
     */
    public function index(): View
    {
        return view('pages.quienes-somos', [
            'contenido' => $this->api->obtenerQuienesSomos(),
            'apiDisponible' => $this->api->estaHabilitada(),
        ]);
    }
}