
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
				<button type="button" onclick="buscarPedidosPorPeriodo();" class="btn btn-outline-dark mb-2"><i class="fa fa-search"></i> Buscar</button>
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

			<hr>
			
			<h5>Vendedores</h5>

			<form class="form-inline" id="form_busca_pedido">				
				<label class="sr-only" for="ped_codigo_vendedor">Vendedor</label>
				<select class="custom-select my-2 mr-sm-2" id="ped_codigo_vendedor">
					<option value="">Selecione um vendedor</option>
					<?php foreach ($vendedores as $vendedor) { ?>					
					<option value="<?= $vendedor->ven_codigo ?>"><?= $vendedor->ven_nome ?></option>
					<?php } ?>
				</select>				
				<button type="button" onclick="buscarComissaoPorVendedor();" class="btn btn-outline-dark"><i class="fa fa-search"></i> Buscar</button>
			</form>

			<div class="table-responsive" id="tabela_comissao_vendedor" style="display: none;">										
				<table class="table table-striped">
					<thead class="thead-dark">
						<tr>
							<th>Mês</th>
							<th>Valor total de pedidos</th>
							<th>Comissão do vendedor</th>							
						</tr>
					</thead>
					<tbody id="corpo_tabela_comissao_vendedor">						
						
					</tbody>
				</table>												
			</div>

			<div class="text-center" id="sem_dados_comissao_vendedor" style="display: none;">
				<div class="alert alert-dark text-center" role="alert">Nehum dado foi encontrado para essa busca</div>
			</div>

		</div>

		<div class="tab-pane fade" id="nav-total_cliente" role="tabpanel" aria-labelledby="nav-total_cliente-tab">
			
			<h4>Relatório de total de pedidos por cliente</h4>

			<hr>
			
			<h5>Clientes</h5>

			<form class="form-inline" id="form_busca_pedido">				
				<label class="sr-only" for="ped_codigo_cliente">Cliente</label>
				<select class="custom-select my-2 mr-sm-2" id="ped_codigo_cliente">
					<option value="">Selecione um cliente</option>
					<?php foreach ($clientes as $cliente) { ?>					
					<option value="<?= $cliente->cli_codigo ?>"><?= $cliente->cli_nome ?></option>
					<?php } ?>
				</select>				
				<button type="button" onclick="buscarPedidosPorCliente();" class="btn btn-outline-dark"><i class="fa fa-search"></i> Buscar</button>
			</form>

			<div class="table-responsive" id="tabela_pedidos_cliente" style="display: none;">										
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
					<tbody id="corpo_tabela_pedidos_cliente">						
						
					</tbody>
				</table>												
			</div>

			<div class="text-center" id="sem_dados_pedidos_cliente" style="display: none;">
				<div class="alert alert-dark text-center" role="alert">Nehum dado foi encontrado para essa busca</div>
			</div>

		</div>
	</div>

	<script>
		function buscarPedidosPorPeriodo() {
			var data_inicio = $("#ped_data_inicio").val();
			var data_fim = $("#ped_data_fim").val();
			$.post( "<?= site_url('Relatorios/obterPedidosPorPeriodo'); ?>", { data_inicio: data_inicio, data_fim: data_fim } )
			.done(function( data ) {
				data = JSON.parse(data);
				if (data.menssagem == 'success') {
					var pedidos_periodo = data.pedidos_periodo;
					if (pedidos_periodo.length > 0) {
						$("#sem_dados_pedidos_periodo").fadeOut(100);
						$("#tabela_pedidos_periodo").fadeIn(100);	
						$("#corpo_tabela_pedidos_periodo").html("");					
						$(pedidos_periodo).each( function () {
							$("#corpo_tabela_pedidos_periodo").append(`
																		<tr>
																			<td>${this.ped_codigo}</td>																			
																			<td>${this.cli_nome}</td>																			
																			<td>${this.ven_nome}</td>																			
																			<td>${dataSQLToBR(this.ped_data)}</td>																			
																			<td>${this.ped_observacao}</td>																			
																			<td>${this.ped_forma_pagamento}</td>																			
																			<td>${this.total_produtos}</td>																			
																			<td>R$ ${parseFloat(this.valor_total_produtos).toFixed(2)}</td>																			
																		</tr>
																	`);
						});
					} else {
						$("#tabela_pedidos_periodo").fadeOut(100);
						$("#sem_dados_pedidos_periodo").fadeIn(100);					
					}
				} else {						
					mostrarMenssagem('erro');
				}
			});	
		}

		$("#ped_codigo_cliente").change( function () {
			buscarPedidosPorCliente();
		});

		function buscarPedidosPorCliente() {			
			var ped_codigo_cliente = $("#ped_codigo_cliente").val();
			$.post( "<?= site_url('Relatorios/obterPedidosPorCliente'); ?>", { ped_codigo_cliente: ped_codigo_cliente } )
			.done(function( data ) {
				data = JSON.parse(data);
				if (data.menssagem == 'success') {
					var pedidos_cliente = data.pedidos_cliente;
					var quantidade_total = 0;
					var valor_total = 0;
					if (pedidos_cliente.length > 0) {						
						$("#sem_dados_pedidos_cliente").fadeOut(100);
						$("#tabela_pedidos_cliente").fadeIn(100);	
						$("#corpo_tabela_pedidos_cliente").html("");					
						$(pedidos_cliente).each( function () {
							quantidade_total = parseInt(quantidade_total) + parseInt(this.total_produtos);
							valor_total = parseFloat(valor_total) + parseFloat(this.valor_total_produtos);
							$("#corpo_tabela_pedidos_cliente").append(`
																		<tr>
																			<td>${this.ped_codigo}</td>																			
																			<td>${this.cli_nome}</td>																			
																			<td>${this.ven_nome}</td>																			
																			<td>${dataSQLToBR(this.ped_data)}</td>																			
																			<td>${this.ped_observacao}</td>																			
																			<td>${this.ped_forma_pagamento}</td>																			
																			<td>${this.total_produtos}</td>																			
																			<td>R$ ${parseFloat(this.valor_total_produtos).toFixed(2)}</td>																			
																		</tr>
																	`);
						});

						$("#corpo_tabela_pedidos_cliente").append(`
																		<tr>
																			<td>Totais</td>																			
																			<td></td>																			
																			<td></td>																			
																			<td></td>																			
																			<td></td>																			
																			<td></td>																			
																			<td>${quantidade_total}</td>																			
																			<td>R$ ${parseFloat(valor_total).toFixed(2)}</td>																			
																		</tr>
																	`);

					} else {
						$("#tabela_pedidos_cliente").fadeOut(100);
						$("#sem_dados_pedidos_cliente").fadeIn(100);					
					}
				} else {						
					mostrarMenssagem('erro');
				}
			});	
		}

		function buscarComissaoPorVendedor() {			
			var ped_codigo_vendedor = $("#ped_codigo_vendedor").val();
			$.post( "<?= site_url('Relatorios/obterComissaoPorVendedor'); ?>", { ped_codigo_vendedor: ped_codigo_vendedor } )
			.done(function( data ) {
				data = JSON.parse(data);
				if (data.menssagem == 'success') {
					var comissao_vendedor = data.comissao_vendedor;
					var valor_geral_pedidos = 0;
					var valor_geral_comissao = 0;
					if (comissao_vendedor.length > 0) {						
						$("#sem_dados_comissao_vendedor").fadeOut(100);
						$("#tabela_comissao_vendedor").fadeIn(100);	
						$("#corpo_tabela_comissao_vendedor").html("");					
						$(comissao_vendedor).each( function () {
							valor_geral_pedidos = parseFloat(valor_geral_pedidos) + parseFloat(this.valor_total_pedidos);
							valor_geral_comissao = parseFloat(valor_geral_comissao) + parseFloat(this.valor_total_comissao);
							$("#corpo_tabela_comissao_vendedor").append(`
																		<tr>																																						
																			<td>${this.ped_mes}/${this.ped_ano}</td>																																						
																			<td>R$ ${parseFloat(this.valor_total_pedidos).toFixed(2)}</td>																			
																			<td>R$ ${parseFloat(this.valor_total_comissao).toFixed(2)}</td>																			
																		</tr>
																	`);
						});

						$("#corpo_tabela_comissao_vendedor").append(`
																		<tr>
																			<td>Totais</td>																																																																												
																			<td>R$ ${parseFloat(valor_geral_pedidos).toFixed(2)}</td>																			
																			<td>R$ ${parseFloat(valor_geral_comissao).toFixed(2)}</td>																			
																		</tr>
																	`);

					} else {
						$("#tabela_comissao_vendedor").fadeOut(100);
						$("#sem_dados_comissao_vendedor").fadeIn(100);					
					}
				} else {						
					mostrarMenssagem('erro');
				}
			});	
		}
	</script>
	
</div>

