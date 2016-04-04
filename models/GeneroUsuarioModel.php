<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GeneroUsuario
 *
 * @author steven
 */
class GeneroUsuarioModel extends Model {
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    public function selectGeneroUsuario() {
        return $this->getDb()->query("SELECT id_genero_usuario, nombre FROM GENERO_USUARIO");
    }
 
}
