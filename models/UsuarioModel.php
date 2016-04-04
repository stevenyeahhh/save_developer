<?php

class UsuarioModel extends Model {

    private $idUsuario; //Identificador usuario
    private $nombreUsuario;
    private $contrasena;
    private $nombre;
    private $apellidos;
    private $numeroIdentificacion;
//    private $genero;
    private $fechaNacimiento;
    //Llaves foràneas
    private $idRol;
    private $idTipoIdentificacion;
    private $idGeneroUsuario;
    private $idCargoTrabajo;

    public function __construct() {
        parent::__construct();
    }

    public function inciarSesion($usuario, $contrasena) {
        return $this->getDb()->selectQuery(
                        "USUARIO u", "*", "u.nombre_usuario='$usuario' AND  u.contrasena='" . md5($contrasena) . "' AND u.estado='1'");
    }

    public function registrar() {
        return $this->getDb()->insertQuery("USUARIO", "nombre_usuario,contrasena,nombre,apellidos,numero_identificacion,fecha_nacimiento,id_rol,id_tipo_identificacion,id_genero_usuario,id_cargo_trabajo", "'$this->nombreUsuario','" . md5($this->contrasena) . "','$this->nombre','$this->apellidos','$this->numeroIdentificacion','$this->fechaNacimiento',"
                        . "'$this->idRol','$this->idTipoIdentificacion','$this->idGeneroUsuario','$this->idCargoTrabajo'");
    }

    public function actualizar() {//updateQuery($table, $columnValues, $where)
        return $this->getDb()->updateQuery("USUARIO",
                "nombre ='$this->nombre',
                apellidos ='$this->apellidos',
                numero_identificacion ='$this->numeroIdentificacion',
                fecha_nacimiento ='$this->fechaNacimiento',
                id_rol ='$this->idRol',
                id_tipo_identificacion ='$this->idTipoIdentificacion',
                id_genero_usuario ='$this->idGeneroUsuario',
                id_cargo_trabajo ='$this->idCargoTrabajo'", "id_usuario='$this->idUsuario'");
    }

    public function getRoles() {
        return $this->getDb()->selectQuery(
                        "ROL r ", "*", "");
    }

    public function selectUsuario() {
        return $this->getDb()->query("SELECT id_usuario,nombre_usuario,contrasena,nombre,apellidos,numero_identificacion,fecha_nacimiento,id_rol,id_tipo_identificacion,id_genero_usuario,id_cargo_trabajo FROM USUARIO");
    }

    public function getUsuarioPorId($id) {
        return Singleton::getInstance()->db->selectQuery("USUARIO "
                ,"id_usuario,nombre_usuario,contrasena,nombre,apellidos,numero_identificacion,fecha_nacimiento,id_rol,id_tipo_identificacion,id_genero_usuario,id_cargo_trabajo"
                ,"id_usuario= '$id'");
    }

    public function getUsuarioPorRol($rol) {                
        return Singleton::getInstance()->db->selectQuery("USUARIO u join TIPO_IDENTIFICACION ti ON (ti.id_tipo_identificacion=u.id_tipo_identificacion) JOIN GENERO_USUARIO gu ON(gu.id_genero_usuario=u.id_genero_usuario) JOIN CARGO_TRABAJO ct ON (ct.id_cargo_trabajo=u.id_cargo_trabajo)",
                "u.id_usuario,u.nombre_usuario,u.nombre,u.apellidos,u.numero_identificacion,u.fecha_nacimiento,ti.nombre tipo_identificacion,gu.nombre genero_usuario,ct.nombre cargo_trabajo,u.estado "
                ," u.id_rol= '$rol'"); 
    }

    public function cambiarEstado($id, $estado) {
        return Singleton::getInstance()->db->updateQuery("USUARIO", "estado='$estado'", " id_usuario='$id'");
    }

    //Setters
    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setNombreUsuario($nombreUsuario) {
        $this->nombreUsuario = $nombreUsuario;
    }

    function setContrasena($contrasena) {
        $this->contrasena = $contrasena;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    function setNumeroIdentificacion($numeroIdentificacion) {
        $this->numeroIdentificacion = $numeroIdentificacion;
    }

    function setFechaNacimiento($fechaNacimiento) {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    function setIdRol($idRol) {
        $this->idRol = $idRol;
    }

    function setIdTipoIdentificacion($idTipoIdentificacion) {
        $this->idTipoIdentificacion = $idTipoIdentificacion;
    }

    function setIdGeneroUsuario($idGeneroUsuario) {
        $this->idGeneroUsuario = $idGeneroUsuario;
    }

    function setIdCargoTrabajo($idCargoTrabajo) {
        $this->idCargoTrabajo = $idCargoTrabajo;
    }

}
