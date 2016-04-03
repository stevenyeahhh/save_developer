<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CandidatoEspecialModel
 *
 * @author Emmanuel
 */
class CandidatoEspecialModel {

    private $idCandidatoEspecial;
    private $nombre;
    private $campos;

    public function __construct() {
        parent::__construct();
        $this->campos = "id_candidato_especial,nombre";
    }

    public function selectCandidatoEspecialList() {
        return $this->getDb()->query("SELECT id_candidato_especial, nombre FROM candidato_especial");
    }

    public function getCandidatoEspecialPorId($id) {
        return Singleton::getInstance()->db->selectQuery("SELECT id_candidato_especial, nombre FROM candidato_especial WHERE id_candidato_especial = '$id'");
    }

}
