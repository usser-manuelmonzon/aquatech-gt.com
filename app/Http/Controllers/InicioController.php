<?php

namespace App\Http\Controllers;

use App\Services\OficinaAguaApiService;
use Illuminate\View\View;

class InicioController extends Controller
{
    public function __construct(
        private readonly OficinaAguaApiService $api
    ) {
    }

    /**
     * Muestra la página principal de AquaTech GT.
     */
    public function index(): View
    {
        return view('pages.inicio', [
            'tarifas' => $this->api->obtenerTarifas(),
            'avisos' => $this->api->obtenerAvisos(),
            'preguntasFrecuentes' =>
                $this->api->obtenerPreguntasFrecuentes(),
            'apiDisponible' =>
                $this->api->estaHabilitada(),
        ]);
    }
}