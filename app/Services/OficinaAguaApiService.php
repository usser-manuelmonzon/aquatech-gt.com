<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class OficinaAguaApiService
{
    private string $baseUrl;

    private int $timeout;

    private bool $enabled;

    public function __construct()
    {
        $this->baseUrl = rtrim(
            (string) config(
                'services.oficina_agua.base_url',
                ''
            ),
            '/'
        );

        $this->timeout = (int) config(
            'services.oficina_agua.timeout',
            5
        );

        $this->enabled = (bool) config(
            'services.oficina_agua.enabled',
            false
        );
    }

    public function estaHabilitada(): bool
    {
        return $this->enabled
            && $this->baseUrl !== '';
    }

    public function obtenerTarifas(): array
    {
        return $this->get('/tarifas');
    }

    public function obtenerAvisos(): array
    {
        return $this->get('/avisos');
    }

    public function obtenerPreguntasFrecuentes(): array
    {
        return $this->get('/preguntas-frecuentes');
    }

    public function obtenerQuienesSomos(): array
    {
        return $this->get('/quienes-somos');
    }

    public function obtenerContacto(): array
    {
        return $this->get('/contacto');
    }

    public function consultarRecibo(
        string $dpi,
        string $numeroContador
    ): array {
        if (! $this->estaHabilitada()) {
            return [];
        }

        try {
            $response = Http::acceptJson()
                ->timeout($this->timeout)
                ->post(
                    $this->baseUrl . '/consulta-recibo',
                    [
                        'dpi' => $dpi,
                        'numero_contador' => $numeroContador,
                    ]
                );

            if (! $response->successful()) {
                return [];
            }

            return $response->json() ?? [];
        } catch (ConnectionException) {
            return [];
        }
    }

    private function get(string $endpoint): array
    {
        if (! $this->estaHabilitada()) {
            return [];
        }

        try {
            $response = Http::acceptJson()
                ->timeout($this->timeout)
                ->get(
                    $this->baseUrl . $endpoint
                );

            if (! $response->successful()) {
                return [];
            }

            return $response->json() ?? [];
        } catch (ConnectionException) {
            return [];
        }
    }
}