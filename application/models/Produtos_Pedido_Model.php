<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Descrição de Produtos_Pedido_Model
 *
 * @author Eduardo Sfer
 */
class Produtos_Pedido_Model extends MY_Model {	
	
	protected $table = 'produtos_pedido';

	public function __construct() {
		parent::__construct();
	}

	// Pode ser criados metodos especificos para esse modelo, caso nescessário, além dos já existentes no MY_Model

	// Retorna os dados selecionados
    // $where, array que recebe as condições da busca. Não adiciona condições caso não existam.
    // $fields, string que recebe os campos que devem ser retornado. Retorna todos se não especificados.
    // $limit, int que indica o limit da busca do sql. Não considera se não for especificado.
    // $amount, offset do sql. Não considera caso não especificado.
    // $orderBy, order by do sql. Não considera caso não especificado.
    // $groupBy, group by do sql. Não considera caso não especificado.
	public function getDataJoined($where = null, $fields = null, $limit = null, $amount = null, $orderBy = null, $groupBy = null) {		
		if ($fields != null && $fields != '') {
			$this->db->select($fields);
		}		
		if ($where != null && $where != '') {
			$this->db->where($where);
		}
		if ($groupBy != null && $groupBy != '') {
			$this->db->group_by($groupBy);
		}
		if ($orderBy != null && $orderBy != '') {
			$this->db->order_by($orderBy);
		}		
		$this->db->join("produtos", "produtos.pro_codigo = $this->table.pro_ped_codigo_produto", "LEFT");				
		$object = $this->db->get($this->table, $limit, $amount);		
		return $object->result();		
	}
}