<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EncuestaModel
 *
 * @author Emmanuel
 */
class EncuestaModel {

    private $idEncuesta;
    private $nombre;
    private $fechaCreacion;
    private $fechaInicioInscripcion;
    private $fechaFinInscripcion;
    private $fechaInicioVotacion;
    private $fechaFinVotacion;

    public function __construct() {
        parent::__construct();
    }

    public function selectEncuestaList() {
        return $this->getDb()->query("SELECT id_encuesta, nombre, fecha_creacion, fecha_inicio_inscripcion, fecha_fin_inscripcion, fecha_inicio_votacion, fecha_fin_votacion FROM encuesta");
    }

    public function getEncuestaPorId($id) {
        return Singleton::getInstance()->db->selectQuery("SELECT id_encuesta, nombre, fecha_creacion, fecha_inicio_inscripcion, fecha_fin_inscripcion, fecha_inicio_votacion, fecha_fin_votacion FROM encuesta WHERE id_encuesta = '$id'");
    }

}
