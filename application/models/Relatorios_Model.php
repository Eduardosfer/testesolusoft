<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Descrição de Relatorios_Model
 *
 * @author Eduardo Sfer
 */
class Relatorios_Model extends MY_Model {	
	
	protected $table = 'pedidos';

	public function __construct() {
		parent::__construct();
	}

	// Pode ser criados metodos especificos para esse modelo, caso nescessário, além dos já existentes no MY_Model
	
	public function getPedidosPorPeriodo($data_inicio = null, $data_fim = null) {
		$this->db->select("pedidos.*, pedidos.ped_codigo as ped_codigo_atual");
		$this->db->select("clientes.cli_nome");
		$this->db->select("vendedores.ven_nome");
		$this->db->select("(select count(ped_pro_codigo) from pedidos_produto where ped_pro_codigo_pedido = ped_codigo_atual) as total_produtos");
		$this->db->select("(select sum(pro_valor) from produtos, pedidos_produto where pro_codigo = ped_pro_codigo_produto and ped_pro_codigo_pedido = ped_codigo_atual) as valor_total_produtos");
		$this->db->where("ped_data >=", $data_inicio);
		$this->db->where("ped_data <=", $data_fim);
		$this->db->join("clientes", "clientes.cli_codigo = $this->table.ped_codigo_cliente", "LEFT");		
		$this->db->join("vendedores", "vendedores.ven_codigo = $this->table.ped_codigo_vendedor", "LEFT");		
		$object = $this->db->get($this->table, $limit, $amount);		
		return $object->result();		
	}

}