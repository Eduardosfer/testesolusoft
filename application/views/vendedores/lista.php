<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

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
					<th>Nascimento</th>
					<th>Comissão (%)</th>					
					<th class="text-center">Opções</th>
				</tr>
			</thead>
			<tbody id="corpo_tabela">
				<?php if (isset($vendedores[0]->ven_codigo)) { ?>	
					<?php foreach ($vendedores as $dado) { ?>
						<tr id="tr_item_<?= $dado->ven_codigo ?>">
							<td><?= $dado->ven_codigo ?></td>
							<td><?= $dado->ven_nome ?></td>
							<td><?= date('d/m/Y', strtotime($dado->ven_nascimento)) ?></td>
							<td><?= $dado->ven_comissao ?></td>							
							<td class="text-center">																						
								<button type="button" onclick="editarVendedores('mostrar',  <?= $dado->ven_codigo ?>);" data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-outline-dark"><i class="fas fa-pen"></i></button>
								<button type="button" onclick="removerVendedores('mostrar', <?= $dado->ven_codigo ?>);" data-toggle="tooltip" data-placement="top" title="Excluir" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
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
					<h5 class="modal-title" id="modal_cadastro_title">Cadastro de vendedor</h5>
					<button onclick="limparCadastro();" type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="formulario_cadastro">
						<div class="form-group">
							<label for="ven_nome">Nome</label>
							<input type="text" class="form-control para_cadastrar" id="ven_nome" name="ven_nome" placeholder="Informe o nome do vendedor">							
						</div>
						<div class="form-group">
							<label for="ven_nascimento">Nascimento</label>
							<input type="date" class="form-control para_cadastrar" id="ven_nascimento" name="ven_nascimento" placeholder="Informe o Nascimento do vendedor">							
						</div>
						<div class="form-group">
							<label for="ven_comissao">Comissão (%)</label>
							<input type="number" step=".01" class="form-control para_cadastrar" id="ven_comissao" name="ven_comissao" placeholder="Informe a % de comissão do vendedor">							
						</div>																		
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" onclick="limparCadastro();" class="btn btn-outline-secondary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Fechar</button>
					<button type="button" onclick="cadastrarVendedores();" class="btn btn-dark"><i class="fas fa-save"></i> Salvar</button>
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
					<h5 class="modal-title" id="modal_edicao_title">Edição de vendedor</h5>
					<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="formulario_edicao">
						<div class="form-group">
							<label for="edit_ven_nome">Nome</label>
							<input type="text" class="form-control para_editar" id="edit_ven_nome" name="ven_nome" placeholder="Informe o nome do vendedor">							
						</div>
						<div class="form-group">
							<label for="edit_ven_nascimento">Nascimento</label>
							<input type="date" class="form-control para_editar" id="edit_ven_nascimento" name="ven_nascimento" placeholder="Informe o Nascimento do vendedor">							
						</div>
						<div class="form-group">
							<label for="edit_ven_comissao">Comissão (%)</label>
							<input type="number" step=".01" class="form-control para_editar" id="edit_ven_comissao" name="ven_comissao" placeholder="Informe a % de comissão do vendedor">							
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
					<h5 class="modal-title" id="modal_exclusao_title">Deseja realmente excuir o vendedor?</h5>
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

		function cadastrarVendedores() {
			var itens_cadastro = $("#formulario_cadastro").find(".para_cadastrar");
			var dados_post = {};

			// Preparando os dados para enviar para o beck-end
			$(itens_cadastro).each( function () {
				dados_post[$(this).attr('name')] = $(this).val();
			});			

			// Enviando dados para o beck-end
			$.post( "<?= site_url('Vendedores/cadastrar'); ?>", { dados_post: dados_post } )
			.done(function( data ) {
				data = JSON.parse(data);
				if (data.menssagem == 'success') {					
					limparCadastro();
					$("#modal_cadastro").modal('hide');
					dados_post['ven_codigo'] = data.id;
					adicionarItemTabela(dados_post);
					mostrarMenssagem('cadastrado');					
				} else {
					mostrarMenssagem('erro');
				}
			});
		}		

		function editarVendedores(opc, ven_codigo) {			

			var dados = {};
			var itens_vendedor = $(`#tr_item_${ven_codigo}`).find("td");									
			dados['ven_codigo'] = $(itens_vendedor[0]).text();
			dados['ven_nome'] = $(itens_vendedor[1]).text();
			dados['ven_nascimento'] = $(itens_vendedor[2]).text();
			dados['ven_comissao'] = $(itens_vendedor[3]).text();										
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
				dados_post['ven_codigo'] = dados.ven_codigo;				

				$.post( "<?= site_url('Vendedores/editar'); ?>", { dados_post: dados_post } )
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

		function removerVendedores(opc, id) {			
			// Mostra o modal de remoção e seta o codigo que deve ser removido
			if (opc == 'mostrar') {
				$("#modal_exclusao").modal('show');
				var botao = $("#modal_exclusao").find("#botao_remover");
				$(botao).val(id);
				$(botao).attr("onclick", `removerVendedores('remover', ${id})`);
			}		

			// Remove o item efetivamente, tanto do banco de dados, como da tabela no front-end
			if (opc == 'remover') {
				var dados_post = {};
				
				// Obtendo o codigo do item que deve ser removido
				dados_post['ven_codigo'] = id;

				// Enviando a requisição de remoção + dado que deve ser removido para o beck-end
				$.post( "<?= site_url('Vendedores/remover'); ?>", { dados_post: dados_post } )
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
			$(botao).attr("onclick", `editarVendedores('editar', ${dados.ven_codigo})`);
			$("#edit_ven_nome").val(dados.ven_nome);
			$("#edit_ven_nascimento").val(dataBRToSQL(dados.ven_nascimento));
			$("#edit_ven_comissao").val(dados.ven_comissao);			
			$("#modal_edicao").modal('show');
		}

		function adicionarItemTabela(dados) {						
			// Adiciona na tabela (front-end) o item desejado
			$("#corpo_tabela").append(`
										<tr id="tr_item_${dados.ven_codigo}">
											<td>${dados.ven_codigo}</td>
											<td>${dados.ven_nome}</td>
											<td>${dataSQLToBR(dados.ven_nascimento)}</td>
											<td>${dados.ven_comissao}</td>											
											<td class="text-center">
												<button type="button" onclick="editarVendedores('mostrar', ${dados.ven_codigo})" data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-outline-dark"><i class="fas fa-pen"></i></button>
												<button type="button" onclick="removerVendedores('mostrar', ${dados.ven_codigo});" data-toggle="tooltip" data-placement="top" title="Excluir" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
											</td>
										</tr>										
									`);
			$("#alert_sem_dados").fadeOut(1);
		}

		function editarItemTabela(dados) {
			// Edita os dados que estão na tabela (front-end)			
			$(`#tr_item_${dados.ven_codigo}`).html(`										
											<td>${dados.ven_codigo}</td>
											<td>${dados.ven_nome}</td>
											<td>${dataSQLToBR(dados.ven_nascimento)}</td>
											<td>${dados.ven_comissao}</td>
											<td class="text-center">
												<button type="button" onclick="editarVendedores('mostrar', ${dados.ven_codigo})" data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-outline-dark"><i class="fas fa-pen"></i></button>
												<button type="button" onclick="removerVendedores('mostrar', ${dados.ven_codigo});" data-toggle="tooltip" data-placement="top" title="Excluir" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
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

	</script>
	
</div>

