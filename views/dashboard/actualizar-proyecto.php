<?php include_once __DIR__ . '/header-dashbord.php'; ?>

<div class="contenedor-sm">
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
    <form class="formulario" method="POST" action="/actualizar-proyecto">
        <?php include_once __DIR__ . '/formulario-proyecto.php'; ?>
    </form>

</div>


<?php include_once __DIR__ . '/footer-dashboard.php'; ?>