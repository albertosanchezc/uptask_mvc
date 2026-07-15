<?php include_once __DIR__ . '/header-dashbord.php'; ?>

<div class="contenedor-sm">
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <a href="/perfil" class="enlace">Volver</a>

    <form class="formulario" method="POST" action="/cambiar-password">
        <div class="campo">
            <label for="nombre">Password Actual</label>
            <input type="password"  name="password_actual" placeholder="Tu Password Actual"/>
        </div>

        <div class="campo">
            <label for="nombre">Password Nuevo</label>
            <input type="password"  name="password_nuevo" placeholder="Tu Nuevo Password"/>
        </div>

        <input type="submit" value="Guardar Cambios">
    </form>
</div>

<?php include_once __DIR__ . '/footer-dashboard.php'; ?>