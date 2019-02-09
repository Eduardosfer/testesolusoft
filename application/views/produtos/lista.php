
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
					<th>Nome</th>
					<th>Cor</th>
					<th>Tamanho</th>
					<th>Valor</th>
					<th class="text-center">Opções</th>
				</tr>
			</thead>
			<tbody id="corpo_tabela">
				<?php if (isset($produtos[0]->pro_codigo)) { ?>	
					<?php foreach ($produtos as $dado) { ?>
						<tr id="tr_item_<?= $dado->pro_codigo ?>">
							<td><?= $dado->pro_codigo ?></td>
							<td><?= $dado->pro_nome ?></td>
							<td><?= $dado->pro_cor ?></td>
							<td><?= $dado->pro_tamanho ?></td>
							<td><?= $dado->pro_valor ?></td>							
							<td class="text-center">																						
								<button type="button" onclick="editarProduto('mostrar',  <?= $dado->pro_codigo ?>);" data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-outline-dark"><i class="fas fa-pen"></i></button>
								<button type="button" onclick="removerProduto('mostrar', <?= $dado->pro_codigo ?>);" data-toggle="tooltip" data-placement="top" title="Excluir" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
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
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header bg-dark text-white">
					<h5 class="modal-title" id="modal_cadastro_title">Cadastro de produto</h5>
					<button onclick="limparCadastro();" type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="formulario_cadastro">
						<div class="form-group">
							<label for="pro_nome">Nome</label>
							<input type="text" class="form-control para_cadastrar" id="pro_nome" name="pro_nome" placeholder="Informe o nome do produto">							
						</div>
						<div class="form-group">
							<label for="pro_cor">Cor</label>
							<input type="text" class="form-control para_cadastrar" id="pro_cor" name="pro_cor" placeholder="Informe a cor do produto">							
						</div>
						<div class="form-group">
							<label for="pro_tamanho">Tamanho</label>
							<select class="form-control para_cadastrar" id="pro_tamanho" name="pro_tamanho">
								<option value=""></option>
								<option value="Pequeno">Pequeno</option>
								<option value="Médio">Médio</option>															
								<option value="Grande">Grande</option>															
							</select>
						</div>
						<div class="form-group">
							<label for="pro_valor">Valor</label>
							<input type="number" step="0.01" class="form-control para_cadastrar" id="pro_valor" name="pro_valor" placeholder="Valor do produto em R$">							
						</div>												
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" onclick="limparCadastro();" class="btn btn-outline-secondary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Fechar</button>
					<button type="button" onclick="cadastrarProduto();" class="btn btn-dark"><i class="fas fa-save"></i> Salvar</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Fim do modal de cadastro -->	

	<!-- Modal de edição -->
	<div class="modal fade" id="modal_edicao" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modal_edicao" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header bg-dark text-white">
					<h5 class="modal-title" id="modal_edicao_title">Edição de produto</h5>
					<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="formulario_edicao">
						<div class="form-group">
							<label for="edit_pro_nome">Nome</label>
							<input type="text" class="form-control para_editar" id="edit_pro_nome" name="pro_nome" placeholder="Informe o nome do produto">							
						</div>
						<div class="form-group">
							<label for="edit_pro_cor">Cor</label>
							<input type="text" class="form-control para_editar" id="edit_pro_cor" name="pro_cor" placeholder="Informe a cor do produto">							
						</div>
						<div class="form-group">
							<label for="edit_pro_tamanho">Tamanho</label>
							<select class="form-control para_editar" id="edit_pro_tamanho" name="pro_tamanho">
								<option value=""></option>
								<option value="Pequeno">Pequeno</option>
								<option value="Médio">Médio</option>															
								<option value="Grande">Grande</option>														
							</select>
						</div>
						<div class="form-group">
							<label for="edit_pro_valor">Valor</label>
							<input type="number" step="0.01" class="form-control para_editar" id="edit_pro_valor" name="pro_valor" placeholder="Informe o valor do produto em R$">							
						</div>												
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Fechar</button>
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
					<h5 class="modal-title" id="modal_exclusao_title">Deseja realmente excuir o produto?</h5>
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

	<!-- Fim de modais -->

	<script>		

		function cadastrarProduto() {
			var itens_cadastro = $("#formulario_cadastro").find(".para_cadastrar");
			var dados_post = {};

			// Preparando os dados para enviar para o beck-end
			$(itens_cadastro).each( function () {
				dados_post[$(this).attr('name')] = $(this).val();
			});			

			// Enviando dados para o beck-end
			$.post( "<?= site_url('Produtos/cadastrar'); ?>", { dados_post: dados_post } )
			.done(function( data ) {
				data = JSON.parse(data);
				if (data.menssagem == 'success') {					
					limparCadastro();
					$("#modal_cadastro").modal('hide');
					dados_post['pro_codigo'] = data.id;
					adicionarItemTabela(dados_post);
					mostrarMenssagem('cadastrado');					
				} else {
					mostrarMenssagem('erro');
				}
			});
		}		

		function editarProduto(opc, pro_codigo) {			

			var dados = {};
			var itens_produto = $(`#tr_item_${pro_codigo}`).find("td");									
			dados['pro_codigo'] = $(itens_produto[0]).text();
			dados['pro_nome'] = $(itens_produto[1]).text();
			dados['pro_cor'] = $(itens_produto[2]).text();
			dados['pro_tamanho'] = $(itens_produto[3]).text();
			dados['pro_valor'] = $(itens_produto[4]).text();						
			// var dados, refere-se aos dados que estão na instancia, que são mostrados ao usuário
							
			// Mostra os modal de edição com os dados preenchidos
			if (opc == 'mostrar') {
				configurarModalEdicao(dados);							
			}		
			
			// Faz a auteração dos dados no beck-end e na tabela (front-end)				
			if (opc == 'editar') {			
				
				// Obtendo os dados editados
				var itens_edicao = $("#formulario_edicao").find(".para_editar");
				// Preparando os dados para enviar para o beck-end
				var dados_post = {};
				$(itens_edicao).each( function () {
					dados_post[$(this).attr('name')] = $(this).val();
				});
				// var dados_post, refere-se aos dados que foram editados pelo usuário				
				dados_post['pro_codigo'] = dados.pro_codigo;				

				$.post( "<?= site_url('Produtos/editar'); ?>", { dados_post: dados_post } )
				.done(function( data ) {
					data = JSON.parse(data);
					if (data.menssagem == 'success') {											
						$("#modal_edicao").modal('hide');						
						editarItemTabela(dados_post);
						mostrarMenssagem('editado');					
					} else {
						mostrarMenssagem('erro');
					}
				});				
			}				
		}

		function removerProduto(opc, id) {			
			// Mostra o modal de remoção e seta o codigo que deve ser removido
			if (opc == 'mostrar') {
				$("#modal_exclusao").modal('show');
				var botao = $("#modal_exclusao").find("#botao_remover");
				$(botao).val(id);
				$(botao).attr("onclick", `removerProduto('remover', ${id})`);
			}		

			// Remove o item efetivamente, tanto do banco de dados, como da tabela no front-end
			if (opc == 'remover') {
				var dados_post = {};
				
				// Obtendo o codigo do item que deve ser removido
				dados_post['pro_codigo'] = id;

				// Enviando a requisição de remoção + dado que deve ser removido para o beck-end
				$.post( "<?= site_url('Produtos/remover'); ?>", { dados_post: dados_post } )
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

		function configurarModalEdicao(dados) {
			var botao = $("#modal_edicao").find("#botao_editar");				
			$(botao).attr("onclick", `editarProduto('editar', ${dados.pro_codigo})`);
			$("#edit_pro_nome").val(dados.pro_nome);
			$("#edit_pro_cor").val(dados.pro_cor);
			$("#edit_pro_tamanho").val(dados.pro_tamanho);
			$("#edit_pro_valor").val(dados.pro_valor);
			$("#modal_edicao").modal('show');
		}

		function adicionarItemTabela(dados) {
			// Adiciona na tabela (front-end) o item desejado
			$("#corpo_tabela").append(`
										<tr id="tr_item_${dados.pro_codigo}">
											<td>${dados.pro_codigo}</td>
											<td>${dados.pro_nome}</td>
											<td>${dados.pro_cor}</td>
											<td>${dados.pro_tamanho}</td>
											<td>${dados.pro_valor}</td>
											<td class="text-center">
												<button type="button" onclick="editarProduto('mostrar', ${dados.pro_codigo})" data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-outline-dark"><i class="fas fa-pen"></i></button>
												<button type="button" onclick="removerProduto('mostrar', ${dados.pro_codigo});" data-toggle="tooltip" data-placement="top" title="Excluir" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
											</td>
										</tr>										
									`);
			$("#alert_sem_dados").fadeOut(1);
		}

		function editarItemTabela(dados) {
			// Edita os dados que estão na tabela (front-end)			
			$(`#tr_item_${dados.pro_codigo}`).html(`
											<td>${dados.pro_codigo}</td>										
											<td>${dados.pro_nome}</td>
											<td>${dados.pro_cor}</td>
											<td>${dados.pro_tamanho}</td>
											<td>${dados.pro_valor}</td>
											<td class="text-center">
												<button type="button" onclick="editarProduto('mostrar', ${dados.pro_codigo})" data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-outline-dark"><i class="fas fa-pen"></i></button>
												<button type="button" onclick="removerProduto('mostrar', ${dados.pro_codigo});" data-toggle="tooltip" data-placement="top" title="Excluir" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
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
			$("#modal_cadastro").modal('hide');
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
			if (opc == 'erro') {
				$("#menssagem_alert").text('Erro ao salvar dados!');
				$("#menssagem_alert").removeClass('alert-dark');
				$("#menssagem_alert").addClass('alert-danger');
				$("#menssagem_alert").fadeIn(100);
				$("#menssagem_alert").fadeOut(3000);
			}
		}

	</script>
	
</div>

