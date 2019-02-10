
<div id="conteudo">
	
	<div>
		<h2><?= $page_title ?></h2>
	</div>

	<div>
		<button type="button" id="cadastrar_novo" class="btn btn-outline-dark" data-toggle="modal" data-target="#modal_cadastro">
			<i class="fas fa-plus-circle"></i> Cadastrar novo
		</button>
	</div>

	<hr>

	<div class="table-responsive">										
		<table class="table table-striped">
			<thead class="thead-dark">
				<tr>
					<th>Código</th>
					<th>Cliente</th>
					<th>Vendedor</th>
					<th>Data</th>
					<th>Observação</th>
					<th>Forma de pagamento</th>
					<th class="text-center">Opções</th>
				</tr>
			</thead>
			<tbody id="corpo_tabela">
				<?php if (isset($pedidos[0]->ped_codigo)) { ?>	
					<?php foreach ($pedidos as $dado) { ?>
						<tr id="tr_item_<?= $dado->ped_codigo ?>">
							<td><?= $dado->ped_codigo ?></td>
							<td><?= $dado->cli_nome ?></td>
							<td><?= $dado->ven_nome ?></td>
							<td><?= date('d/m/Y', strtotime($dado->ped_data)) ?></td>
							<td><?= $dado->ped_observacao ?></td>							
							<td><?= $dado->ped_forma_pagamento ?></td>							
							<td class="text-center">																						
								<button type="button" onclick="enviarPedido('mostrar',  <?= $dado->ped_codigo ?>);" data-toggle="tooltip" data-placement="top" title="Enviar por email" class="btn btn-dark"><i class="fas fa-envelope"></i></button>
								<button type="button" onclick="imprimirPedido(<?= $dado->ped_codigo ?>);" data-toggle="tooltip" data-placement="top" title="Imprimir" class="btn btn-dark"><i class="fas fa-print"></i></button>
								<button type="button" onclick="editarPedido('mostrar',  <?= $dado->ped_codigo ?>);" data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-outline-dark"><i class="fas fa-pen"></i></button>
								<button type="button" onclick="removerPedido('mostrar', <?= $dado->ped_codigo ?>);" data-toggle="tooltip" data-placement="top" title="Excluir" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
							</td>
						</tr>							
					<?php } ?>
				<?php } else { ?>		
					<div class="text-center">
						<div id="alert_sem_dados" class="alert alert-dark text-center" role="alert">Nenhum dado cadastrado</div>
					</div>
				<?php } ?>
			</tbody>
		</table>										
	</div>

	<div class="text-center">
		<div id="menssagem_alert" style="display: none;" class="alert alert-dark text-center" role="alert"></div>
	</div>

	<!-- Modais -->	

	<!-- Modal de cadastro -->
	<div class="modal fade" id="modal_cadastro" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modal_cadastro" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header bg-dark text-white">
					<h5 class="modal-title" id="modal_cadastro_title">Cadastro de pedido</h5>
					<button onclick="limparCadastro();" type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="formulario_cadastro">

						<!-- sessão dos dados do pedido -->
						<div class="row">
							
							<div class="col-md-6">
									<div class="form-group">
										<label for="ped_codigo_cliente">Cliente</label>
										<select class="form-control para_cadastrar" id="ped_codigo_cliente" name="ped_codigo_cliente">
											<option value="">Selecione um cliente</option>
											<?php foreach ($clientes as $cliente) { ?>
											<option value="<?= $cliente->cli_codigo ?>"><?= $cliente->cli_nome ?></option>
										<?php } ?>																							
									</select>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="ped_codigo_vendedor">Vendedor</label>
									<select class="form-control para_cadastrar" id="ped_codigo_vendedor" name="ped_codigo_vendedor">
										<option value="">Selecione um vendedor</option>
										<?php foreach ($vendedores as $vendedor) { ?>
											<option value="<?= $vendedor->ven_codigo ?>"><?= $vendedor->ven_nome ?></option>
										<?php } ?>																									
									</select>
								</div>
							</div>								

							<div class="col-md-6">
								<div class="form-group">
									<label for="ped_forma_pagamento">Forma de pagamento</label>
									<select class="form-control para_cadastrar" id="ped_forma_pagamento" name="ped_forma_pagamento">
										<option value="">Selecione a forma de pagamento</option>										
										<option value="Dinheiro">Dinheiro</option>																															
										<option value="Cartão">Cartão</option>																															
										<option value="Cheque">Cheque</option>																															
									</select>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="ped_data">Data do pedido</label>
									<input type="date" class="form-control para_cadastrar" id="ped_data" name="ped_data" placeholder="Informe a data do pedido">							
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label for="ped_observacao">Observação</label>
									<input type="text" class="form-control ped_observacao para_cadastrar" id="ped_observacao" name="ped_observacao" placeholder="Faça alguma observação, caso nescessário">							
								</div>
							</div>														

						</div>
						<!-- fim da sessão dos dados do pedido -->

						<!-- sessão dos itens do pedido -->
						<div class="row" id="div_produtos">
							
							<div class="col-md-10">
								<label for="produto">Produtos</label>
								<div class="input-group">
									<select class="form-control" id="produto">
										<option value="">Selecione um produto</option>
										<?php foreach ($produtos as $produto) { ?>
											<option value="<?= $produto->pro_codigo ?>"><?= $produto->pro_codigo . " | " . $produto->pro_nome . " | " . $produto->pro_cor . " | " . $produto->pro_tamanho . " | R$" . $produto->pro_valor ?></option>
										<?php } ?>																							
									</select>
									<div class="input-group-btn">								
										<button type="button" onclick="adicionarItemPedido('cadastro')" class="btn btn-dark"><i class="fa fa-plus-circle"></i> Adicionar</button> 								
									</div>
								</div>
							</div>							
							
							
							<div class="col-md-12" style="margin-top: 10px;">
								<h4>Itens do pedido</h4>
							</div>																																												

						</div>
						<!-- fim da sessão dos itens do pedido -->

					</form>
				</div>
				<div class="modal-footer">
					<button type="button" onclick="limparCadastro();" class="btn btn-outline-secondary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Fechar</button>
					<button type="button" onclick="cadastrarPedido();" class="btn btn-dark"><i class="fas fa-save"></i> Salvar</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Fim do modal de cadastro -->	

	<!-- Modal de edição -->
	<div class="modal fade" id="modal_edicao" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modal_edicao" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header bg-dark text-white">
					<h5 class="modal-title" id="modal_edicao_title">Edição de pedido</h5>
					<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="formulario_edicao">
						
						<!-- sessão dos dados do pedido -->
						<div class="row">
						
							<div class="col-md-6">
									<div class="form-group">
										<label for="edit_ped_codigo_cliente">Cliente</label>
										<select class="form-control para_editar" id="edit_ped_codigo_cliente" name="ped_codigo_cliente">
											<option value="">Selecione um cliente</option>
											<?php foreach ($clientes as $cliente) { ?>
											<option value="<?= $cliente->cli_codigo ?>"><?= $cliente->cli_nome ?></option>
										<?php } ?>																							
									</select>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="edit_ped_codigo_vendedor">Vendedor</label>
									<select class="form-control para_editar" id="edit_ped_codigo_vendedor" name="ped_codigo_vendedor">
										<option value="">Selecione um vendedor</option>
										<?php foreach ($vendedores as $vendedor) { ?>
											<option value="<?= $vendedor->ven_codigo ?>"><?= $vendedor->ven_nome ?></option>
										<?php } ?>																									
									</select>
								</div>
							</div>								

							<div class="col-md-6">
								<div class="form-group">
									<label for="edit_ped_forma_pagamento">Forma de pagamento</label>
									<select class="form-control para_editar" id="edit_ped_forma_pagamento" name="ped_forma_pagamento">
										<option value="">Selecione a forma de pagamento</option>										
										<option value="Dinheiro">Dinheiro</option>																															
										<option value="Cartão">Cartão</option>																															
										<option value="Cheque">Cheque</option>																															
									</select>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="edit_ped_data">Data do pedido</label>
									<input type="date" class="form-control para_editar" id="edit_ped_data" name="ped_data" placeholder="Informe a data do pedido">							
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label for="edit_ped_observacao">Observação</label>
									<input type="text" class="form-control edit_ped_observacao para_editar" id="edit_ped_observacao" name="ped_observacao" placeholder="Faça alguma observação, caso nescessário">							
								</div>
							</div>														

						</div>
						<!-- Fim da sessão dos dados do pedido -->

						<!-- sessão dos itens do pedido -->
						<div class="row" id="div_produtos_edicao">
							
							<div class="col-md-10">
								<label for="produto_edicao">Produtos</label>
								<div class="input-group">
									<select class="form-control" id="produto_edicao">
										<option value="">Selecione um produto</option>
										<?php foreach ($produtos as $produto) { ?>
											<option value="<?= $produto->pro_codigo ?>"><?= $produto->pro_codigo . " | " . $produto->pro_nome . " | " . $produto->pro_cor . " | " . $produto->pro_tamanho . " | R$" . $produto->pro_valor ?></option>
										<?php } ?>																							
									</select>
									<div class="input-group-btn">								
										<button type="button" onclick="adicionarItemPedido('edicao')" class="btn btn-dark"><i class="fa fa-plus-circle"></i> Adicionar</button> 								
									</div>
								</div>
							</div>							
							
							
							<div class="col-md-12" style="margin-top: 10px;">
								<h4>Itens do pedido</h4>
							</div>																																												

						</div>
						<!-- fim da sessão dos itens do pedido -->
																		
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cancelar</button>
					<button type="button" id="botao_editar" class="btn btn-dark"><i class="fas fa-save"></i> Salvar</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Fim do modal de edição -->

	<!-- Modal de exclusão -->
	<div class="modal fade" id="modal_exclusao" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modal_exclusao" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header bg-danger text-white">
					<h5 class="modal-title" id="modal_exclusao_title">Deseja realmente excuir o pedido?</h5>
					<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>A exclusão do item é permanente, o mesmo não poderá ser restaurado.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Fechar</button>
					<button type="button" id="botao_remover" class="btn btn-danger"><i class="fas fa-trash"></i> Excluir</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Fim do modal de exclusão -->

	<!-- Modal de envio de pedido por email -->
	<div class="modal fade" id="modal_enviar_pedido" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modal_enviar_pedido" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header bg-dark text-white">
					<h5 class="modal-title" id="modal_enviar_pedido_title">Deseja enviar o pedido?</h5>
					<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">	
					<div class="row">			
						<div class="col-md-12">
							<div class="form-group">
								<label id="label_cli_email" for="enviar_cli_email">Deseja enviar o pedido para o seguinte email:</label>
								<input readonly="true" type="email" class="form-control" id="enviar_cli_email" name="enviar_cli_email">							
							</div>
						</div>
					</div>	
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cancelar</button>
					<button type="button" id="botao_enviar_pedido" class="btn btn-dark"><i class="fas fa-envelope"></i> Enviar</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Fim do modal de pedido por email -->

	<!-- Fim de modais -->

	<script>		

		function cadastrarPedido() {
			var itens_cadastro = $("#formulario_cadastro").find(".para_cadastrar");
			var itens_do_pedido = $("#formulario_cadastro").find(".itens_do_pedido");
			var dados_post = {};			
			var dados_produtos = ";";

			// Será preciso, pois, possuem selects com ids no value e por esse motivo, é preciso pegar o text para preencher a tabela (front-end)
			var dados_para_tabela = {};

			// Preparando os dados do pedido para enviar para o beck-end
			$(itens_cadastro).each( function () {
				dados_post[$(this).attr('name')] = $(this).val();				
				if (this.tagName.toUpperCase() == "SELECT") {
					dados_para_tabela[$(this).attr('name')] = $(this).find('option:selected').text();
				} else {
					dados_para_tabela[$(this).attr('name')] = $(this).val();
				}
			});	

			// Preparando os dados dos itens do pedido para enviar para o beck-end
			var codigo_produto;
			$(itens_do_pedido).each( function () {
				codigo_produto = $(this).val().split(" | ");
				dados_produtos += codigo_produto[0]+";";
			});			

			dados_post['itens_do_pedido'] = dados_produtos;
			
			// Enviando dados para o beck-end
			$.post( "<?= site_url('Pedidos/cadastrar'); ?>", { dados_post: dados_post } )
			.done(function( data ) {
				data = JSON.parse(data);
				if (data.menssagem == 'success') {					
					limparCadastro();
					$("#modal_cadastro").modal('hide');
					dados_para_tabela['ped_codigo'] = data.id;
					adicionarItemTabela(dados_para_tabela);
					mostrarMenssagem('cadastrado');					
				} else {
					mostrarMenssagem('erro');
				}
			});
		}		

		function editarPedido(opc, ped_codigo) {						
							
			// Mostra os modal de edição com os dados preenchidos
			if (opc == 'mostrar') {
				configurarModalEdicao(ped_codigo);
			}
			
			// Faz a auteração dos dados no beck-end e na tabela (front-end)				
			if (opc == 'editar') {

				// Obtendo os dados editados
				var itens_edicao = $("#formulario_edicao").find(".para_editar");
				var itens_do_pedido = $("#formulario_edicao").find(".itens_do_pedido_edicao");
				var dados_post = {};			
				var dados_produtos = ";";

				// Será preciso, pois, possuem selects com ids no value e por esse motivo, é preciso pegar o text para preencher a tabela (front-end)
				var dados_para_tabela = {};

				// Preparando os dados do pedido para enviar para o beck-end
				$(itens_edicao).each( function () {
					dados_post[$(this).attr('name')] = $(this).val();				
					if (this.tagName.toUpperCase() == "SELECT") {
						dados_para_tabela[$(this).attr('name')] = $(this).find('option:selected').text();
					} else {
						dados_para_tabela[$(this).attr('name')] = $(this).val();
					}
				});	

				// Preparando os dados dos itens do pedido para enviar para o beck-end
				var codigo_produto;
				$(itens_do_pedido).each( function () {
					codigo_produto = $(this).val().split(" | ");
					dados_produtos += codigo_produto[0]+";";
				});			

				dados_post['itens_do_pedido'] = dados_produtos;				
								
				// var dados_post, refere-se aos dados que foram editados pelo usuário				
				dados_post['ped_codigo'] = ped_codigo;	
				dados_para_tabela['ped_codigo']	= ped_codigo;		

				$.post( "<?= site_url('Pedidos/editar'); ?>", { dados_post: dados_post } )
				.done(function( data ) {
					data = JSON.parse(data);
					if (data.menssagem == 'success') {											
						$("#modal_edicao").modal('hide');						
						editarItemTabela(dados_para_tabela);
						mostrarMenssagem('editado');					
					} else {
						mostrarMenssagem('erro');
					}
				});				
			}				
		}

		function removerPedido(opc, id) {			
			// Mostra o modal de remoção e seta o codigo que deve ser removido
			if (opc == 'mostrar') {
				$("#modal_exclusao").modal('show');
				var botao = $("#modal_exclusao").find("#botao_remover");
				$(botao).val(id);
				$(botao).attr("onclick", `removerPedido('remover', ${id})`);
			}		

			// Remove o item efetivamente, tanto do banco de dados, como da tabela no front-end
			if (opc == 'remover') {
				var dados_post = {};
				
				// Obtendo o codigo do item que deve ser removido
				dados_post['ped_codigo'] = id;

				// Enviando a requisição de remoção + dado que deve ser removido para o beck-end
				$.post( "<?= site_url('Pedidos/remover'); ?>", { dados_post: dados_post } )
				.done(function( data ) {
					data = JSON.parse(data);
					if (data.menssagem == 'success') {											
						removerItemTabela(id);
						$("#modal_exclusao").modal('hide');
						mostrarMenssagem('removido');			
					} else {						
						mostrarMenssagem('erro');
					}
				});				
			}	
			
		}

		function enviarPedido(opc, ped_codigo) {
			
			if (opc == 'mostrar') {
				var botao = $("#modal_enviar_pedido").find("#botao_enviar_pedido");				
				$(botao).attr("onclick", `enviarPedido('enviar', ${ped_codigo})`);
				$.post( "<?= site_url('Pedidos/obterEmailCliente'); ?>", { ped_codigo: ped_codigo } )
				.done(function( data ) {
					data = JSON.parse(data);
					if (data.menssagem == 'success') {				
						var cliente = data.cliente;							
						$("#label_cli_email").text("Deseja enviar o email para: "+ cliente.cli_nome);
						$("#enviar_cli_email").val(cliente.cli_email);
						$("#modal_enviar_pedido").modal("show");						
					} else {						
						mostrarMenssagem('erro');
					}
				});				
			}

			if (opc == 'enviar') {
				var botao = $("#modal_enviar_pedido").find("#botao_enviar_pedido");											
				$(botao).attr("onclick", `enviarPedido('enviar', ${ped_codigo})`);
				$.post( "<?= site_url('Pedidos/enviarEmail'); ?>", { ped_codigo: ped_codigo } )
				.done(function( data ) {
					data = JSON.parse(data);
					if (data.menssagem == 'success') {				
						$("#modal_enviar_pedido").modal('hide');
						mostrarMenssagem('email');	
					} else {						
						mostrarMenssagem('erro');
					}
				});	
			}
		}
		
		function adicionarItemPedido(opc) {
			if (opc == 'cadastro') {
				var item = $("#produto :selected").text();
				$("#div_produtos").append(`
											<div class="col-md-12 div_itens_do_pedido" style="margin-top: 10px;">
												<div class="input-group">
													<input readonly="true" value="${item}" class="form-control itens_do_pedido" type="text">
													<div class="input-group-btn">
														<button onclick="removerItemPedido(this)" data-toggle="tooltip" data-placement="top" title="Remover item do pedido" class="btn btn-danger" type="button">
															<i class="fas fa-trash"></i>
														</button>
													</div>
												</div>								
											</div>
										`);			
			}
			if (opc == 'edicao') {
				var item = $("#produto_edicao :selected").text();
				$("#div_produtos_edicao").append(`
											<div class="col-md-12 div_itens_do_pedido_edicao" style="margin-top: 10px;">
												<div class="input-group">
													<input readonly="true" value="${item}" class="form-control itens_do_pedido_edicao" type="text">
													<div class="input-group-btn">
														<button onclick="removerItemPedido(this)" data-toggle="tooltip" data-placement="top" title="Remover item do pedido" class="btn btn-danger" type="button">
															<i class="fas fa-trash"></i>
														</button>
													</div>
												</div>								
											</div>
										`);
			}
		}

		function removerItemPedido(obj) {
			$(obj).parent().parent().parent().remove();
		}

		function configurarModalEdicao(ped_codigo) {
			var botao = $("#modal_edicao").find("#botao_editar");				
			$(botao).attr("onclick", `editarPedido('editar', ${ped_codigo})`);
			var where = {};
			where['ped_codigo'] = ped_codigo;
			// Buscando os dados do pedido no back-end
			$.post( "<?= site_url('Pedidos/obterDadosPedido'); ?>", { where: where } )
				.done(function( data ) {
					data = JSON.parse(data);
					if (data.menssagem == 'success') {	
						var pedido_edicao = data.pedido_edicao;										
						$("#edit_ped_codigo_cliente").val(pedido_edicao.ped_codigo_cliente);
						$("#edit_ped_codigo_vendedor").val(pedido_edicao.ped_codigo_vendedor);
						$("#edit_ped_data").val(pedido_edicao.ped_data);
						$("#edit_ped_observacao").val(pedido_edicao.ped_observacao);
						$("#edit_ped_forma_pagamento").val(pedido_edicao.ped_forma_pagamento);
						var itens_do_pedido = pedido_edicao.itens_do_pedido;						
						adicionarItensPedido(itens_do_pedido);						
						$("#modal_edicao").modal('show');
					} else {						
						mostrarMenssagem('erro');
					}
				});												
		}

		function adicionarItensPedido(itens_do_pedido) {
			$(".div_itens_do_pedido_edicao").remove();
			$("#produto_edicao").val('');
			var intem = "";
			$(itens_do_pedido).each( function () {
				item = this.pro_codigo + " | " + this.pro_nome + " | " + this.pro_cor + " | " + this.pro_tamanho + " | R$" + this.pro_valor;
				$("#div_produtos_edicao").append(`
											<div class="col-md-12 div_itens_do_pedido_edicao" style="margin-top: 10px;">
												<div class="input-group">
													<input readonly="true" value="${item}" class="form-control itens_do_pedido_edicao" type="text">
													<div class="input-group-btn">
														<button onclick="removerItemPedido(this)" data-toggle="tooltip" data-placement="top" title="Remover item do pedido" class="btn btn-danger" type="button">
															<i class="fas fa-trash"></i>
														</button>
													</div>
												</div>								
											</div>
										`);						
			});
		}

		function adicionarItemTabela(dados) {
			// Adiciona na tabela (front-end) o item desejado
			$("#corpo_tabela").append(`
										<tr id="tr_item_${dados.ped_codigo}">
											<td>${dados.ped_codigo}</td>
											<td>${dados.ped_codigo_cliente}</td>
											<td>${dados.ped_codigo_vendedor}</td>
											<td>${dataSQLToBR(dados.ped_data)}</td>
											<td>${dados.ped_observacao}</td>
											<td>${dados.ped_forma_pagamento}</td>
											<td class="text-center">
												<button type="button" onclick="enviarPedido('mostrar',  ${dados.ped_codigo});" data-toggle="tooltip" data-placement="top" title="Enviar por email" class="btn btn-dark"><i class="fas fa-envelope"></i></button>
												<button type="button" onclick="imprimirPedido(${dados.ped_codigo});" data-toggle="tooltip" data-placement="top" title="Imprimir" class="btn btn-dark"><i class="fas fa-print"></i></button>
												<button type="button" onclick="editarPedido('mostrar', ${dados.ped_codigo})" data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-outline-dark"><i class="fas fa-pen"></i></button>
												<button type="button" onclick="removerPedido('mostrar', ${dados.ped_codigo});" data-toggle="tooltip" data-placement="top" title="Excluir" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
											</td>
										</tr>										
									`);
			$("#alert_sem_dados").fadeOut(1);
		}

		function editarItemTabela(dados) {
			// Edita os dados que estão na tabela (front-end)			
			$(`#tr_item_${dados.ped_codigo}`).html(`
											<td>${dados.ped_codigo}</td>
											<td>${dados.ped_codigo_cliente}</td>
											<td>${dados.ped_codigo_vendedor}</td>
											<td>${dataSQLToBR(dados.ped_data)}</td>
											<td>${dados.ped_observacao}</td>
											<td>${dados.ped_forma_pagamento}</td>
											<td class="text-center">
												<button type="button" onclick="enviarPedido('mostrar',  ${dados.ped_codigo});" data-toggle="tooltip" data-placement="top" title="Enviar por email" class="btn btn-dark"><i class="fas fa-envelope"></i></button>
												<button type="button" onclick="imprimirPedido(${dados.ped_codigo});" data-toggle="tooltip" data-placement="top" title="Imprimir" class="btn btn-dark"><i class="fas fa-print"></i></button>
												<button type="button" onclick="editarPedido('mostrar', ${dados.ped_codigo})" data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-outline-dark"><i class="fas fa-pen"></i></button>
												<button type="button" onclick="removerPedido('mostrar', ${dados.ped_codigo});" data-toggle="tooltip" data-placement="top" title="Excluir" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
											</td>																		
									`);
		}

		function removerItemTabela(id) {
			// (front-end)
			$(`#tr_item_${id}`).remove();
		}

		function limparCadastro() {
			var itens_cadastro = $("#formulario_cadastro").find(".para_cadastrar");			
			$(itens_cadastro).each( function () {
				$(this).val('');
			});
			$("#produto").val('');
			$(".div_itens_do_pedido").remove();
			$("#modal_cadastro").modal('hide');
		}		
				
	</script>
	
</div>

