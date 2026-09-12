<nav class="navbar navbar-expand-lg aquatech-navbar sticky-top">
    <div class="container">

        <a
            class="navbar-brand"
            href="{{ route('inicio') }}"
        >
            <img
                src="{{ asset('img/branding/Logo_AquatechGt.png') }}"
                alt="AquaTech GT"
                class="aquatech-navbar-logo"
            >
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#aquatechNavbar"
            aria-controls="aquatechNavbar"
            aria-expanded="false"
            aria-label="Mostrar navegación"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div
            class="collapse navbar-collapse"
            id="aquatechNavbar"
        >
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">

                <li class="nav-item">
                    <a
                        class="nav-link {{ request()->routeIs('inicio') ? 'active' : '' }}"
                        href="{{ route('inicio') }}"
                    >
                        Inicio
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link {{ request()->routeIs('recibos.*') ? 'active' : '' }}"
                        href="{{ route('recibos.consulta') }}"
                    >
                        Consulta de recibos
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link {{ request()->routeIs('contacto') ? 'active' : '' }}"
                        href="{{ route('contacto') }}"
                    >
                        Contacto
                    </a>
                </li>

            </ul>
        </div>

    </div>
</nav>