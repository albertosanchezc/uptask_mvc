(function () {

    const nuevoSubproyectoBtn = document.querySelector('#agregar-subproyecto');

    if (nuevoSubproyectoBtn) {
        nuevoSubproyectoBtn.addEventListener('click', function () {
            mostrarFormularioSubProyecto();
        });
    }


    function mostrarAlerta(mensaje, tipo, referencia) {
        // Previene la creación de múltiples alertas
        const alertaPrevia = document.querySelector('.alerta');
        if (alertaPrevia) {
            alertaPrevia.remove();
        }

        const alerta = document.createElement('DIV');
        alerta.classList.add('alerta', tipo);
        alerta.textContent = mensaje;

        // Inserta la alerta antes del legend
        referencia.parentElement.insertBefore(alerta, referencia.nextElementSibling);

        // Eliminar la alerta después de 5 segundos
        setTimeout(() => {
            alerta.remove();
        }, 5000)
    }

    // Consultar el servidor para añadir una nueva tarea al proyecto actual
    async function agregarSubproyecto(subproyecto) {

        const datos = new FormData();

        datos.append('nombre', subproyecto);
        datos.append('proyectoUrl', obtenerProyecto());

        try {
            const url = `${server}/api/subproyecto`;

            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });

            const resultado = await respuesta.json();

            console.log(resultado);

            mostrarAlerta(
                resultado.mensaje,
                resultado.tipo,
                document.querySelector('.formulario legend')
            );

            if (resultado.tipo === 'exito') {

                const modal = document.querySelector('.modal');

                setTimeout(() => {
                    modal.remove();
                    window.location.reload();
                }, 750);

            }

        } catch (error) {
            console.log(error);
        }
    }

    function mostrarFormularioSubProyecto(editar = false, subproyecto = {}) {
        const modal = document.createElement('DIV');
        modal.classList.add('modal');
        modal.innerHTML = `
        <form class="formulario formulario-subproyecto  nuevo-subproyecto">
            <legend>${editar ? 'Editar Subproyecto' : 'Añade Un Subproyecto'}</legend>
            <div class="campo">
                <label>Subproyecto</label>
                <input type="text" name="nombre" placeholder="${subproyecto.nombre ? 'Edita el subproyecto' : 'Añadir subproyecto al Proyecto Actual'}" id="subproyecto" value="${subproyecto.nombre ? subproyecto.nombre : ''}"/>
            </div>
            <div class="opciones">
                <input type="submit" class="submit-nuevo-subproyecto" value="${subproyecto.nombre ? 'Guardar Cambios' : 'Añadir Subproyecto'}" />
                <button type="button" class="cerrar-modal">Cancelar</button>
            </div>
        </form>
        `;


        setTimeout(() => {
            const formulario = document.querySelector('.formulario-subproyecto')
            formulario.classList.add('animar');
        }, 0);


        modal.addEventListener('click', function (e) {
            e.preventDefault();

            if (e.target.classList.contains('cerrar-modal')) {
                const formulario = document.querySelector('.formulario');
                formulario.classList.add('cerrar');
                setTimeout(() => {
                    modal.remove();
                }, 500);
            }

            if (e.target.classList.contains('submit-nuevo-subproyecto')) {
                const nombresubproyecto = document.querySelector('#subproyecto').value.trim();

                if (nombresubproyecto === '') {
                    mostrarAlerta('El nombre del subproyecto es Obligatorio', 'error', document.querySelector('.formulario legend'));
                    return;
                }
                if (editar) {
                    subproyecto.nombre = nombresubproyecto;
                    // actualizarSubproyecto(subproyecto);
                } else {
                    agregarSubproyecto(nombresubproyecto);
                }
            }
        })
        document.querySelector('.dashboard').appendChild(modal);
    }

    const server = window.location.origin;

    function obtenerProyecto() {
        const proyectoParams = new URLSearchParams(window.location.search);
        const proyecto = Object.fromEntries(proyectoParams.entries());

        return proyecto.id;
    }

})();