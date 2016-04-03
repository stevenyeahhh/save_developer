<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CargoTrabajoModel
 *
 * @author Emmanuel
 */
class CargoTrabajoModel {

    private $idCargoTrabajo;
    private $idAreaTrabajo;
    private $nombre;
    private $campos;

    public function __construct() {
        parent::__construct();
        $this->campos = "id_cargo_trabajo,id_area_trabajo,nombre";
    }

    public function selectCargoTrabajoList() {
        return $this->getDb()->query("SELECT id_cargo_trabajo, id_area_trabajo, nombre FROM cargo_trabajo");
    }

    public function getCargoTrabajoPorId($id) {
        return Singleton::getInstance()->db->selectQuery("SELECT id_cargo_trabajo, id_area_trabajo, nombre FROM cargo_trabajo WHERE id_cargo_trabajo = '$id'");
    }

    public function getCargoTrabajoPorIdAreaTrabajo($idAreaTrabajo) {
        return Singleton::getInstance()->db->selectQuery("SELECT id_cargo_trabajo, id_area_trabajo, nombre FROM cargo_trabajo WHERE id_area_trabajo = '$idAreaTrabajo'");
    }

}
