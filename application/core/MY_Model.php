<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Descrição de MY_Model
 * Este modelo tem a função de centralizar os códigos do CRUD, pois com ele, assim que crio um modelo 
 * e herdo deste, automaticamente ja tenho as funções básicas do CRUD sem precisar repetir código
 *  
 * @author Eduardo Sfer
 */
class MY_Model extends CI_Model {	
    
    // Atributo que recebe o nome da tabela, que é reescrito nos modelos que irão herdar essa classe
    protected $table = '';

	public function __construct() {
		parent::__construct();
	}
    
    // Recebe o array $data com os dados que vem do controle, faz a inserção e retorna ultimo id inserido
	public function insertData($data = null) {
		$this->db->insert($this->table, $data);
		$inserted_id = $this->db->insert_id();
		return $inserted_id;
	}

    // Retorna os dados selecionados
    // $where, array que recebe as condições da busca. Não adiciona condições caso não existam.
    // $fields, string que recebe os campos que devem ser retornado. Retorna todos se não especificados.
    // $limit, int que indica o limit da busca do sql. Não considera se não for especificado.
    // $amount, offset do sql. Não considera caso não especificado.
    // $orderBy, order by do sql. Não considera caso não especificado.
    // $groupBy, group by do sql. Não considera caso não especificado.
	public function getData($where = null, $fields = null, $limit = null, $amount = null, $orderBy = null, $groupBy = null) {		
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
		$object = $this->db->get($this->table, $limit, $amount);		
		return $object->result();		
	}

    // Retorna apenas um objeto (uma linha da tabela)
    // $where, array que recebe as condições da busca. Não adiciona condições caso não existam.
    // $fields, string que recebe os campos que devem ser retornado. Retorna todos se não especificados.
    // $limit, int que indica o limit da busca do sql. Não considera se não for especificado.
    // $amount, offset do sql. Não considera caso não especificado.
    // $orderBy, order by do sql. Não considera caso não especificado.
    // $groupBy, group by do sql. Não considera caso não especificado.
	public function getOneData($where = null, $fields = null, $limit = null, $amount = null, $orderBy = null, $groupBy = null) {		
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
		$object = $this->db->get($this->table, $limit, $amount);		
		return $object->row();	
	}

    // Atualiza os dados
    // $data, array (chave => valor) com os dados a serem atualizados
    // $where, array que recebe as condições da atualização. Não adiciona condições caso não existam.
	public function updateData($data = null, $where = null) {
		if ($where != null && $where != '') {
			$this->db->where($where);
		}
		$this->db->update($this->table, $data);
	}

    // Deleta os dados    
    // $where, array que recebe as condições de deleção. Não adiciona condições caso não existam.
	public function deleteData($where = null) {
		if ($where != null && $where != '') {
			$this->db->where($where);
		}
        $this->db->delete($this->table);
	}	
}