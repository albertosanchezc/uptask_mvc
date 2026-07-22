<?php

namespace Model;

use Model\ActiveRecord;

class Subproyecto extends ActiveRecord{
    protected static $tabla = 'subproyectos';
    protected static $columnasDB = ['id', 'nombre', 'proyectoId', 'url'];

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->proyectoId = $args['proyectoId'] ?? null;
        $this->url = $args['url'] ?? null;
        
    }

    public function validarProyecto(){
        if(!$this->nombre){
            self::$alertas['error'][] = 'El nombre del subproyecto es obligatorio';
        }

        return self::$alertas;
    }
}