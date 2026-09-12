<footer class="aquatech-footer">
    <div class="container">

        <div class="row g-4">

            <div class="col-lg-4">
                <img
                    src="{{ asset('img/branding/Logo_AquatechGt.png') }}"
                    alt="AquaTech GT"
                    class="aquatech-footer-logo"
                >

                <p class="mb-0">
                    Plataforma pública orientada a facilitar el acceso
                    a información del servicio municipal de agua potable.
                </p>
            </div>

            <div class="col-md-6 col-lg-4">
                <h2 class="aquatech-footer-title">
                    Enlaces
                </h2>

                <a
                    href="{{ route('inicio') }}"
                    class="aquatech-footer-link"
                >
                    Inicio
                </a>

                <a
                    href="{{ route('quienes-somos') }}"
                    class="aquatech-footer-link"
                >
                    Quiénes somos
                </a>

                <a
                    href="{{ route('recibos.consulta') }}"
                    class="aquatech-footer-link"
                >
                    Consulta de recibos
                </a>

                <a
                    href="{{ route('inicio') }}#preguntas-frecuentes"
                    class="aquatech-footer-link"
                >
                    Preguntas frecuentes
                </a>

                <a
                    href="{{ route('contacto') }}"
                    class="aquatech-footer-link"
                >
                    Contacto
                </a>
            </div>

            <div class="col-md-6 col-lg-4">
                <h2 class="aquatech-footer-title">
                    Mantente en contacto
                </h2>

                <p class="mb-2">
                    <i class="bi bi-telephone me-2"></i>
                    Información disponible próximamente
                </p>

                <p class="mb-2">
                    <i class="bi bi-envelope me-2"></i>
                    Información disponible próximamente
                </p>

                <p class="mb-0">
                    <i class="bi bi-geo-alt me-2"></i>
                    Oficina municipal de agua potable
                </p>
            </div>

        </div>

        <div class="aquatech-footer-bottom text-center">
            © {{ date('Y') }} AquaTech GT.
            Todos los derechos reservados.
        </div>

    </div>
</footer>