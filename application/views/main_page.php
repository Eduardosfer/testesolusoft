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
	<!-- jquery -->
	<script type="text/javascript" src="<?= base_url('public/jquery-3.3.1.min.js'); ?>"></script>
	<!-- js bootstrap -->
	<script type="text/javascript" src="<?= base_url('public/bootstrap/js/bootstrap.js'); ?>"></script>	
	<!-- js bootstrap nescessário para o tooltip -->
	<script type="text/javascript" src="<?= base_url('public/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>	
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
				<a href="<?= site_url('Relatorios'); ?>" class="list-group-item list-group-item-action bg-light"><i class="fas fa-chart-pie"></i> Relatórios</a>				
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

	<script>

		// Inicialização do tooltip
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		});

		// Função para converção de datas
		function dataSQLToBR(dataA){	
			var data = dataA.split("-");
			var dia  = data[2].toString().padStart(2, '0');
			var mes  = data[1].toString().padStart(2, '0');
			var ano  = data[0].toString();						
			return dia+"/"+mes+"/"+ano;
		}

		function dataBRToSQL(dataA){	
			var data = dataA.split("/");
			var dia  = data[2].toString().padStart(2, '0');
			var mes  = data[1].toString().padStart(2, '0');
			var ano  = data[0].toString();						
			return dia+"-"+mes+"-"+ano;
		}

		function mostrarMenssagem(opc) {
			if (opc == 'cadastrado') {
				$("#menssagem_alert").text('Dados cadastrados com sucesso!');				
				$("#menssagem_alert").removeClass('alert-danger');
				$("#menssagem_alert").addClass('alert-dark');
				$("#menssagem_alert").fadeIn(100);
				$("#menssagem_alert").fadeOut(3000);
			}
			if (opc == 'editado') {
				$("#menssagem_alert").text('Dados editados com sucesso!');				
				$("#menssagem_alert").removeClass('alert-danger');
				$("#menssagem_alert").addClass('alert-dark');
				$("#menssagem_alert").fadeIn(100);
				$("#menssagem_alert").fadeOut(3000);
			}
			if (opc == 'removido') {
				$("#menssagem_alert").text('Dados removidos com sucesso!');				
				$("#menssagem_alert").removeClass('alert-danger');
				$("#menssagem_alert").addClass('alert-dark');
				$("#menssagem_alert").fadeIn(100);
				$("#menssagem_alert").fadeOut(3000);
			}
			if (opc == 'email') {
				$("#menssagem_alert").text('Email enviado com sucesso!');				
				$("#menssagem_alert").removeClass('alert-danger');
				$("#menssagem_alert").addClass('alert-dark');
				$("#menssagem_alert").fadeIn(100);
				$("#menssagem_alert").fadeOut(3000);
			}
			if (opc == 'erro') {
				$("#menssagem_alert").text('Erro ao salvar dados!');
				$("#menssagem_alert").removeClass('alert-dark');
				$("#menssagem_alert").addClass('alert-danger');
				$("#menssagem_alert").fadeIn(100);
				$("#menssagem_alert").fadeOut(3000);
			}
		}
		
	</script>
	
</body>
</html>