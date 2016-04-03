<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EleccionUsuarioModel
 *
 * @author Emmanuel
 */
class EleccionUsuarioModel {

    private $idEleccion;
    private $idUsuario;
    private $idEncuesta;
    private $fechaEleccion;
    private $eleccionConfirmada;

    public function __construct() {
        parent::__construct();
    }

    public function selectEleccionUsuarioList() {
        return $this->getDb()->query("SELECT id_eleccion, id_usuario, id_encuesta, fecha_eleccion, eleccion_confirmada FROM eleccion_usuario");
    }

    public function getEleccionUsuarioPorId($id) {
        return Singleton::getInstance()->db->selectQuery("SELECT id_eleccion, id_usuario, id_encuesta, fecha_eleccion, eleccion_confirmada FROM eleccion_usuario WHERE id_eleccion = '$id'");
    }

}
