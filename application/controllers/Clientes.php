<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

	// utilizado para receber os dados que serão enviados para as views
	private $view_data = array();

	// Caminho da página principal (contem o codigo HTML principal) onde serão incluidas as páginas contendo os dados especificos de cada CRUD
	private $main_page = "main_page";

	/**
	 * Controle de clientes.
	 *
	 * Mostra a lista dos clientes cadastrados
	 */
	public function index()
	{	
		// Indice 'page' é utilizado para informar qual página deve ser incluida na main_page
		$this->view_data['page'] = "clientes/lista";
		$this->view_data['page_title'] = "Lista de clientes";
		$this->load->view($this->main_page, $this->view_data);
	}
}
