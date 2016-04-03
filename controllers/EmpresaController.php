<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmpresaController
 *
 * @author jcaperap
 */
class EmpresaController extends Controller {

    private $empresa;
    private $usuario;

    public function __construct() {
        parent::__construct();
        if (!$this->sesionIniciada()) {

            header("Location:" . BASE . DS . 'index' . DS);
        }
        $this->empresa = $this->loadModel("Empresa");
        $this->usuario = $this->loadModel("Usuario");
        $this->crearMenu($menu2, "empresa/registrarEmpresa", "Crear empresa");
        $this->crearMenu($menu2, "empresa/consultarEmpresas", "Consultar empresa");
        $this->view->setMenu2($menu2);
    }

    public function index() {
        
    }

    public function registrarEmpresa() {
        $validar = $this->validar(array_merge(array(
            'nombre' => array('required' => true),
            'telefono' => array('required' => true, 'number' => true),
            'direccion' => array('required' => true),
            'idPersonaEncargada' => array('required' => true, 'number' => true),
        )));
        $this->view->setValidacion($validar->getCamposJSON());
//        $this->view->setJs(array("validate"));
//        $this->crearMenu($menu2, "administrador/registrarEmpresa", "Crear empresa");
        if ($_POST) {
            $validar->setValores($_POST);
            if ($validar->validarServidor()) {
                extract($_POST);
                $this->empresa->setNombre($nombre);
                $this->empresa->setTelefono($telefono);
                $this->empresa->setDireccion($direccion);
                $this->empresa->setIdPersonaEncargada($idPersonaEncargada);

                if ($this->empresa->insertEmpresa()) {
                    $this->view->setMensaje("Regitro correcto");
                } else {
                    $this->view->setError("No se pudo insertar");
                }
            } else {
                $this->view->setError("Verifique la información");
            }
        }
        $this->view->setParams($this->usuario->getUsuariosClienteSinEmpresa(), "USUARIOS_CLIENTE");
//        $this->view->setMenu2($menu2);
        $this->view->setTitle("Registrar empresa");
        $this->view->renderize("registrarEmpresa");
    }

    //actualizar
//    public function actualizarEmpresa($param) {
//        
//    }
    //consultar
    public function consultarEmpresas() {
//        $this->crearMenu($menu2, "administrador/registrarEmpresa", "Crear empresa");
//        $this->view->setMenu2($menu2);
//        $this->view->setJs(array("switch"));
        $this->view->setTitle("Consultar empresas:");

        $this->view->setParams($this->empresa->selectEmpresas(), 'EMPRESAS');


//        $this->view->agregarTabla($tabla,array(),"BODEGA",1);
        $this->view->renderize("consultarEmpresas");
//        selectEmpresas
    }

    public function consultarEmpresa($idEmpresa) {
        $this->crearMenu($menu2, "empresa/consultarEmpresa/$idEmpresa", "Consulta empresa '$idEmpresa'");
        $this->crearMenu($menu2, "empresa/actualizarEmpresa/$idEmpresa", "Actualizar empresa '$idEmpresa'");
        $this->view->setMenu2($menu2);

        $empresa = $this->empresa->getEmpresaPorId($idEmpresa)->fetch(PDO::FETCH_ASSOC);
        $this->view->setTitle("Consultar empresa '$idEmpresa'");
        var_dump($empresa);
        $this->view->setParams($empresa, 'DATA');
        $this->view->renderize("consultarEmpresa");
    }

    public function actualizarEmpresa($idEmpresa) {
        $validar = $this->validar(array_merge(array(
            'nombre' => array('required' => true),
            'telefono' => array('required' => true, 'number' => true),
            'direccion' => array('required' => true),
            'idPersonaEncargada' => array('required' => true, 'number' => true),
        )));
        $this->view->setValidacion($validar->getCamposJSON());
        $this->crearMenu($menu2, "empresa/consultarEmpresa/$idEmpresa", "Consulta empresa '$idEmpresa'");
        $this->crearMenu($menu2, "empresa/actualizarEmpresa/$idEmpresa", "Actualizar empresa '$idEmpresa'");
        $this->view->setMenu2($menu2);
        if ($_POST) {
            $validar->setValores($_POST);
            if ($validar->validarServidor()) {
                extract($_POST);
//            $this->empresa->setIdentificador($idEmpresa);
                $this->empresa->setNombre($nombre);
                $this->empresa->setTelefono($telefono);
                $this->empresa->setDireccion($direccion);
                $this->empresa->setIdPersonaEncargada($idPersonaEncargada);
                if ($this->empresa->actualizarEmpresa($idEmpresa)) {
                    $this->view->setMensaje("Actualización exitosa");
                } else {
                    $this->view->setError("Error");
                }
            } else {
                $this->view->setError("Verifique los datos");
            }
        }
        $empresa = $this->empresa->getEmpresaPorId($idEmpresa)->fetch(PDO::FETCH_ASSOC);
        $clientes = $this->usuario->getUsuariosClientePDO()->fetchAll(PDO::FETCH_ASSOC);
        $this->view->setTitle("Actualizar Empresa '$idEmpresa'");
        $this->view->setParams($empresa, 'DATA');
        $this->view->setParams($clientes, 'ID_PERSONA_ENCARGADA');
        $this->view->renderize("actualizarEmpresa");
    }

    public function desactivarEmpresa() {
        extract($_POST);

        die($this->empresa->cambiarEstado($usuario, $estado) ? "Éxito al " . (($estado) ? "activar" : "desactivar") . "  el empresa '$usuario'" : "No se pudo actualizar el empresa");
    }

//put your code here
}
