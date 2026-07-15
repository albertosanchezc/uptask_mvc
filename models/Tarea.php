<?php

namespace Model;
<<<<<<< HEAD
#[\AllowDynamicProperties]
=======
>>>>>>> d03566c596c05e11861813608f1f71e41c484ebd

class Tarea extends ActiveRecord{
    protected static $tabla = 'tareas';
    protected static $columnasDB = ['id', 'nombre', 'estado', 'proyectoId'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->estado = $args['estado'] ?? 0;
        $this->proyectoId = $args['proyectoId'] ?? '';

    }
}