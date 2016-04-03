<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VotoModel
 *
 * @author Emmanuel
 */
class VotoModel {
    private $idVoto;
    private $idEncuesta;
    private $idCandidato;
    private $idEstadoVoto;
    private $fechaVotacion;

    public function __construct() {
        parent::__construct();
    }

    public function selectVotoList() {
        return $this->getDb()->query("SELECT id_voto, id_encuesta, id_candidato, id_estado_voto, fecha_votacion FROM voto");
    }

    public function getVotoPorId($id) {
        return Singleton::getInstance()->db->selectQuery("SELECT id_voto, id_encuesta, id_candidato, id_estado_voto, fecha_votacion FROM voto WHERE id_voto = '$id'");
    }
}
