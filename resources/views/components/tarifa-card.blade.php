@props([
    'tarifa',
])

<article class="aquatech-card">

    <div class="aquatech-icon-box">
        <i class="bi bi-droplet-half"></i>
    </div>

    <h3 class="aquatech-card-title h5">
        {{ $tarifa['tipo'] ?? 'Tarifa de servicio' }}
    </h3>

    @isset($tarifa['capacidad'])
        <p class="mb-2">
            <strong>Capacidad:</strong>
            {{ $tarifa['capacidad'] }} m³
        </p>
    @endisset

    @isset($tarifa['precio_m3'])
        <p class="mb-2">
            <strong>Precio:</strong>
            Q{{ number_format((float) $tarifa['precio_m3'], 2) }}
        </p>
    @endisset

    @isset($tarifa['precio_exceso_m3'])
        <p class="mb-0">
            <strong>Exceso:</strong>
            Q{{ number_format((float) $tarifa['precio_exceso_m3'], 2) }}
            por m³
        </p>
    @endisset

</article>