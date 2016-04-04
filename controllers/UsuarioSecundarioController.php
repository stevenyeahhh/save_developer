<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsuarioSecundarioController
 *
 * @author steven
 */
class UsuarioSecundarioController extends Controller{
    private $encuesta;
    private $candidato;
    private $eleccionUsuario;
    public function __construct() {
        parent::__construct();
        if (!($this->sesionIniciada() && $this->getSesionVar('idRol') == 2)) {
            header("Location:" . BASE . DS . 'index' . DS);
        }
        $this->encuesta= $this->loadModel("Encuesta");
        $this->candidato= $this->loadModel("Candidato");
        $this->eleccionUsuario= $this->loadModel("EleccionUsuario");
    }
    public function index() {
        
        $this->view->setTitle("Bienvenido");
        $this->view->renderize("index"); 
    }
    public function actualizarUsuarioSecundario() {
        
    }
    public function listarEleccionesActivas() {
        $this->view->setParams($this->encuesta->selectEncuestaList(),'encuestas');
        $this->view->setTitle("Elecciones activas");
        $this->view->renderize("listarElecciones");
    }
    public function consultarEleccion($idEleccion) {
        $this->view->setParams($this->encuesta->getEncuestaPorId($idEleccion)->fetch(PDO::FETCH_ASSOC),'encuesta');
        $this->view->setParams($idEleccion,'idEleccion');
        $this->view->setTitle("Elección #$idEleccion");
        $this->view->renderize("consultarEleccion");
    }
    public function listarCandidatos($idEleccion) {
        $validar = $this->validar(array_merge(array(
            'idUsuario' => array('required' => true,'number'=>true),
        )));
        $this->view->setValidacion($validar->getCamposJSON());
        $this->view->setParams($this->candidato->getCandidatoPorIdEncuesta($idEleccion)->fetchAll(PDO::FETCH_ASSOC),'candidatos');
        
        if($_POST){
            $validar->setValores($_POST);
            if ($validar->validarServidor()) {
                extract($_POST);
                $this->eleccionUsuario->setIdUsuario($idUsuario);
                $this->eleccionUsuario->setIdEncuesta($idEleccion);
                if($this->eleccionUsuario->insertEleccionUsuario()){
                    $this->view->setMensaje("Elección confirmada");
                }else{
                    $this->view->setError("No se pudo registrar");
                }
            }
        }
        $this->view->setTitle("Elección #$idEleccion");
        $this->view->renderize("listarCandidatos");
    }
    public function votar($idVoto) {
        
    }
}
