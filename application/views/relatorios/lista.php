
<div id="conteudo">
	
	<div>
		<h2><?= $page_title ?></h2>
	</div>

	<hr>

	<nav>
		<div class="nav nav-tabs" id="nav-tab" role="tablist">
			<a class="nav-item nav-link active" id="nav-pedidos-tab" data-toggle="tab" href="#nav-pedidos" role="tab" aria-controls="nav-pedidos" aria-selected="true">
				<i class="fa fa-tasks"></i> Pedidos
			</a>
			<a class="nav-item nav-link" id="nav-comissao-tab" data-toggle="tab" href="#nav-comissao" role="tab" aria-controls="nav-comissao" aria-selected="false">
				<i class="fas fa-hand-holding-usd"></i> Comissão
			</a>
			<a class="nav-item nav-link" id="nav-total_cliente-tab" data-toggle="tab" href="#nav-total_cliente" role="tab" aria-controls="nav-total_cliente" aria-selected="false">
				<i class="fas fa-shopping-basket"></i> Total por cliente
			</a>
		</div>
	</nav>	

	<div class="tab-content" id="nav-tabContent">
		<div class="tab-pane fade show active" id="nav-pedidos" role="tabpanel" aria-labelledby="nav-pedidos-tab">
			<h4>Relatório de pedidos</h4>
		</div>
		<div class="tab-pane fade" id="nav-comissao" role="tabpanel" aria-labelledby="nav-comissao-tab">
			<h4>Relatório de comissão por vendedor nos ultimos 6 meses</h4>
		</div>
		<div class="tab-pane fade" id="nav-total_cliente" role="tabpanel" aria-labelledby="nav-total_cliente-tab">
			<h4>Relatório de total de pedidos por cliente</h4>
		</div>
	</div>
	
</div>

