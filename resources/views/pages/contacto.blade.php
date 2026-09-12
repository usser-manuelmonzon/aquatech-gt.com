@extends('layouts.public')

@section('title', 'Contacto | AquaTech GT')

@section('content')

<section class="aquatech-section aquatech-section-light">
    <div class="container">

        <div class="text-center mb-5">
            <h1 class="aquatech-section-title">
                Contacto
            </h1>

            <p class="aquatech-section-description">
                Consulta los medios oficiales y horarios
                de atención de la Oficina del Agua.
            </p>
        </div>

        @if (! empty($contacto))

            <div class="row g-4 justify-content-center">

                <div class="col-md-6 col-lg-4">
                    <article class="aquatech-card">

                        <div class="aquatech-icon-box">
                            <i class="bi bi-telephone"></i>
                        </div>

                        <h2 class="aquatech-card-title h5">
                            Teléfono
                        </h2>

                        <p class="mb-0">
                            {{ $contacto['telefono'] ?? 'No disponible' }}
                        </p>

                    </article>
                </div>

                <div class="col-md-6 col-lg-4">
                    <article class="aquatech-card">

                        <div class="aquatech-icon-box">
                            <i class="bi bi-envelope"></i>
                        </div>

                        <h2 class="aquatech-card-title h5">
                            Correo electrónico
                        </h2>

                        <p class="mb-0">
                            {{ $contacto['correo'] ?? 'No disponible' }}
                        </p>

                    </article>
                </div>

                <div class="col-md-6 col-lg-4">
                    <article class="aquatech-card">

                        <div class="aquatech-icon-box">
                            <i class="bi bi-clock"></i>
                        </div>

                        <h2 class="aquatech-card-title h5">
                            Horario
                        </h2>

                        <p class="mb-0">
                            {{ $contacto['horario'] ?? 'No disponible' }}
                        </p>

                    </article>
                </div>

                @if (! empty($contacto['direccion'] ?? null))
                    <div class="col-lg-8">
                        <article class="aquatech-card">

                            <div class="aquatech-icon-box">
                                <i class="bi bi-geo-alt"></i>
                            </div>

                            <h2 class="aquatech-card-title h5">
                                Dirección
                            </h2>

                            <p class="mb-0">
                                {{ $contacto['direccion'] }}
                            </p>

                        </article>
                    </div>
                @endif

            </div>

        @else

            <div class="alert alert-info text-center">
                La información oficial de contacto
                estará disponible próximamente.
            </div>

        @endif

    </div>
</section>

@endsection