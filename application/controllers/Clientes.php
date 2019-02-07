<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

	// utilizado para receber os dados que serão enviados para as views
	private $view_data = array();

	/**
	 * Controle de clientes.
	 *
	 * Mostra a lista dos clientes cadastrados
	 */
	public function index()
	{	
		$this->view_data['page_title'] = "Lista de clientes";
		$this->load->view('clientes/lista', $this->view_data);
	}
}
