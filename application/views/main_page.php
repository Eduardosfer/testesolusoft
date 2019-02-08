<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?= $page_title ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- css do bootstrap -->
	<link rel="stylesheet" type="text/css" media="screen" href="<?= base_url('public/bootstrap/css/bootstrap.min.css'); ?>">
	<!-- styles customizados do sidebar/template -->
	<link href="<?= base_url('public/template/css/simple-sidebar.css'); ?>" rel="stylesheet">	
	<!-- icones do fontawsome -->	
	<link rel="stylesheet" href="<?= base_url('public/fontawesome/css/all.css'); ?>">
</head>
<body>	
	<div class="d-flex" id="wrapper">

		<!-- Sidebar -->
		<div class="bg-light border-right" id="sidebar-wrapper">
			<div class="sidebar-heading"><i class="fab fa-hotjar"></i> TESTE SOLUSOFT</div>
			<div class="list-group list-group-flush">
				<a href="<?= site_url('Clientes'); ?>" class="list-group-item list-group-item-action bg-light"><i class="fas fa-users"></i> Clientes</a>
				<a href="<?= site_url('Vendedores'); ?>" class="list-group-item list-group-item-action bg-light"><i class="fas fa-user-tie"></i> Vendedores</a>
				<a href="<?= site_url('Produtos'); ?>" class="list-group-item list-group-item-action bg-light"><i class="fas fa-box-open"></i> Produtos</a>
				<a href="<?= site_url('Pedidos'); ?>" class="list-group-item list-group-item-action bg-light"><i class="fas fa-tasks"></i> Pedidos</a>				
			</div>
		</div>
		<!-- /#sidebar-wrapper -->

		<!-- Conteudo da pagina -->
		<div id="page-content-wrapper">		
			<div class="container-fluid">
				<!-- inclusão da página solicitada pelo back-end -->
				<?php $this->load->view($page); ?>
			</div>
		</div>
		<!-- /#page-content-wrapper -->

	</div>
	<!-- /#wrapper -->
	
	<script type="text/javascript" src="<?= base_url('public/jquery-3.3.1.min.js'); ?>"></script>
	<script type="text/javascript" src="<?= base_url('public/bootstrap/js/bootstrap.js'); ?>"></script>
	
</body>
</html>