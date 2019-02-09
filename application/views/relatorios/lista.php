
<div id="conteudo">
	
	<div>
		<h2><?= $page_title ?></h2>
	</div>

	<hr>

	<nav>
		<div class="nav nav-tabs" id="nav-tab" role="tablist">
			<a class="nav-item nav-link text-dark active" id="nav-pedidos-tab" data-toggle="tab" href="#nav-pedidos" role="tab" aria-controls="nav-pedidos" aria-selected="true">
				<i class="fa fa-tasks"></i> Pedidos por periodo
			</a>
			<a class="nav-item nav-link text-dark" id="nav-comissao-tab" data-toggle="tab" href="#nav-comissao" role="tab" aria-controls="nav-comissao" aria-selected="false">
				<i class="fas fa-hand-holding-usd"></i> Comissão
			</a>
			<a class="nav-item nav-link text-dark" id="nav-total_cliente-tab" data-toggle="tab" href="#nav-total_cliente" role="tab" aria-controls="nav-total_cliente" aria-selected="false">
				<i class="fas fa-shopping-basket"></i> Total por cliente
			</a>
		</div>
	</nav>	

	<div class="tab-content" id="nav-tabContent">
		<div class="tab-pane fade show active" id="nav-pedidos" role="tabpanel" aria-labelledby="nav-pedidos-tab">
			
			<h4>Relatório de pedidos por periodo</h4>
			
			<hr>
			
			<h5>Periodo</h5>

			<form class="form-inline" id="form_busca_pedido">				
				<div class="form-group mb-2">
					<label for="ped_data_inicio" class="sr-only">Data início</label>
					<input type="date" class="form-control" id="ped_data_inicio" placeholder="Password">
				</div>
				<div class="form-group mx-sm-3 mb-2">
					<label for="ped_data_fim" class="sr-only">Data fim</label>
					<input type="date" class="form-control" id="ped_data_fim" placeholder="Password">
				</div>
				<button type="button" class="btn btn-outline-dark mb-2"><i class="fa fa-search"></i> Buscar</button>
			</form>

			<div class="table-responsive" id="tabela_pedidos_periodo" style="display: none;">										
				<table class="table table-striped">
					<thead class="thead-dark">
						<tr>
							<th>Código</th>
							<th>Cliente</th>
							<th>Vendedor</th>
							<th>Data</th>
							<th>Observação</th>							
							<th>Forma de pagamento</th>							
							<th>Total de produtos</th>							
							<th>Valor total</th>							
						</tr>
					</thead>
					<tbody id="corpo_tabela_pedidos_periodo">						
						
					</tbody>
				</table>												
			</div>

			<div class="text-center" id="sem_dados_pedidos_periodo" style="display: none;">
				<div class="alert alert-dark text-center" role="alert">Nehum dado foi encontrado para essa busca</div>
			</div>

		</div>

		<div class="tab-pane fade" id="nav-comissao" role="tabpanel" aria-labelledby="nav-comissao-tab">
			<h4>Relatório de comissão por vendedor nos ultimos 6 meses</h4>
		</div>

		<div class="tab-pane fade" id="nav-total_cliente" role="tabpanel" aria-labelledby="nav-total_cliente-tab">
			<h4>Relatório de total de pedidos por cliente</h4>
		</div>
	</div>
	
</div>

