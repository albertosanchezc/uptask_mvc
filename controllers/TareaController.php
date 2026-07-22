<?php

namespace Controllers;

use Model\Tarea;
use Model\Proyecto;
use Model\Subproyecto;

class TareaController
{
    public static function index()
    {
        //
        $subproyecto = Subproyecto::where('url', $_GET['id']);

        $proyecto = Proyecto::find($subproyecto->proyectoId);

        session_start();

        if (!$proyecto || $proyecto->propietarioId !== $_SESSION['id']) {
            header('Location: /404');
        }

        $tareas = Tarea::belongsTo('subproyectoId', $subproyecto->id);

        echo json_encode([
            'tareas' => $tareas
        ]);
    }

    public static function crear()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            session_start();
            // Obtener el subproyecto
            $subproyecto = Subproyecto::where('url', $_POST['subproyectoUrl']);

            if (!$subproyecto) {
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'Subproyecto no encontrado'
                ];
                echo json_encode($respuesta);
                return;
            }

            // Obtener el proyecto padre
            $proyecto = Proyecto::find($subproyecto->proyectoId);

            // Validar propietario
            if (!$proyecto || $proyecto->propietarioId !== $_SESSION['id']) {

                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'Hubo un error al agregar la tarea'
                ];
                echo json_encode($respuesta);
                return;
            }

            // Crear tarea
            $tarea = new Tarea($_POST);
            $tarea->proyectoId = $proyecto->id;
            $tarea->subproyectoId = $subproyecto->id;

            $resultado = $tarea->guardar();
            $respuesta = [
                'tipo' => 'exito',
                'id' => $resultado['id'],
                'mensaje' => 'Tarea Creada Correctamente',
                'proyectoId' => $proyecto->id,
                'subproyectoId' => $subproyecto->id
            ];
            echo json_encode($respuesta);

            // //////////////////////////////

            // $proyectoId = $_POST['proyectoId'];

            // $proyecto = Proyecto::where('url', $proyectoId);

            // if (!$proyecto || $proyecto->propietarioId !== $_SESSION['id']) {
            //     $respuesta = [
            //         'tipo' => 'error',
            //         'mensaje' => 'Hubo un Error al agregar la tarea'
            //     ];
            //     echo json_encode($respuesta);
            //     return;
            // }
            // // Todo bien, instanciar y crear la tarea
            // $tarea = new Tarea($_POST);
            // $tarea->proyectoId = $proyecto->id;
            // $resultado = $tarea->guardar();
            // $respuesta = [
            //     'tipo' => 'exito',
            //     'id' => $resultado['id'],
            //     'mensaje' => 'Tarea Creada Correctamente',
            //     'proyectoId' => $proyecto->id
            // ];
            // echo json_encode($respuesta);
        }
    }

    public static function actualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Obtener el subproyecto por su URL
            $subproyecto = Subproyecto::where('url', $_POST['subproyectoUrl']);
            if (!$subproyecto) {
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'Subproyecto no encontrado'
                ];
                echo json_encode($respuesta);
                return;
            }

            // Obtener el proyecto padre
            $proyecto = Proyecto::find($subproyecto->proyectoId);

            session_start();


            // Validar propietario            

            if (!$proyecto || $proyecto->propietarioId !== $_SESSION['id']) {
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'Hubo un Error al actualizar la tarea'
                ];
                echo json_encode($respuesta);
                return;
            }

            $tarea = new Tarea($_POST);
            $tarea->proyectoId = $proyecto->id;
            $tarea->subproyectoId = $subproyecto->id;

            $resultado = $tarea->guardar();
            if ($resultado) {
                $respuesta = [
                    'tipo' => 'exito',
                    'id' => $tarea->id,
                    // 'proyectoId' => $proyecto->id,
                    'mensaje' => 'Actualizado Correctamente'
                ];
                echo json_encode($respuesta);
            }
        }
    }

    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar que el proyecto exista
            $subproyecto = Subproyecto::where('url', $_POST['subproyectoUrl']);

            if (!$subproyecto) {
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'Subproyecto no encontrado'
                ];
                echo json_encode($respuesta);
            }
            session_start();

            if (!$proyecto || $proyecto->propietarioId !== $_SESSION['id']) {
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'Hubo un Error al actualizar la tarea'
                ];
                echo json_encode($respuesta);
                return;
            }

            $tarea = new Tarea($_POST);
            $resultado = $tarea->eliminar();

            $resultado = [
                'resultado' => $resultado,
                'mensaje' => 'Eliminado Correctamente',
                'tipo' => 'exito'
            ];

            echo json_encode($resultado);
        }
    }
}
