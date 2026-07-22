<?php

namespace Model;

use Model\ActiveRecord;

#[\AllowDynamicProperties]

class Subproyecto extends ActiveRecord
{
    protected static $tabla = 'subproyectos';
    protected static $columnasDB = ['id', 'nombre', 'url', 'proyectoId'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->url = $args['url'] ?? null;
        $this->proyectoId = $args['proyectoId'] ?? null;
    }

    public function validarProyecto()
    {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El nombre del subproyecto es obligatorio';
        }

        return self::$alertas;
    }
}
