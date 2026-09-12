@props([
    'aviso',
])

<article class="aquatech-card">

    <div class="aquatech-icon-box">
        <i class="bi bi-megaphone"></i>
    </div>

    <h3 class="aquatech-card-title h5">
        {{ $aviso['titulo'] ?? 'Aviso importante' }}
    </h3>

    <p class="mb-0 text-secondary">
        {{ $aviso['contenido'] ?? '' }}
    </p>

</article>