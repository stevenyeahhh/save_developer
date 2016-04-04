<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdministradorController
 *
 * @author steven
 */
class AdministradorController extends Controller {

    private $usuario;

    public function __construct() {
        parent::__construct();
        if (!($this->sesionIniciada() && $this->getSesionVar('idRol') == 1)) {
            header("Location:" . BASE .  'index' . DS);
        }
        $this->usuario = $this->loadModel("Usuario");
    }

    public function index() {
        $title = "Bienvenido a Save";
        $renderize = "index";
        $this->view->setTitle($title);
        $this->view->renderize($renderize);
    }

    public function registrarUsuarioSecundario() {
        $validar = $this->validar(array_merge(array(
            'nombreUsuario' => array('required' => true),'contrasena' => array('required' => true),
            'nombre' => array('required' => true),'apellidos' => array('required' => true),
            'numeroIdentificacion' => array('required' => true, 'number' => true),
            'fechaNacimiento' => array('required' => true),'idTipoIdentificacion' => array('required' => true, 'number' => true),
            'idGeneroUsuario' => array('required' => true, 'number' => true),
            'idCargoTrabajo' => array('required' => true, 'number' => true),
        )));
        $this->view->setValidacion($validar->getCamposJSON());
        if ($_POST) {
            $validar->setValores($_POST);
            if ($validar->validarServidor()) {
                extract($_POST);
                $this->usuario->setNombreUsuario($nombreUsuario);
                $this->usuario->setContrasena($contrasena);
                $this->usuario->setNombre($nombre);
                $this->usuario->setApellidos($apellidos);
                $this->usuario->setNumeroIdentificacion($numeroIdentificacion);
                $this->usuario->setFechaNacimiento($fechaNacimiento);
                $this->usuario->setIdRol(2);
                $this->usuario->setIdTipoIdentificacion($idTipoIdentificacion);
                $this->usuario->setIdGeneroUsuario($idGeneroUsuario);
                $this->usuario->setIdCargoTrabajo($idCargoTrabajo);
                if ($this->usuario->registrar()) {
                    $this->view->setMensaje("Usuario $nombreUsuario registrado");
                } else {
                    $this->view->setError("No se pudo registrar");
                }
            } else {
                $this->view->setError("Hay error en la validación");
            }
        }
        $tipoIdentificacion = $this->loadModel("TipoIdentificacion");
        $genero = $this->loadModel("GeneroUsuario");
        $cargo = $this->loadModel("CargoTrabajo");
        $this->view->setParams($tipoIdentificacion->selectTipoIdentificacionList()->fetchAll(PDO::FETCH_ASSOC), "tipoIdentificacion");
        $this->view->setParams($genero->selectGeneroUsuario()->fetchAll(PDO::FETCH_ASSOC), "generoUsuario");
        $this->view->setParams($cargo->selectCargoTrabajoList()->fetchAll(PDO::FETCH_ASSOC), "cargoTrabajo");
        $this->view->setTitle("Registrar usuario");
        $this->view->renderize("registrarUsuarioSecundario");
    }

    public function listarUsuarios() {
        $title = "Usuarios ";
        $renderize = "listarUsuarios";
        $usuarios = $this->usuario->getUsuarioPorRol(2);
//        var_dump($usuarios);
        $this->view->setParams($usuarios, "usuarios");

        $this->view->setTitle($title);
        $this->view->renderize($renderize);
    }

    public function actualizarUsuarioSecundario($idUsuario) {
        $validar = $this->validar(array_merge(array(            
            'nombre' => array('required' => true),
            'apellidos' => array('required' => true),
            'numeroIdentificacion' => array('required' => true, 'number' => true),
            'fechaNacimiento' => array('required' => true),
            'idTipoIdentificacion' => array('required' => true, 'number' => true),
            'idGeneroUsuario' => array('required' => true, 'number' => true),
            'idCargoTrabajo' => array('required' => true, 'number' => true),
        )));
        $this->view->setValidacion($validar->getCamposJSON());
        if ($_POST) {
            $validar->setValores($_POST);
            if ($validar->validarServidor()) {
                extract($_POST);                                
                $this->usuario->setNombre($nombre);
                $this->usuario->setApellidos($apellidos);
                $this->usuario->setNumeroIdentificacion($numeroIdentificacion);
                $this->usuario->setFechaNacimiento($fechaNacimiento);                
                $this->usuario->setIdRol(2);
                $this->usuario->setIdTipoIdentificacion($idTipoIdentificacion);
                $this->usuario->setIdGeneroUsuario($idGeneroUsuario);
                $this->usuario->setIdCargoTrabajo($idCargoTrabajo);
                $this->usuario->setIdUsuario($idUsuario);
                if ($this->usuario->actualizar()) {
                    $this->view->setMensaje("Usuario $nombre actualizado");
                }else{
                    $this->view->setError("No se pudo actualizar");
                }
            }else{
                 $this->view->setError("Error en la validación");
            }
        }

        $usuario = $this->usuario->getUsuarioPorId($idUsuario)->fetch(PDO::FETCH_ASSOC);
        ;
        $this->view->setParams($usuario, "usuario");
        $tipoIdentificacion = $this->loadModel("TipoIdentificacion");
        $genero = $this->loadModel("GeneroUsuario");
        $cargo = $this->loadModel("CargoTrabajo");
        $this->view->setParams($tipoIdentificacion->selectTipoIdentificacionList()->fetchAll(PDO::FETCH_ASSOC), "tipoIdentificacion");
        $this->view->setParams($genero->selectGeneroUsuario()->fetchAll(PDO::FETCH_ASSOC), "generoUsuario");
        $this->view->setParams($cargo->selectCargoTrabajoList()->fetchAll(PDO::FETCH_ASSOC), "cargoTrabajo");
        $this->view->setTitle("Actualizar usuario");
        $this->view->renderize("actualizarUsuario");
    }

    public function inactivarUsuarioSecundario($id, $estado) {
        extract($_POST); //        
        die($this->usuario->cambiarEstado($id, $estado) ? "Éxito al " . (($estado) ? "activar" : "desactivar") . "  el usuario '$id'" : "No se pudo actualizar el usuario");
    }

    public function crearEleccion() {
        
    }

    public function modificarEleccion() {
        
    }

    public function listarElecciones() {
        
    }

}
