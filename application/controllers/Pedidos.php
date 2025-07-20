<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedidos extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function add(){
		$this->load->model('Pedidos_model');

		$response = $this->Pedidos_model->add($_POST);
        if(isset($response['code'])){
            http_response_code($response['code']);
        }
		header('Content-Type: application/json');
		echo json_encode($response);
	}

    public function frete(){
		$this->load->model('Pedidos_model');

		$response = $this->Pedidos_model->calculaFrete($_POST['produtos_id'], $_POST['quantidade']);
        if(isset($response['code'])){
            http_response_code($response['code']);
        }
		header('Content-Type: application/json');
		echo json_encode($response);
	}
}
