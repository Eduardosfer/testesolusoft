<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Descrição de Vendedores_Model
 *
 * @author Eduardo Sfer
 */
class Vendedores_Model extends MY_Model {	
	
	protected $table = 'vendedores';

	public function __construct() {
		parent::__construct();
	}

	// Pode ser criados metodos especificos para esse modelo, caso nescessário, além dos já existentes no MY_Model
}