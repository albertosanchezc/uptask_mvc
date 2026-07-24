<?php

namespace Controllers;

use Model\Proyecto;
use Model\Subproyecto;
// use Model\Usuario;
// use MVC\Router;

class SubproyectoController
{

    public static function crear()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            session_start();

            $proyecto = Proyecto::where('url', $_POST['proyectoUrl']);

            if (!$proyecto) {
                echo json_encode([
                    'tipo' => 'error',
                    'mensaje' => 'Proyecto no encontrado'
                ]);
                return;
            }


            if ($proyecto->propietarioId !== $_SESSION['id']) {

                echo json_encode([
                    'tipo' => 'error',
                    'mensaje' => 'No tienes permisos'
                ]);
                return;
            }


            $subproyecto = new Subproyecto($_POST);

            $subproyecto->url = md5(uniqid());

            $subproyecto->proyectoId = $proyecto->id;


            $resultado = $subproyecto->guardar();


            echo json_encode([
                'tipo' => 'exito',
                'mensaje' => 'Subproyecto creado correctamente',
                'id' => $resultado['id'],
                'url' => $subproyecto->url
            ]);
        }
    }
}
