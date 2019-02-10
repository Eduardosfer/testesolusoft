<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Descrição de Relatorios
 *
 * @author Eduardo Sfer
 */

class Relatorios extends CI_Controller {

	// utilizado para receber os dados que serão enviados para as views
	private $view_data = array();

	// Caminho da página principal (contem o codigo HTML principal) onde serão incluidas as páginas contendo os dados especificos de cada CRUD
	private $main_page = "main_page";

	/**
	 * Controle de relatorios.
	 *
	 * Mostra a lista dos relatorios cadastrados
	 */
	public function index() {	
		$this->load->model("Clientes_Model");
		$this->view_data['clientes'] = $this->Clientes_Model->getData(array("cli_status" => "ativo"));		 
		$this->load->model("Vendedores_Model");
		$this->view_data['vendedores'] = $this->Vendedores_Model->getData(array("ven_status" => "ativo"));		 
		// Indice 'page' é utilizado para informar qual página deve ser incluida na main_page		
		$this->view_data['page'] = "relatorios/lista";
		$this->view_data['page_title'] = "Relatórios";		
		$this->load->view($this->main_page, $this->view_data);
	}

	public function obterPedidosPorPeriodo() {
		$data_inicio = $this->input->post('data_inicio');
		$data_fim = $this->input->post('data_fim');
		$this->load->model("Relatorios_Model");
		$pedidos = $this->Relatorios_Model->getPedidosPorPeriodo($data_inicio, $data_fim);
		//if validaçoes
		echo json_encode(array("pedidos_periodo" => $pedidos, "menssagem" => "success"));		
	}

	public function obterPedidosPorCliente() {
		$ped_codigo_cliente = $this->input->post('ped_codigo_cliente');		
		$this->load->model("Relatorios_Model");
		$pedidos = $this->Relatorios_Model->getPedidosPorCliente($ped_codigo_cliente);
		//if validaçoes
		echo json_encode(array("pedidos_cliente" => $pedidos, "menssagem" => "success"));		
	}

	public function obterComissaoPorVendedor() {
		$ped_codigo_vendedor = $this->input->post('ped_codigo_vendedor');		
		$this->load->model("Relatorios_Model");
		$pedidos = $this->Relatorios_Model->getComissaoPorVendedor($ped_codigo_vendedor);
		//if validaçoes
		echo json_encode(array("comissao_vendedor" => $pedidos, "menssagem" => "success"));		
	}

}
