
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
					<th>CPF</th>
					<th>Sexo</th>
					<th>Email</th>
					<th class="text-center">Opções</th>
				</tr>
			</thead>
			<tbody id="corpo_tabela">
				<?php if (isset($clientes[0]->cli_codigo)) { ?>	
					<?php foreach ($clientes as $dado) { ?>
						<tr id="tr_item_<?= $dado->cli_codigo ?>">
							<td><?= $dado->cli_codigo ?></td>
							<td><?= $dado->cli_nome ?></td>
							<td><?= $dado->cli_cpf ?></td>
							<td><?= $dado->cli_sexo ?></td>
							<td><?= $dado->cli_email ?></td>							
							<td class="text-center">																						
								<button type="button" onclick="editarCliente('mostrar',  <?= $dado->cli_codigo ?>);" data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-outline-dark"><i class="fas fa-pen"></i></button>
								<button type="button" onclick="removerCliente('mostrar', <?= $dado->cli_codigo ?>);" data-toggle="tooltip" data-placement="top" title="Excluir" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
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
					<h5 class="modal-title" id="modal_cadastro_title">Cadastro de cliente</h5>
					<button onclick="limparCadastro();" type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="formulario_cadastro">
						<div class="form-group">
							<label for="cli_nome">Nome</label>
							<input type="text" class="form-control para_cadastrar" id="cli_nome" name="cli_nome" placeholder="Informe o seu nome">							
						</div>
						<div class="form-group">
							<label for="cli_cpf">CPF</label>
							<input type="text" class="form-control para_cadastrar" id="cli_cpf" name="cli_cpf" placeholder="Informe o seu CPF">							
						</div>
						<div class="form-group">
							<label for="cli_sexo">Sexo</label>
							<select class="form-control para_cadastrar" id="cli_sexo" name="cli_sexo">
								<option value=""></option>
								<option value="Masculino">Masculino</option>
								<option value="Feminino">Feminino</option>															
							</select>
						</div>
						<div class="form-group">
							<label for="cli_email">Email</label>
							<input type="email" class="form-control para_cadastrar" id="cli_email" name="cli_email" placeholder="Informe o seu email">							
						</div>												
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" onclick="limparCadastro();" class="btn btn-outline-secondary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Fechar</button>
					<button type="button" onclick="cadastrarCliente();" class="btn btn-dark"><i class="fas fa-save"></i> Salvar</button>
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
					<h5 class="modal-title" id="modal_edicao_title">Edição de cliente</h5>
					<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="formulario_edicao">
						<div class="form-group">
							<label for="edit_cli_nome">Nome</label>
							<input type="text" class="form-control para_editar" id="edit_cli_nome" name="cli_nome" placeholder="Informe o seu nome">							
						</div>
						<div class="form-group">
							<label for="edit_cli_cpf">CPF</label>
							<input type="text" class="form-control para_editar" id="edit_cli_cpf" name="cli_cpf" placeholder="Informe o seu CPF">							
						</div>
						<div class="form-group">
							<label for="edit_cli_sexo">Sexo</label>
							<select class="form-control para_editar" id="edit_cli_sexo" name="cli_sexo">
								<option value=""></option>
								<option value="Masculino">Masculino</option>
								<option value="Feminino">Feminino</option>															
							</select>
						</div>
						<div class="form-group">
							<label for="edit_cli_email">Email</label>
							<input type="email" class="form-control para_editar" id="edit_cli_email" name="cli_email" placeholder="Informe o seu email">							
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
					<h5 class="modal-title" id="modal_exclusao_title">Deseja realmente excuir o cliente?</h5>
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

		function cadastrarCliente() {
			var itens_cadastro = $("#formulario_cadastro").find(".para_cadastrar");
			var dados_post = {};

			// Preparando os dados para enviar para o beck-end
			$(itens_cadastro).each( function () {
				dados_post[$(this).attr('name')] = $(this).val();
			});			

			// Enviando dados para o beck-end
			$.post( "<?= site_url('Clientes/cadastrar'); ?>", { dados_post: dados_post } )
			.done(function( data ) {
				data = JSON.parse(data);
				if (data.menssagem == 'success') {					
					limparCadastro();
					$("#modal_cadastro").modal('hide');
					dados_post['cli_codigo'] = data.id;
					adicionarItemTabela(dados_post);
					mostrarMenssagem('cadastrado');					
				} else {
					mostrarMenssagem('erro');
				}
			});
		}		

		function editarCliente(opc, cli_codigo) {			

			var dados = {};
			var itens_cliente = $(`#tr_item_${cli_codigo}`).find("td");									
			dados['cli_codigo'] = $(itens_cliente[0]).text();
			dados['cli_nome'] = $(itens_cliente[1]).text();
			dados['cli_cpf'] = $(itens_cliente[2]).text();
			dados['cli_sexo'] = $(itens_cliente[3]).text();
			dados['cli_email'] = $(itens_cliente[4]).text();						
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
				dados_post['cli_codigo'] = dados.cli_codigo;				

				$.post( "<?= site_url('Clientes/editar'); ?>", { dados_post: dados_post } )
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

		function removerCliente(opc, id) {			
			// Mostra o modal de remoção e seta o codigo que deve ser removido
			if (opc == 'mostrar') {
				$("#modal_exclusao").modal('show');
				var botao = $("#modal_exclusao").find("#botao_remover");
				$(botao).val(id);
				$(botao).attr("onclick", `removerCliente('remover', ${id})`);
			}		

			// Remove o item efetivamente, tanto do banco de dados, como da tabela no front-end
			if (opc == 'remover') {
				var dados_post = {};
				
				// Obtendo o codigo do item que deve ser removido
				dados_post['cli_codigo'] = id;

				// Enviando a requisição de remoção + dado que deve ser removido para o beck-end
				$.post( "<?= site_url('Clientes/remover'); ?>", { dados_post: dados_post } )
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
			$(botao).attr("onclick", `editarCliente('editar', ${dados.cli_codigo})`);
			$("#edit_cli_nome").val(dados.cli_nome);
			$("#edit_cli_cpf").val(dados.cli_cpf);
			$("#edit_cli_sexo").val(dados.cli_sexo);
			$("#edit_cli_email").val(dados.cli_email);
			$("#modal_edicao").modal('show');
		}

		function adicionarItemTabela(dados) {
			// Adiciona na tabela (front-end) o item desejado
			$("#corpo_tabela").append(`
										<tr id="tr_item_${dados.cli_codigo}">
											<td>${dados.cli_codigo}</td>
											<td>${dados.cli_nome}</td>
											<td>${dados.cli_cpf}</td>
											<td>${dados.cli_sexo}</td>
											<td>${dados.cli_email}</td>
											<td class="text-center">
												<button type="button" onclick="editarCliente('mostrar', ${dados.cli_codigo})" data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-outline-dark"><i class="fas fa-pen"></i></button>
												<button type="button" onclick="removerCliente('mostrar', ${dados.cli_codigo});" data-toggle="tooltip" data-placement="top" title="Excluir" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
											</td>
										</tr>										
									`);
			$("#alert_sem_dados").fadeOut(1);
		}

		function editarItemTabela(dados) {
			// Edita os dados que estão na tabela (front-end)			
			$(`#tr_item_${dados.cli_codigo}`).html(`
											<td>${dados.cli_codigo}</td>										
											<td>${dados.cli_nome}</td>
											<td>${dados.cli_cpf}</td>
											<td>${dados.cli_sexo}</td>
											<td>${dados.cli_email}</td>
											<td class="text-center">
												<button type="button" onclick="editarCliente('mostrar', ${dados.cli_codigo})" data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-outline-dark"><i class="fas fa-pen"></i></button>
												<button type="button" onclick="removerCliente('mostrar', ${dados.cli_codigo});" data-toggle="tooltip" data-placement="top" title="Excluir" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
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

