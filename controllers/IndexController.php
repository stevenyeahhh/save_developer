<?php

class IndexController extends Controller {
    private $model;//los modelos se guardan en models/[nombre modelo]

    public function __construct() {
        parent::__construct();
//        $this->model = $this->loadModel("model");//Para iniciar el modelo, ejemplo de uso de módelo, controller/EmpresaController.php
//        if ($this->sesionIniciada()) {
//            $this->redirigirARol();
//        }
    }

    public function index() {
        $this->view->setTitle("Bienvenido a Save");
        $this->view->renderize("index");
//        $this->view->setTitle("Reg?trate");//T?ulo de la p?ina (se muestra como el t?ulo de pesta? y como h1 de la vista)
//        Poner campos que se van a validar en formato de jquery validatos
//        $validar = $this->validar(array_merge(array(
//            'direccion' => array('required' => true),
//            'telefono' => array('required' => true, 'number' => true),
//        )));
//        $this->view->setValidacion($validar->getCamposJSON());//Esto es obligatorio, para que la vista los cargue en la validaci? l?ea 139 de views/layout/header.phtml
//          if ($_POST) {
//            $validar->setValores($_POST);//poner los valores del submit
//            if ($validar->validarServidor()) {}//Validaci? desde el servidor, cuando se hace submit
//          }
//          $this->view->setJs(array('lib'));//Funci? para cargar scripts de javascript, deben estar en views/[nombre del controlador, en este ejemplo index]/js/[script].js
//        $this->view->renderize('registrar');//Funci? para mostrar vistas, deben estar en views/[nombre del controlador, en este ejemplo index]/[nombre vista a renderizar]
        //$this->crearMenu($menu2, "index/reporte", "Reporte");//Añade opción al menú superior, para el lateral ir a config/controller.php orden : [controlador]/[función controlador], "Nombre a mostrar en el menú"

    }
    
//    public function desactivarIndex() {
//    Funci? para deshabilitar registros a trav? de la tabla con el bootstrap.switch ejemplo en views/index/index.phtml
//        extract($_POST);//        
//        die($this->bodega->cambiarEstado($usuario,$estado)? "?ito al " . (($estado) ? "activar" : "desactivar") . "  la bodega '$usuario'" : "No se pudo actualizar la bodega");
//        
//    }
    public function reporte($excel=false) {
        $data=array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);
        if ($excel == 1) {
            $this->exportExcel($data, "Título", "Nombre del archivo");//La funci? exportExcel, permite exportar arreglos tal y como se env?
        }else{
            $this->view->setParams(json_encode($data),"json_object");
            $this->view->renderize('report');
        }
        
    }
}
?>