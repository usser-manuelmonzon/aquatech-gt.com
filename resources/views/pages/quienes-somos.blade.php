@extends('layouts.public')

@section('title', 'Quiénes somos | AquaTech GT')

@section('content')

<section class="aquatech-section">
    <div class="container">

        <div class="text-center mb-5">
            <h1 class="aquatech-section-title">
                Quiénes somos
            </h1>

            <p class="aquatech-section-description">
                Conoce nuestra historia, propósito y compromiso
                con la gestión del servicio de agua.
            </p>
        </div>

        @if (! empty($contenido))

            <div class="row g-4">

                <div class="col-12">
                    <article class="aquatech-card">

                        <div class="aquatech-icon-box">
                            <i class="bi bi-buildings"></i>
                        </div>

                        <h2 class="aquatech-card-title">
                            Nuestra historia
                        </h2>

                        <p class="mb-0">
                            {{ $contenido['historia'] ?? '' }}
                        </p>

                    </article>
                </div>

                <div class="col-md-6">
                    <article class="aquatech-card">

                        <div class="aquatech-icon-box">
                            <i class="bi bi-bullseye"></i>
                        </div>

                        <h2 class="aquatech-card-title">
                            Misión
                        </h2>

                        <p class="mb-0">
                            {{ $contenido['mision'] ?? '' }}
                        </p>

                    </article>
                </div>

                <div class="col-md-6">
                    <article class="aquatech-card">

                        <div class="aquatech-icon-box">
                            <i class="bi bi-eye"></i>
                        </div>

                        <h2 class="aquatech-card-title">
                            Visión
                        </h2>

                        <p class="mb-0">
                            {{ $contenido['vision'] ?? '' }}
                        </p>

                    </article>
                </div>

                <div class="col-12">
                    <article class="aquatech-card">

                        <div class="aquatech-icon-box">
                            <i class="bi bi-stars"></i>
                        </div>

                        <h2 class="aquatech-card-title">
                            Qué nos diferencia
                        </h2>

                        <p class="mb-0">
                            {{ $contenido['diferenciadores'] ?? '' }}
                        </p>

                    </article>
                </div>

            </div>

        @else

            <div class="alert alert-info text-center">
                La información institucional se publicará
                próximamente.
            </div>

        @endif

    </div>
</section>

@endsection