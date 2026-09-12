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
                para consultar la información disponible.
            </p>
        </div>

        <div class="aquatech-card aquatech-form-card">

            @if (! $apiDisponible)
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>

                    La consulta en línea estará disponible
                    cuando se habilite la conexión con
                    Oficina del Agua.
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
                    Consultar recibo
                </button>

            </form>

            @if (
                $consultaRealizada &&
                empty($resultado)
            )
                <div class="alert alert-warning mt-4 mb-0">
                    No se encontró información con los datos proporcionados.
                </div>
            @endif

        </div>

    </div>
</section>

@endsection