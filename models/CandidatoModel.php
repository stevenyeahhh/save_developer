<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CandidatoModel
 *
 * @author Emmanuel
 */
class CandidatoModel {

    private $idCandidato;
    private $idUsuario;
    private $idCandidatoEspecial;
    private $idEncuesta;
    private $imagen;
    private $numeroCandidato;
    private $fechaInscripcion;

    public function __construct() {
        parent::__construct();
    }

    public function selectCandidatoList() {
        return $this->getDb()->query("SELECT id_candidato, id_usuario, id_candidato_especial, id_encuesta, imagen, fecha_inscripcion FROM candidato");
    }

    public function getCandidatoPorId($id) {
        return Singleton::getInstance()->db->selectQuery("SELECT id_candidato, id_usuario, id_candidato_especial, id_encuesta, imagen, fecha_inscripcion FROM candidato WHERE id_candidato = '$id'");
    }

}
