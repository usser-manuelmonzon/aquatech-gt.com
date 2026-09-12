@extends('layouts.public')

@section('title', 'Consulta de recibos | AquaTech GT')

@section('content')

<section class="aquatech-section aquatech-section-light">
    <div class="container">

        <div class="text-center mb-5">
            <h1 class="aquatech-section-title">
                Consulta de recibos
            </h1>

            <p class="aquatech-section-description">
                Ingresa el DPI del titular y el número de contador
                para consultar tus recibos disponibles.
            </p>
        </div>

        <div class="aquatech-card aquatech-form-card">

            @if (! $apiDisponible)
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    La consulta en línea no se encuentra disponible
                    temporalmente.
                </div>
            @endif

            <form
                method="POST"
                action="{{ route('recibos.consultar') }}"
            >
                @csrf

                <div class="mb-3">
                    <label
                        for="dpi"
                        class="form-label fw-semibold"
                    >
                        DPI del titular
                    </label>

                    <input
                        type="text"
                        id="dpi"
                        name="dpi"
                        class="form-control @error('dpi') is-invalid @enderror"
                        value="{{ old('dpi') }}"
                        maxlength="13"
                        inputmode="numeric"
                        autocomplete="off"
                        placeholder="13 dígitos"
                        required
                    >

                    @error('dpi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label
                        for="numero_contador"
                        class="form-label fw-semibold"
                    >
                        Número de contador
                    </label>

                    <input
                        type="text"
                        id="numero_contador"
                        name="numero_contador"
                        class="form-control @error('numero_contador') is-invalid @enderror"
                        value="{{ old('numero_contador') }}"
                        maxlength="50"
                        autocomplete="off"
                        placeholder="Ej. CONT-0001"
                        required
                    >

                    @error('numero_contador')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button
                    type="submit"
                    class="aquatech-btn-primary w-100"
                    @disabled(! $apiDisponible)
                >
                    <i class="bi bi-search"></i>
                    Consultar recibos
                </button>
            </form>

        </div>

        @if ($consultaRealizada)

            @if (empty($resultado) || empty($resultado['recibos'] ?? []))

                <div class="aquatech-result-container">
                    <div class="alert alert-warning mb-0">
                        <i class="bi bi-exclamation-circle me-2"></i>
                        No se encontró información con los datos proporcionados.
                    </div>
                </div>

            @else

                <div class="aquatech-result-container">

                    <div class="d-flex flex-column flex-md-row
                                justify-content-between align-items-md-center
                                gap-2 mb-4">

                        <div>
                            <h2 class="aquatech-result-title mb-1">
                                Recibos encontrados
                            </h2>

                            <p class="text-muted mb-0">
                                Contador:
                                <strong>
                                    {{ $resultado['numero_contador'] }}
                                </strong>
                            </p>
                        </div>

                        <span class="badge aquatech-count-badge">
                            {{ count($resultado['recibos']) }}
                            {{ count($resultado['recibos']) === 1
                                ? 'recibo'
                                : 'recibos' }}
                        </span>

                    </div>

                    <div class="row g-4">

                        @foreach ($resultado['recibos'] as $recibo)

                            <div class="col-12 col-lg-6">

                                <article class="aquatech-receipt-card">

                                    <div class="aquatech-receipt-header">

                                        <div>
                                            <span class="aquatech-receipt-label">
                                                Recibo
                                            </span>

                                            <h3 class="aquatech-receipt-number">
                                                {{ $recibo['numero_recibo'] }}
                                            </h3>
                                        </div>

                                        @php
                                            $estado = $recibo['estado'] ?? '';

                                            $estadoClase = match ($estado) {
                                                'PAGADO' => 'aquatech-status-paid',
                                                'PENDIENTE' => 'aquatech-status-pending',
                                                'ANULADO' => 'aquatech-status-cancelled',
                                                default => 'aquatech-status-default',
                                            };
                                        @endphp

                                        <span class="aquatech-status {{ $estadoClase }}">
                                            {{ $estado }}
                                        </span>

                                    </div>

                                    <div class="aquatech-receipt-grid">

                                        <div>
                                            <span>Período</span>
                                            <strong>
                                                {{ $recibo['periodo'] ?? '—' }}
                                            </strong>
                                        </div>

                                        <div>
                                            <span>Emisión</span>
                                            <strong>
                                                {{ $recibo['fecha_emision'] ?? '—' }}
                                            </strong>
                                        </div>

                                        <div>
                                            <span>Vencimiento</span>
                                            <strong>
                                                {{ $recibo['fecha_vencimiento'] ?? '—' }}
                                            </strong>
                                        </div>

                                        <div>
                                            <span>Consumo</span>
                                            <strong>
                                                {{ number_format(
                                                    (float) data_get(
                                                        $recibo,
                                                        'lectura.consumo_m3',
                                                        0
                                                    ),
                                                    3
                                                ) }}
                                                m³
                                            </strong>
                                        </div>

                                    </div>

                                    <div class="aquatech-receipt-amounts">

                                        <div>
                                            <span>Monto</span>
                                            <strong>
                                                Q{{ number_format(
                                                    (float) ($recibo['monto'] ?? 0),
                                                    2
                                                ) }}
                                            </strong>
                                        </div>

                                        @if (($recibo['estado'] ?? '') === 'PENDIENTE')

                                            <div>
                                                <span>Mora actual</span>
                                                <strong>
                                                    Q{{ number_format(
                                                        (float) (
                                                            $recibo['mora_actual']
                                                            ?? 0
                                                        ),
                                                        2
                                                    ) }}
                                                </strong>
                                            </div>

                                            <div class="aquatech-receipt-total">
                                                <span>Total a pagar</span>
                                                <strong>
                                                    Q{{ number_format(
                                                        (float) (
                                                            $recibo['total_pagar']
                                                            ?? 0
                                                        ),
                                                        2
                                                    ) }}
                                                </strong>
                                            </div>

                                        @endif

                                    </div>

                                    @if (! empty($recibo['pago']))

                                        <div class="aquatech-payment-info">

                                            <div>
                                                <i class="bi bi-check-circle-fill"></i>

                                                Pago registrado
                                            </div>

                                            <small>
                                                {{ data_get(
                                                    $recibo,
                                                    'pago.fecha',
                                                    ''
                                                ) }}

                                                ·

                                                {{ data_get(
                                                    $recibo,
                                                    'pago.metodo',
                                                    ''
                                                ) }}

                                                ·

                                                Q{{ number_format(
                                                    (float) data_get(
                                                        $recibo,
                                                        'pago.monto',
                                                        0
                                                    ),
                                                    2
                                                ) }}
                                            </small>

                                        </div>

                                    @endif

                                </article>

                            </div>

                        @endforeach

                    </div>

                </div>

            @endif

        @endif

    </div>
</section>

@endsection