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
		$this->db->select("$this->table.*, $this->table.ped_codigo as ped_codigo_atual");
		$this->db->select("clientes.cli_nome");
		$this->db->select("vendedores.ven_nome");
		$this->db->select("(select count(pro_ped_codigo) from produtos_pedido where pro_ped_codigo_pedido = ped_codigo_atual) as total_produtos");
		$this->db->select("(select sum(pro_valor) from produtos, produtos_pedido where pro_codigo = pro_ped_codigo_produto and pro_ped_codigo_pedido = ped_codigo_atual) as valor_total_produtos");
		$this->db->where("ped_data >=", $data_inicio);
		$this->db->where("ped_data <=", $data_fim);
		$this->db->join("clientes", "clientes.cli_codigo = $this->table.ped_codigo_cliente", "LEFT");		
		$this->db->join("vendedores", "vendedores.ven_codigo = $this->table.ped_codigo_vendedor", "LEFT");
		$object = $this->db->get($this->table);
		return $object->result();
	}

	public function getPedidosPorCliente($ped_codigo_cliente = null) {
		$this->db->select("$this->table.*, $this->table.ped_codigo as ped_codigo_atual");
		$this->db->select("clientes.cli_nome");
		$this->db->select("vendedores.ven_nome");
		$this->db->select("(select count(pro_ped_codigo) from produtos_pedido where pro_ped_codigo_pedido = ped_codigo_atual) as total_produtos");
		$this->db->select("(select sum(pro_valor) from produtos, produtos_pedido where pro_codigo = pro_ped_codigo_produto and pro_ped_codigo_pedido = ped_codigo_atual) as valor_total_produtos");
		$this->db->where("ped_codigo_cliente", $ped_codigo_cliente);		
		$this->db->join("clientes", "clientes.cli_codigo = $this->table.ped_codigo_cliente", "LEFT");		
		$this->db->join("vendedores", "vendedores.ven_codigo = $this->table.ped_codigo_vendedor", "LEFT");
		$object = $this->db->get($this->table);
		return $object->result();
	}

	public function getComissaoPorVendedor($ped_codigo_vendedor = null) {		
		$data_inicio = date("Y-m", strtotime("-5 months"));
		$data_fim = date('Y-m');
		$this->db->select("extract(month from ped_data) as ped_mes, extract(year from ped_data) as ped_ano");				
		$this->db->select("sum(pro_valor) as valor_total_pedidos");
		$this->db->select("sum(pro_valor * (vendedores.ven_comissao/100)) as valor_total_comissao");
		$this->db->from("produtos, produtos_pedido, pedidos");
		$this->db->where("pro_codigo = pro_ped_codigo_produto and pro_ped_codigo_pedido = ped_codigo");
		$this->db->where("ped_codigo_vendedor", $ped_codigo_vendedor);
		$this->db->where("ped_data >=", $data_inicio);
		$this->db->where("ped_data <=", $data_fim);			
		$this->db->join("vendedores", "vendedores.ven_codigo = $this->table.ped_codigo_vendedor");
		$this->db->group_by("ped_ano, ped_mes");
		$this->db->order_by("ped_ano, ped_mes", "ASC");
		$object = $this->db->get();		
		return $object->result();
	}

}