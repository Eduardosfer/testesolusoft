<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Descrição de Clientes
 *
 * @author Eduardo Sfer
 */

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

	public function cadastrar()
	{
		$this->load->model('Clientes_Model');
		$dados = $this->input->post('dados_post');					
		$id = $this->Clientes_Model->insertData($dados);
		// if validação		
		$retorno = json_encode(array("menssagem" => "success",  "id" => $id));
		echo $retorno;
	}
}
