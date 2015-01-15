<?php
/**
 * Created by PhpStorm.
 * User: Spark
 * Date: 02/12/2014
 * Time: 02:04 PM
 */
require(APPPATH.'libraries/REST_Controller.php');

class RestA extends REST_Controller{


    function restA_get()
    {

        $data = array('returned: '. $this->get('id'));
        $this->response($data);
    }

    function restA_post()
    {
        $data = array('returned: '. $this->post('id'));
        $this->response($data);
    }

    function restA_put()
    {
        $data = array('returned: '. $this->put('id'));
        $this->response($data);
    }

    function restA_delete()
    {
        $data = array('returned: '. $this->delete('id'));
        $this->response($data);
    }
} 