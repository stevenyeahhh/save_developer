<?php

abstract class Controller {

    protected $view;

    abstract public function index();

    public function __construct() {
        session_start();
        $this->view = new View(Singleton::getInstance()->r->getController());
        $menu = array();
        if ($this->sesionIniciada()) {
            $this->view->setMsgBienvenida($this->getSesionVar("ROL") . " : " . $this->getSesionVar("NOMBRE") . " " . $this->getSesionVar("APELLIDO"));
            switch ($this->getRol()) {
                case ROL_ADMINISTRADOR:
                    $this->crearMenu($menu, "usuario/consultarUsuarios", 'Usuarios');
                    $this->crearMenu($menu, "preguntas/crearPreguntas", 'Preguntas');
                    $this->crearMenu($menu, "tipoMedicamento/consultarTipoMedicamentos", 'Tipos de Medicamentos');
                    $this->crearMenu($menu, "bodega/consultarBodegas", 'Bodega');
                    $this->crearMenu($menu, "medicamento/consultarMedicamentos", 'Medicamentos');
                    $this->crearMenu($menu, "empresa/consultarEmpresas", 'Empresas');
                    $this->crearMenu($menu, "pedido/consultarPedidos", 'PEDIDOS');
                    break;
                case ROL_REPARTIDOR:
                    $this->crearMenu($menu, "repartidor/consultarPedidosAsignados", 'Pedidos asignados');

                    break;
                case ROL_CLIENTE:
                    $this->crearMenu($menu, "cliente/consultarPedidos", 'PEDIDOS');
                    break;
                default:
                    break;
            }
            $this->crearMenu($menu, "usuario/consultar", 'Consulta de datos');
            $this->crearMenu($menu, "usuario/modificar", 'Modificar datos');
            $this->crearMenu($menu, "usuario/eliminar", 'Eliminar cuenta');
            $this->crearMenu($menu, "usuario/cerrarSesion", 'Cerrar sesiÃ³n ');
            $this->view->setMenu($menu);
        }
    }

    public function loadModel($model) {

        $model = $model . 'Model';
        if (is_readable($controllerPath = ROOT . 'models' . DS . $model . '.php')) {
            include_once $controllerPath = ROOT . 'models' . DS . $model . '.php';
            return new $model;
        }
    }

    public function sesionIniciada() {

        return isset($_SESSION['IDENTIFICADOR']);
    }

    public function getSesionVar($name) {
        return $_SESSION[$name];
    }

    public function cerrarSesion() {
        session_destroy();
    }

    public function getRol() {
        return $_SESSION["ID_ROL"];
    }

    public function crearMenu(&$menu, $url, $descripcion) {
        $menu[] = array('url' => BASE . $url,
            'descripcion' => $descripcion);
    }

    public function showConstructMsg() {
        die("En construcciÃ³n");
    }

    public function redirigirARol() {
        switch ($this->getSesionVar("ID_ROL")) {
            case ROL_ADMINISTRADOR:
                header("Location:" . BASE . DS . 'administrador' . DS);
                break;
            case ROL_CLIENTE:
                header("Location:" . BASE . DS . 'cliente' . DS);
                break;
            case ROL_REPARTIDOR:
                header("Location:" . BASE . DS . 'repartidor' . DS);
                break;

            default:
                header("Location:" . BASE . DS . 'index' . DS);

                break;
        }
    }

    public function validar($data) {
        include ROOT . 'config' . DS . 'Validador.php';
        $validador = new Validador();
        $validador->setCampos($data);
        return $validador;
    }

    public function exportExcel($data, $title, $filename) {
        /**
         * Función para exportar a excel a partir de un excel
         * @param array $data <b>Arreglo con la información que va a ir en el excel
         * </b>
         */
        $hoy = new DateTime();
        ob_clean();
        include ROOT . 'config' . DS . 'Classes' . DS . 'PHPExcel.php';
        header('Content-Disposition: attachment; filename="'.$filename. ($hoy->getTimestamp())  .'.xls"');
        header('Content-Type: application/vnd.ms-excel');
        $objPHPExcel = new PHPExcel;
        $objPHPExcel = new PHPExcel();
        $worksheet = $objPHPExcel->getActiveSheet();
        $worksheet->setCellValueByColumnAndRow(0, 1, "Hola ");
        $worksheet->setCellValueByColumnAndRow(0, 1, "$title: ");
        $worksheet->getStyle("A1")->getFont()->setBold(true)->setSize(16);
        foreach (range('A', "Z") as $col) {
            $objPHPExcel->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
        }
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow();        
        $row = 3;//Column names
        foreach ($data as $key => $value) {
            $columnHeader = 0;
            foreach ($value as $key2 => $value2) {
                $worksheet->setCellValueByColumnAndRow($columnHeader, $row, $key2);
                $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($columnHeader, $row)->getFont()->setBold(true);
                $columnHeader++;
            }
        }
        $row = 4;//Data
        foreach ($data as $key => $value) {
            $column = 0;
            foreach ($value as $key2 => $value2) {
                $worksheet->setCellValueByColumnAndRow($column, $row, $value2);
                $column++;
            }
            $row++;
        }
        $objPHPExcel->setActiveSheetIndex(0);       
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

}

?>