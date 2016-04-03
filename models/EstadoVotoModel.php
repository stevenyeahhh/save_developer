<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EstadoVotoModel
 *
 * @author Emmanuel
 */
class EstadoVotoModel {

    private $idEstadoVoto;
    private $nombre;
    private $campos;

    public function __construct() {
        parent::__construct();
        $this->campos = "id_estado_voto,nombre";
    }

    public function selectEstadoVotoList() {
        return $this->getDb()->query("SELECT id_estado_voto, nombre FROM estado_voto");
    }

    public function getEstadoVotoPorId($id) {
        return Singleton::getInstance()->db->selectQuery("SELECT id_estado_voto, nombre FROM estado_voto WHERE id_estado_voto = '$id'");
    }

}
