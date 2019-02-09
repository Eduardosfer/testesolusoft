<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Descrição de Produtos
 *
 * @author Eduardo Sfer
 */

class Produtos extends CI_Controller {

	// utilizado para receber os dados que serão enviados para as views
	private $view_data = array();

	// Caminho da página principal (contem o codigo HTML principal) onde serão incluidas as páginas contendo os dados especificos de cada CRUD
	private $main_page = "main_page";

	/**
	 * Controle de Produtos.
	 *
	 * Mostra a lista dos Produtos cadastrados
	 */
	public function index() {	
		// Indice 'page' é utilizado para informar qual página deve ser incluida na main_page
		$this->view_data['page'] = "produtos/lista";
		$this->view_data['page_title'] = "Lista de produtos";
		$this->load->model('Produtos_Model');
		$this->view_data['produtos'] = $this->Produtos_Model->getData(array("pro_status" => "ativo"));		
		$this->load->view($this->main_page, $this->view_data);
	}

	public function cadastrar() {
		$this->load->model('Produtos_Model');
		$dados = $this->input->post('dados_post');					
		$id = $this->Produtos_Model->insertData($dados);
		// if validação		
		$retorno = json_encode(array("menssagem" => "success",  "id" => $id));
		echo $retorno;
	}

	public function editar() {
		$this->load->model('Produtos_Model');
		$dados = $this->input->post('dados_post');
		$where = array("pro_codigo" => $dados['pro_codigo']);
		unset($dados['pro_codigo']);
		$this->Produtos_Model->updateData($dados, $where);
		// if validação		
		$retorno = json_encode(array("menssagem" => "success"));
		echo $retorno;
	}

	public function remover() {
		$this->load->model('Produtos_Model');
		// dados_post contem o código do cliente que deve ser apagado
		$where = $this->input->post('dados_post');		
		// Mudando o status para deletado. Para não aparecer mais para o usuário.
		// Não é deletado, pois caso esse dado esteja vinculado com outra tabela iram ocorrer erros, devido a foreign key.
		$this->Produtos_Model->updateData(array("pro_status" => "deletado"), $where);
		// if validação		
		$retorno = json_encode(array("menssagem" => "success"));
		echo $retorno;
	}
}
