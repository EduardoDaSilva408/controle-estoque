<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cupons extends CI_Controller {

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
	public function index()
	{
        // Carrega a view parcial do conteúdo
        $content = $this->load->view('cupons', [], true);

        // CSS e JS adicionais
        $css = '<link rel="stylesheet" type="text/css" href="' . base_url('assets/css/formulario.css') . '">';
        $js = '
            <script src="' . base_url('assets/js/enviaFormulario.js') . '"></script>
            <script src="' . base_url('assets/js/cupons/list.js') . '"></script>
            <script src="' . base_url('assets/js/cupons/main.js') . '"></script>
        ';

        // Monta o layout base, inserindo conteúdo e imports
        $this->load->view('layouts/base', [
            'content' => $content,
            'css' => $css,
            'js' => $js
        ]);
	}

	public function add(){
		$this->load->model('Cupons_model');

		$response = $this->Cupons_model->add($_POST);
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	public function list(){
		$this->load->model('Cupons_model');
		$response = $this->Cupons_model->list();
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	public function getCupomById(int $id){
		$this->load->model('Cupons_model');
		$response = $this->Cupons_model->getCupomById($id);
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	public function getCupomByCode(string $code){
		$this->load->model('Cupons_model');
		$response = $this->Cupons_model->getCupomByCode($code);
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	public function edit(int $id){
		$this->load->model('Cupons_model');
		$response = $this->Cupons_model->edit($_POST, $id);
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	public function delete(int $id){
		$this->load->model('Cupons_model');
		$response = $this->Cupons_model->delete($id);
		header('Content-Type: application/json');
		echo json_encode($response);
	}
}
