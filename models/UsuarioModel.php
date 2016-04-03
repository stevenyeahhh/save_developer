<?php

class UsuarioModel extends Model{    
    private $idUsuario;//Identificador usuario
    private $nombreUsuario;
    private $contrasena;
    private $nombre;
    private $apellidos;
    private $numeroIdentificacion;
    private $genero;
    private $fechaNacimiento;
    //Llaves foràneas
    private $idRol;
    private $idTipoIdentificacion;
    private $idGeneroUsuario;
    private $idCargoTrabajo;
    public function __construct() {
        parent::__construct();
    }
    public function inciarSesion($usuario,$contrasena) {
        return $this->getDb()->selectQuery(
                "USUARIO u",
                "*", 
                "u.nombre_usuario='$usuario' AND  u.contrasena='".md5($contrasena)."' ");
    }
    public function registrar() {
        return $this->getDb()->insertQuery("USUARIO",
                "nombre_usuario,contrasena,nombre,apellidos,numero_identificacion,genero,fecha_nacimiento,id_rol,id_tipo_identificacion,id_genero_usuario,id_cargo_usuario", 
                "'$nombreUsuario','".md5($contrasena)."','$nombre','$apellidos','$numeroIdentificacion','$genero','$fechaNacimiento',"
                . "'$idRol','$idTipoIdentificacion','$idTipoIdentificacion','$idGeneroUsuario','$idCargoTrabajo'");
    }
    public function getRoles() {
        return $this->getDb()->selectQuery(
                "ROL r ",
                "*","");
                
    }
    
}
