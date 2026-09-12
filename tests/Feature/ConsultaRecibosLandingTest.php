<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ConsultaRecibosLandingTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config([
            'services.oficina_agua.enabled' => true,
            'services.oficina_agua.base_url' =>
                'http://oficina-agua.test/api/public',
            'services.oficina_agua.timeout' => 5,
        ]);
    }

    public function test_muestra_mensaje_si_no_existen_recibos(): void
    {
        Http::fake([
            'http://oficina-agua.test/api/public/consulta-recibo' =>
                Http::response(
                    [
                        'message' =>
                            'No se encontró información con los datos proporcionados.',
                    ],
                    404
                ),
        ]);

        $response = $this->post(
            route('recibos.consultar'),
            [
                'dpi' => '1234567890123',
                'numero_contador' => 'CONT-0001',
            ]
        );

        $response
            ->assertOk()
            ->assertSee(
                'No se encontró información con los datos proporcionados.'
            );
    }

    public function test_muestra_recibo_pendiente_devuelto_por_api(): void
    {
        Http::fake([
            'http://oficina-agua.test/api/public/consulta-recibo' =>
                Http::response([
                    'numero_contador' => 'CONT-0001',

                    'recibos' => [
                        [
                            'numero_recibo' => 'REC-0001',
                            'periodo' => '2026-09',
                            'fecha_emision' => '2026-09-05',
                            'fecha_vencimiento' => '2026-09-10',
                            'estado' => 'PENDIENTE',

                            'lectura' => [
                                'anterior' => 100,
                                'actual' => 118,
                                'consumo_m3' => 18,
                            ],

                            'monto' => 40,
                            'mora_actual' => 7,
                            'total_pagar' => 47,
                            'pago' => null,
                        ],
                    ],
                ]),
        ]);

        $response = $this->post(
            route('recibos.consultar'),
            [
                'dpi' => '1234567890123',
                'numero_contador' => 'CONT-0001',
            ]
        );

        $response
            ->assertOk()
            ->assertSee('Recibos encontrados')
            ->assertSee('CONT-0001')
            ->assertSee('REC-0001')
            ->assertSee('2026-09')
            ->assertSee('PENDIENTE')
            ->assertSee('18.000')
            ->assertSee('Q40.00')
            ->assertSee('Q7.00')
            ->assertSee('Q47.00');
    }

    public function test_muestra_informacion_publica_de_recibo_pagado(): void
    {
        Http::fake([
            'http://oficina-agua.test/api/public/consulta-recibo' =>
                Http::response([
                    'numero_contador' => 'CONT-0002',

                    'recibos' => [
                        [
                            'numero_recibo' => 'REC-0002',
                            'periodo' => '2026-09',
                            'fecha_emision' => '2026-09-05',
                            'fecha_vencimiento' => '2026-09-10',
                            'estado' => 'PAGADO',

                            'lectura' => [
                                'anterior' => 150,
                                'actual' => 162,
                                'consumo_m3' => 12,
                            ],

                            'monto' => 30,
                            'mora_actual' => 0,
                            'total_pagar' => null,

                            'pago' => [
                                'monto' => 30,
                                'fecha' => '2026-09-06 09:30:00',
                                'metodo' => 'Efectivo',
                            ],
                        ],
                    ],
                ]),
        ]);

        $response = $this->post(
            route('recibos.consultar'),
            [
                'dpi' => '1234567890123',
                'numero_contador' => 'CONT-0002',
            ]
        );

        $response
            ->assertOk()
            ->assertSee('REC-0002')
            ->assertSee('PAGADO')
            ->assertSee('Pago registrado')
            ->assertSee('Efectivo')
            ->assertSee('Q30.00');
    }

    public function test_valida_dpi_antes_de_consultar_api(): void
    {
        Http::fake();

        $response = $this->post(
            route('recibos.consultar'),
            [
                'dpi' => '12345',
                'numero_contador' => 'CONT-0001',
            ]
        );

        $response
            ->assertSessionHasErrors('dpi');

        Http::assertNothingSent();
    }
}