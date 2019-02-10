<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Descrição de Pedidos
 *
 * @author Eduardo Sfer
 */

class Pedidos extends CI_Controller {

	// utilizado para receber os dados que serão enviados para as views
	private $view_data = array();

	// Caminho da página principal (contem o codigo HTML principal) onde serão incluidas as páginas contendo os dados especificos de cada CRUD
	private $main_page = "main_page";

	/**
	 * Controle de Pedidos.
	 *
	 * Mostra a lista dos Pedidos cadastrados
	 */
	public function index() {	
		// Indice 'page' é utilizado para informar qual página deve ser incluida na main_page
		$this->view_data['page'] = "pedidos/lista";
		$this->view_data['page_title'] = "Lista de pedidos";
		$this->load->model('Pedidos_Model');
		$this->load->model('Clientes_Model');
		$this->load->model('Vendedores_Model');
		$this->load->model('Produtos_Model');
		$this->view_data['pedidos'] = $this->Pedidos_Model->getDataJoined();		
		$this->view_data['clientes'] = $this->Clientes_Model->getData(array("cli_status" => "ativo"));		
		$this->view_data['vendedores'] = $this->Vendedores_Model->getData(array("ven_status" => "ativo"));		
		$this->view_data['produtos'] = $this->Produtos_Model->getData(array("pro_status" => "ativo"));		
		$this->load->view($this->main_page, $this->view_data);
	}

	public function cadastrar() {
		$this->load->model('Pedidos_Model');
		$this->load->model('Produtos_Pedido_Model');
		$dados = $this->input->post('dados_post');
		$itens_do_pedido = explode(";", $dados['itens_do_pedido']);		
		unset($dados['itens_do_pedido']);
		// Insere o pedido
		$id = $this->Pedidos_Model->insertData($dados);
		// Insere os itens do pedido
		if (isset($itens_do_pedido[0])) {
			foreach ($itens_do_pedido as $item) {
				if ($item != "" && $item != null) {
					$this->Produtos_Pedido_Model->insertData(array("pro_ped_codigo_pedido" => $id, "pro_ped_codigo_produto" => $item));
				}
			}
		}
		// if validação
		$retorno = json_encode(array("menssagem" => "success",  "id" => $id));
		echo $retorno;
	}

	public function editar() {
		$this->load->model('Pedidos_Model');
		$this->load->model('Produtos_Pedido_Model');
		$dados = $this->input->post('dados_post');
		$itens_do_pedido = explode(";", $dados['itens_do_pedido']);	
		$where = array("ped_codigo" => $dados['ped_codigo']);
		// Tem que remover os itens anteriores, para adicionar os novos e atualizados pelo usuário		
		$this->Produtos_Pedido_Model->deleteData(array("pro_ped_codigo_pedido" => $where['ped_codigo']));
		unset($dados['ped_codigo']);
		unset($dados['itens_do_pedido']);
		// Insere os novos itens do pedido
		if (isset($itens_do_pedido[0])) {
			foreach ($itens_do_pedido as $item) {
				if ($item != "" && $item != null) {
					$this->Produtos_Pedido_Model->insertData(array("pro_ped_codigo_pedido" => $where['ped_codigo'], "pro_ped_codigo_produto" => $item));
				}
			}
		}
		$this->Pedidos_Model->updateData($dados, $where);
		// if validação
		$retorno = json_encode(array("menssagem" => "success"));
		echo $retorno;
	}

	public function remover() {
		$this->load->model('Pedidos_Model');
		$this->load->model('Produtos_Pedido_Model');		
		// dados_post contem o código do pedido que deve ser apagado
		$where = $this->input->post('dados_post');	
		// Desetando os itens do pedido
		$this->Produtos_Pedido_Model->deleteData(array("pro_ped_codigo_pedido" => $where['ped_codigo']));
		// Deletando o pedido. Pode ser deletado, pois esses já as foreign keys		
		$this->Pedidos_Model->deleteData($where);
		// if validação
		$retorno = json_encode(array("menssagem" => "success"));
		echo $retorno;
	}

	public function obterDadosPedido() {
		$where = $this->input->post('where');
		$this->load->model('Pedidos_Model');
		$pedido_edicao = $this->Pedidos_Model->getOneData($where);
		// Obtendo os itens do pedido
		$this->load->model('Produtos_Pedido_Model');
		$pedido_edicao->itens_do_pedido = $this->Produtos_Pedido_Model->getDataJoined(array("pro_ped_codigo_pedido" => $where['ped_codigo']));
		// if validação
		echo json_encode(array("pedido_edicao" => $pedido_edicao, "menssagem" => "success"));
	}

	public function obterEmailCliente() {
		$where = array("ped_codigo" => $this->input->post('ped_codigo'));
		$fields = "cli_email, cli_nome";
		$this->load->model('Pedidos_Model');
		$cliente = $this->Pedidos_Model->getOneDataJoined($where, $fields);		
		// if validação
		echo json_encode(array("cliente" => $cliente, "menssagem" => "success"));
	}

	public function enviarEmail() {
		$where = array("ped_codigo" => $this->input->post('ped_codigo'));				
		$this->load->model('Pedidos_Model');
		$pedido = $this->Pedidos_Model->getOneDataJoined($where);
		// Obtendo os itens do pedido
		$this->load->model('Produtos_Pedido_Model');
		$pedido->itens_do_pedido = $this->Produtos_Pedido_Model->getDataJoined(array("pro_ped_codigo_pedido" => $where['ped_codigo']));		
		// if validação
		$this->configurarEmail($pedido);
		echo json_encode(array("menssagem" => "success"));		
	}

	public function configurarEmail($pedido = null){
		$this->load->library('email');
		$this->email->from("emailparatestemail@gmail.com", 'Email de teste sistema');
		$this->email->subject("Pedido nº $pedido->ped_codigo");
		// $this->email->reply_to("naorespondaesseemail@gmail.com");
		// $this->email->cc('copia@dominio.com');
		// $this->email->bcc('copia_oculta@dominio.com');		
		$menssagem = $this->configurarMenssagem($pedido);		
		$this->email->to($pedido->cli_email);
		$this->email->message($menssagem);
		$this->email->send();
	}

	public function configurarMenssagem($pedido = null) {
		$data = date('d/m/Y', strtotime($pedido->ped_data));
		$itens_pedido = "";
		foreach ($pedido->itens_do_pedido as $item) {
			$itens_pedido .= "<tr><td>$item->pro_codigo</td><td>$item->pro_nome</td><td>$item->pro_cor</td><td>$item->pro_tamanho</td><td>R$ $item->pro_valor</td></tr>";
		}
		$menssagem = "
						<html>
							<head>
								<style>
									table {
										padding: 10px;
										font-size: 15px;
									}
									td {
										padding: 5px;
									}														
								</style>
							</head>
							<body>
								<h3>Dados do pedido $pedido->ped_codigo</h3>
								<table>
									<tbody>
										<tr>
											<td>Cliente: $pedido->cli_nome</td>
											<td>Vendedor: $pedido->ven_nome</td>
										</tr>
										<tr>
											<td>Forma de pagamento: $pedido->ped_forma_pagamento</td>
											<td>Data do pedido: $data</td>
										</tr>
										<tr>
											<td>Observação: $pedido->ped_observacao</td>			
										</tr>
									</tbody>
								</table>
								<h3>Itens do pedido</h3>
								<table>
									<thead>
										<tr>
											<th>Código</th>
											<th>Nóme</th>
											<th>Cor</th>
											<th>Tamanho</th>
											<th>Valor</th>
										</tr>
									</thead>
									<tbody>
										$itens_pedido
									</tbody>
								</table>
							</body>
						</html>						
					";

		return $menssagem;
	}	

}
