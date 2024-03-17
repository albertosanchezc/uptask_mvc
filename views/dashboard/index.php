<?php include_once __DIR__ . '/header-dashbord.php'; ?>

<?php if (count($proyectos) === 0) { ?>
    <p class="no-proyectos">No Hay Proyectos Que Mostrar <a href="/crear-proyecto">Crear Uno</a></p>
<?php } else { ?>
    <ul class="listado-proyectos">
        <?php foreach ($proyectos as $proyecto) { ?>
            <li class="proyecto">
                <a href="/proyecto?id=<?php echo $proyecto->url; ?>"><?php echo $proyecto->proyecto; ?></a>

                <form action="/eliminar" method="POST">
                    <div class="opciones">
                        <input type="hidden" name="id" value="<?php echo $proyecto->id;?>">
                    
                        <button
                        class="eliminar" type="submit">Eliminar</button>
                    </div>
                </form>

            </li>
        <?php } ?>
    </ul>
<?php }  ?>




<?php include_once __DIR__ . '/footer-dashboard.php'; ?>