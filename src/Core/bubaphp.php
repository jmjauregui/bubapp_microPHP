<?php 
require_once('Core/Configurations.php'); 
require_once('Core/bubaphpModels.php'); 
class Bubaphp{ 
    
    public function ifControllerExist($url) { 
        $nombre_fichero = $url;
        if (file_exists($nombre_fichero)) {
            return true;
        } else {
            return false;
        }
    }

    public function prepareUrlView($url)
    {
        return 'View/'.$url.'.php';
    }

    public function NOW()
    {
        $ee = getdate();
        return $ee['year']."-".$ee['mon']."-".$ee['mday']." ".$ee['hours'].":".$ee['minutes'].":".$ee['seconds'];
    }

    public function prepareUrlModel($url)
    {
        return 'Model/'.$url.'.php';
    }

    public function prepareUrlController($url)
    {
        return 'Controller/'.$url.'.php';
    }

    public function prepareUrlServices($url)
    {
        return 'Controller/Services/'.$url.'.php';
    }

    public function prepareUrlErrorPage($url)
    {
        return 'bubaphp/ErrorPages/'.$url.'.php';
    }

    public function loadView($get_Variable, $params = null){
        $urlFile = $this->prepareUrlView($get_Variable);
        if ($this->ifControllerExist($urlFile)) {
            if ($params != null && $params != '') {
               $params = json_encode($params);
               $params = json_decode($params); 
            }
            include $urlFile;
        }else{
            $data = [
                'NombreVista' => $get_Variable,
            ];
            $this->ErrorPage('NoExistView', $data);
        }
    }

    public function ErrorPage($get_Variable, $params = null){
        $urlFile = $this->prepareUrlErrorPage($get_Variable);
        if ($this->ifControllerExist($urlFile)) {
            if ($params != null && $params != '') {
               $params = json_encode($params);
               $params = json_decode($params); 
            }
            include $urlFile;
        }else{
            echo "<center><br><br><br><h1>La pagina solicitada No Existe</h1></center>";
        }
    }

    public function loadModel($get_Variable){
        $urlFile = $this->prepareUrlModel($get_Variable);
        if ($this->ifControllerExist($urlFile)) {
            include $urlFile;
            return new $get_Variable;
        }else{
            echo "File no exist";
        }
    }


    public function loadController($get_Variable){
        $processURL = explode('/', $get_Variable);
        $urlFile = $this->prepareUrlController($processURL[0]);
        if ($this->ifControllerExist($urlFile)) {
            include $urlFile;
            $ClassName = new $processURL[0];
            if (count($processURL) > 1) {
                if ($processURL[1] != '') {
                    try {
                        if (method_exists($ClassName,$processURL[1])) {
                            if ($processURL[0] == 'Services') {
                                $ClassName->$processURL[1]($processURL[2]);
                            }else{
                                $ClassName->$processURL[1]();
                            }
                        }else{
                            $data = [
                                'controladorName' => $processURL[0],
                                'methodName' => $processURL[1],
                            ];
                            $this->ErrorPage('NoExistMethod', $data);
                        }
                    } catch (Exception $e) {
                        echo "Error";
                    }
                }else{
                    if (method_exists($ClassName, "index")) {
                        $ClassName->index();
                    }else{
                        $data = [
                            'controladorName' => $processURL[0],
                            'methodName' => "INDEX",
                        ];
                        $this->ErrorPage('NoExistMethod', $data);
                    }
                }
            }else{
                if (method_exists($ClassName, "index")) {
                    $ClassName->index();
                }else{
                    $data = [
                        'controladorName' => $processURL[0],
                        'methodName' => 'INDEX',
                    ];
                    $this->ErrorPage('NoExistMethod', $data);
                }
            }
        }else{
            $data = [
                'NombreControlador' => $get_Variable,
            ];
            $this->ErrorPage('NoExistController', $data);
        }
    }

    public function LoadService($ServiceName){
        $urlServiceResponse = $this->prepareUrlServices($ServiceName);
        if (file_exists($urlServiceResponse)) {
            $ServiceConfig = json_decode(file_get_contents('Controller/Services/ServiceConfig.json'));
            
        }else{

        }
    }

    public function jsonPOST()
    {
        return json_decode(file_get_contents('php://input'));
    }

} 
$Bubaphp = new Bubaphp; 
?> 