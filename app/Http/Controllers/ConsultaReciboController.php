<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConsultarReciboRequest;
use App\Services\OficinaAguaApiService;
use Illuminate\View\View;

class ConsultaReciboController extends Controller
{
    public function __construct(
        private readonly OficinaAguaApiService $api
    ) {
    }

    /**
     * Muestra el formulario público para consultar recibos.
     */
    public function index(): View
    {
        return view('pages.consulta-recibos', [
            'resultado' => null,
            'consultaRealizada' => false,
            'apiDisponible' => $this->api->estaHabilitada(),
        ]);
    }

    /**
     * Procesa la consulta de un recibo.
     */
    public function consultar(
        ConsultarReciboRequest $request
    ): View {
        $datos = $request->validated();

        $resultado = $this->api->consultarRecibo(
            $datos['dpi'],
            $datos['numero_contador']
        );

        return view('pages.consulta-recibos', [
            'resultado' => $resultado,
            'consultaRealizada' => true,
            'apiDisponible' => $this->api->estaHabilitada(),
        ]);
    }
}