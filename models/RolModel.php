<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of rolModel
 *
 * @author Emmanuel
 */
class rolModel {

    private $idRol;
    private $nombre;
    private $campos;

    public function __construct() {
        parent::__construct();
        $this->campos = "id_rol,nombre";
    }

    public function selectRolList() {
        return $this->getDb()->query("SELECT id_rol, nombre FROM rol");
    }

    public function getRolPorId($id) {
        return Singleton::getInstance()->db->selectQuery("SELECT id_rol, nombre FROM rol WHERE id_rol = '$id'");
    }
    public function insertRol() {
        return $this->getDb()->insertQuery("ROL", 
                " id_rol, nombre ", 
                "'$this->idRol','$this->nombre'");
    }

}
