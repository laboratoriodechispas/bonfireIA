<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webservice extends CI_Controller {

    function Webservice()

    {

        parent::__construct();

        $ns = 'http://'.$_SERVER['HTTP_HOST'].'/index.php/soapserver/';

        $this->load->library("nusoap/nusoap_library"); // load nusoap toolkit library in controller

        $this->nusoap_server = new nusoap_server(); // create soap server object

        $this->nusoap_server->configureWSDL("SOAP Server Using NuSOAP in CodeIgniter", $ns); // wsdl cinfiguration

        $this->nusoap_server->wsdl->schemaTargetNamespace = $ns; // server namespace

        $this->nusoap_server->register("hello", array('name'=>'xsd:string'), array('return'=>'xsd:string'));

    }



    public function index()

    {

        function hello($name)

        {

            return array("Hello" => $name);

        }
        $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
        $this->nusoap_server->service($HTTP_RAW_POST_DATA);
    }

}

?>