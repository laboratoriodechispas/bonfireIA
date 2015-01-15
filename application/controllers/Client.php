<?php
class Client extends CI_controller {

    function __construct() {
        parent::__construct();

            $this->load->library("nusoap/Nusoap_library");
            $this->load->helper("url");

         }

    function index() {


        $this->load->library("nusoap/nusoap_library");
        $this->soapclient = new nusoap_client('http://localhost/Bonfire/server.php?wsdl','wsdl');

        echo site_url('webservice?wsdl');
              $err = $this->soapclient->getError();
             if ($err) {
                 echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';

             }
$datos = [];
        $datos['email']     = "asdas@sadsad.asd";
        $datos["nombre"]    = "asdasd";
        $datos['ano_nac']   = 1990;
        $datos['telefono']  = '23423234';

            $result = $this->soapclient->call('calculo_edad',array('datos'=>$datos));
           // Check for a fault
           if ($this->soapclient->fault) {
                   echo '<h2>Fault</h2><pre>';
                   print_r($result);
                  echo '</pre>';
            } else {
                // Check for errors
                $err = $this->soapclient->getError();
                if ($err) {
                          // Display the error
                      echo '<h2>Error</h2><pre>' . $err . '</pre>';
                    var_dump($result);
                } else {
                 // Display the result
                 echo '<h2>Result</h2><pre>';

                    echo '<h2>Request</h2>';
                    echo '<pre>' . htmlspecialchars($this->soapclient->request, ENT_QUOTES) . '</pre>';
                    echo '<h2>Response</h2>';
                    echo '<pre>' . htmlspecialchars($this->soapclient->response, ENT_QUOTES) . '</pre>';
                    var_dump($result);
                   echo '</pre>';
              }
        }
}

}