<?php

namespace App\Http\Controllers;

use App\Services\OficinaAguaApiService;
use Illuminate\View\View;

class ContactoController extends Controller
{
    public function __construct(
        private readonly OficinaAguaApiService $api
    ) {
    }

    /**
     * Muestra la información pública de contacto.
     */
    public function index(): View
    {
        return view('pages.contacto', [
            'contacto' => $this->api->obtenerContacto(),
            'apiDisponible' => $this->api->estaHabilitada(),
        ]);
    }
}