<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AreaTrabajo
 *
 * @author Emmanuel
 */
class AreaTrabajo {

    private $idAreaTrabajo;
    private $nombre;
    private $campos;

    public function __construct() {
        parent::__construct();
        $this->campos = "id_area_trabajo,nombre";
    }

    public function selectAreaTrabajoList() {
        return $this->getDb()->query("SELECT id_area_trabajo, nombre FROM area_trabajo");
    }

    public function getAreaTrabajoPorId($id) {
        return Singleton::getInstance()->db->selectQuery("SELECT id_area_trabajo, nombre FROM area_trabajo WHERE id_area_trabajo = '$id'");
    }

}
