
<div id="conteudo" style="padding: 20px;">
	
	<div class="row">
		<h2><?= $page_title ?></h2>
	</div>

	<div class="row">
		<button type="button" id="cadastrar_novo" class="btn btn-outline-dark" data-toggle="modal" data-target="#modal_cadastro">
			<i class="fas fa-plus-circle"></i> Cadastrar novo
		</button>
	</div>

	<hr>

	<div class="row">				
		
		<table class="table table-striped">
			<thead class="thead-dark">
				<tr>
					<th>Nome</th>
					<th>CPF</th>
					<th>Sexo</th>
					<th>Email</th>
					<th class="text-center">Opções</th>
				</tr>
			</thead>
			<tbody id="corpo_tabela">
				<tr id="tr_item_1">
					<td data-name="cli_nome">John</td>
					<td data-name="cli_cpf">Doe</td>
					<td data-name="cli_sexo">Masculino</td>
					<td data-name="cli_email">john@example.com</td>
					<td class="text-center">
						<button type="button" onclick="editarCliente('mostrar', 'dados')" data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-outline-dark"><i class="fas fa-pen"></i></button>
						<button type="button" onclick="removerCliente('mostrar', 1);" data-toggle="tooltip" data-placement="top" title="Excluir" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
					</td>
				</tr>							
			</tbody>
		</table>					

	</div>

	<div class="row text-center">
		<div id="menssagem_alert" style="display: none;" class="alert alert-dark text-center" role="alert"></div>
	</div>

	<!-- Modais -->

	<!-- Modal de cadastro -->
	<div class="modal fade" id="modal_cadastro" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modal_cadastro" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header bg-dark text-white">
					<h5 class="modal-title" id="modal_cadastro_title">Cadastro de cliente</h5>
					<button onClick="limparCadastro();" type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
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
								<option value="masculino">Masculino</option>
								<option value="feminino">Feminino</option>															
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
							<label for="cli_nome">Nome</label>
							<input type="text" class="form-control para_editar" id="cli_nome" name="cli_nome" placeholder="Informe o seu nome">							
						</div>
						<div class="form-group">
							<label for="cli_cpf">CPF</label>
							<input type="text" class="form-control para_editar" id="cli_cpf" name="cli_cpf" placeholder="Informe o seu CPF">							
						</div>
						<div class="form-group">
							<label for="cli_sexo">Sexo</label>
							<select class="form-control para_editar" id="cli_sexo" name="cli_sexo">
								<option value=""></option>
								<option value="masculino">Masculino</option>
								<option value="feminino">Feminino</option>															
							</select>
						</div>
						<div class="form-group">
							<label for="cli_email">Email</label>
							<input type="email" class="form-control para_editar" id="cli_email" name="cli_email" placeholder="Informe o seu email">							
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
			var intens_cadastro = $("#formulario_cadastro").find(".para_cadastrar");
			var dados_post = {};
			$(intens_cadastro).each( function () {
				dados_post[$(this).attr('name')] = $(this).val();
			});			

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
					//mostrar menssagem de erro
					mostrarMenssagem('erro');
				}
			});
		}

		function adicionarItemTabela(dados) {
			$("#corpo_tabela").append(`
										<tr id="tr_item_${dados.cli_codigo}">
											<td>${dados.cli_nome}</td>
											<td>${dados.cli_cpf}</td>
											<td>${dados.cli_sexo}</td>
											<td>${dados.cli_email}</td>
											<td class="text-center">
												<button type="button" onclick="editarCliente('mostrar', ${dados})" data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-outline-dark"><i class="fas fa-pen"></i></button>
												<button type="button" onclick="removerCliente('mostrar', ${dados.cli_codigo});" data-toggle="tooltip" data-placement="top" title="Excluir" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
											</td>
										</tr>										
									`);
		}

		function editarItemTabela() {
			//
		}

		function removerItemTabela(id) {		
			$(`#tr_item_${id}`).remove();
		}

		function limparCadastro() {
			var intens_cadastro = $("#formulario_cadastro").find(".para_cadastrar");			
			$(intens_cadastro).each( function () {
				$(this).val('');
			});
			$("#modal_cadastro").modal('hide');
		}

		function removerCliente(opc, id) {			
			if (opc == 'mostrar') {
				$("#modal_exclusao").modal('show');
				var botao = $("#modal_exclusao").find("#botao_remover");
				$(botao).val(id);
				$(botao).attr("onClick", `removerCliente('remover', ${id})`);
			}		

			if (opc == 'remover') {
				// Remover o item
				removerItemTabela(id);
				$("#modal_exclusao").modal('hide');
				mostrarMenssagem('removido');
			}	
			
		}

		function editarCliente(opc, dados) {
			if (opc == 'mostrar') {
				$("#modal_edicao").modal('show');
				var botao = $("#modal_edicao").find("#botao_editar");				
				$(botao).attr("onClick", `editarCliente('editar', ${dados})`);
			}		

			if (opc == 'editar') {
				// Remover o item
				editarItemTabela();
				mostrarMenssagem('editado');
			}				
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

