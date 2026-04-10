<!-- para mostrar las alertas de exito o error en las vistas, se utiliza el siguiente código en el archivo resources/views/partials/alerts.blade.php -->

<!-- ESTA SESIÓN MOSTARÁ LAAS ALERTAS DE EXITO -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show alerta-auto">
        <strong>¡Éxito!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
<!-- ESTA SESIÓN MOSTARÁ LAAS ALERTAS DE ERROR -->
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show alerta-auto">
        <strong>¡Error!</strong> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- ESTA SESIÓN MOSTARÁ LAAS ALERTAS DE ADVERTENCIA -->
@if(session('warning'))
    <div class="alert alert-warning alert-dismissible fade show alerta-auto">
        <strong>¡Advertencia!</strong> {{ session('warning') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- para duración del tiempo de alerta--->
<script>
    setTimeout(function() {
        document.querySelectorAll('.alerta-auto').forEach(function(alerta){
            alerta.classList.remove('show');
            setTimeout(() => alerta.remove(), 500);
        });
    }, 4000);
</script>