<div class="contenedor reestablecer">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Coloca tu nuevo password</p>

        <?php if($mostrar){ ?>

        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

        <form class="formulario" method="POST" >
            <div class="campo">
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Tu Password" name="password" />
            </div>

            <input type="submit" class="boton" value="Guardar Password">
        </form>

        <?php  };?>

        <div class="acciones">
            <a href="/crear">¿No Tienes Una Cuenta? Crear Una</a>
            <a href="/olvide">¿Olvidaste tu Password</a>
        </div>
    </div>
    <!--.contenedor-sm -->
</div>