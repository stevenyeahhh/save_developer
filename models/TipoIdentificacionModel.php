<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TipoIdentificacionModel
 *
 * @author Emmanuel
 */
class TipoIdentificacionModel extends Model{
    private $idTipoIdentificacion;
    private $nombre;
    private $campos;

    public function __construct() {
        parent::__construct();
        $this->campos = "id_tipo_identificacion,nombre";
    }

    public function selectTipoIdentificacionList() {
        return $this->getDb()->query("SELECT id_tipo_identificacion, nombre FROM TIPO_IDENTIFICACION");
    }

    public function getTipoIdentificacionPorId($id) {
        return Singleton::getInstance()->db->selectQuery("SELECT id_tipo_identificacion, nombre FROM tipo_identificacion WHERE id_tipo_identificacion = '$id'");
    }
    public function insertTipoIdentificacion() {
        return $this->getDb()->insertQuery("TIPO_IDENTIFICACION", 
                " id_tipo_identificacion, nombre ", 
                "'$this->idTipoIdentificacion','$this->nombre'");
    }
}
