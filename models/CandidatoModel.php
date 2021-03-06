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
class CandidatoModel extends Model{

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
        return $this->getDb()->query("SELECT id_candidato, id_usuario, id_candidato_especial, id_encuesta, imagen, fecha_inscripcion FROM CANDIDATO");
    }

    public function getCandidatoPorId($id) {
        return Singleton::getInstance()->db->query("SELECT id_candidato, id_usuario, id_candidato_especial, id_encuesta, imagen, fecha_inscripcion FROM CANDIDATO WHERE id_candidato = '$id'");
    }
    public function getCandidatoPorIdEncuesta($idEncuesta) {
        return Singleton::getInstance()->db->query("SELECT id_candidato, id_usuario, id_candidato_especial, id_encuesta, imagen, fecha_inscripcion FROM CANDIDATO WHERE id_encuesta= '$idEncuesta'");
    }
    public function insertCandidato() {
        return $this->getDb()->insertQuery("CANDIDATO", 
                "id_candidato, id_usuario, id_candidato_especial, id_encuesta, imagen,numero_candidato,fecha_inscripcion", 
                "'$this->idCandidato','$this->idUsuario','$this->idCandidatoEspecial','$this->idEncuesta','$this->imagen','$this->numeroCandidato','$this->fechaInscripcion'");
    }
}
