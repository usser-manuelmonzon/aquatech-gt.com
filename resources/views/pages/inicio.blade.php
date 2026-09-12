@extends('layouts.public')

@section('title', 'Inicio | AquaTech GT')

@section(
    'description',
    'Información pública, tarifas y consulta del servicio municipal de agua potable.'
)

@section('content')

<section class="aquatech-hero">
    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-7">

                <span class="aquatech-hero-badge">
                    <i class="bi bi-droplet-fill"></i>
                    Servicio municipal de agua
                </span>

                <h1 class="aquatech-hero-title">
                    Información del agua al alcance de todos
                </h1>

                <p class="aquatech-hero-description">
                    AquaTech GT facilita el acceso a información
                    relacionada con el servicio de agua potable,
                    tarifas vigentes y consulta de recibos.
                </p>

                <div class="d-flex flex-wrap gap-3 mt-4">

                    <a
                        href="{{ route('recibos.consulta') }}"
                        class="aquatech-btn-primary"
                    >
                        <i class="bi bi-receipt"></i>
                        Consultar recibo
                    </a>

                    <a
                        href="{{ route('contacto') }}"
                        class="aquatech-btn-secondary"
                    >
                        <i class="bi bi-chat-dots"></i>
                        Contacto
                    </a>

                </div>

            </div>

            <div class="col-lg-5">
                <img
                    src="{{ asset('img/branding/Logo_AquatechGt.png') }}"
                    alt="AquaTech GT"
                    class="aquatech-hero-logo"
                >
            </div>

        </div>

    </div>
</section>


@if (count($avisos) > 0)
<section class="aquatech-section">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="aquatech-section-title">
                Avisos importantes
            </h2>

            <p class="aquatech-section-description">
                Información relevante relacionada con el servicio de agua.
            </p>
        </div>

        <div class="row g-4">
            @foreach ($avisos as $aviso)
                <div class="col-md-6 col-lg-4">
                    <x-aviso-card :aviso="$aviso" />
                </div>
            @endforeach
        </div>

    </div>
</section>
@endif


<section class="aquatech-section aquatech-section-light">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="aquatech-section-title">
                Tarifas vigentes
            </h2>

            <p class="aquatech-section-description">
                Conoce las tarifas y capacidades publicadas
                para el servicio municipal de agua.
            </p>
        </div>

        @if (count($tarifas) > 0)

            <div class="row g-4">
                @foreach ($tarifas as $tarifa)
                    <div class="col-md-6 col-lg-4">
                        <x-tarifa-card :tarifa="$tarifa" />
                    </div>
                @endforeach
            </div>

        @else

            <div class="alert alert-info text-center mb-0">
                La información de tarifas estará disponible
                próximamente.
            </div>

        @endif

    </div>
</section>


<section
    id="preguntas-frecuentes"
    class="aquatech-section"
>
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="aquatech-section-title">
                Preguntas frecuentes
            </h2>

            <p class="aquatech-section-description">
                Encuentra respuestas rápidas sobre el servicio.
            </p>
        </div>

        @if (count($preguntasFrecuentes) > 0)

            <div
                class="accordion mx-auto"
                id="faqAquaTech"
                style="max-width: 850px;"
            >

                @foreach ($preguntasFrecuentes as $index => $pregunta)

                    <div class="accordion-item">

                        <h2 class="accordion-header">

                            <button
                                class="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#faq-{{ $index }}"
                            >
                                {{ $pregunta['pregunta'] ?? '' }}
                            </button>

                        </h2>

                        <div
                            id="faq-{{ $index }}"
                            class="accordion-collapse collapse"
                            data-bs-parent="#faqAquaTech"
                        >
                            <div class="accordion-body">
                                {{ $pregunta['respuesta'] ?? '' }}
                            </div>
                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <p class="text-center text-secondary mb-0">
                Las preguntas frecuentes se publicarán próximamente.
            </p>

        @endif

    </div>
</section>

@endsection