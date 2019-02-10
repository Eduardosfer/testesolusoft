<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<html>
<head>
	<style>
		table {
			padding: 10px;
			font-size: 15px;
		}
		td {
			padding: 10px;
		}														
	</style>
</head>
<body>
	<h3>Dados do pedido <?= $pedido->ped_codigo ?></h3>
	<table>
		<tbody>
			<tr>
				<td>Cliente: <?= $pedido->cli_nome ?></td>
				<td>Vendedor: <?= $pedido->ven_nome ?></td>
			</tr>
			<tr>
				<td>Forma de pagamento: <?= $pedido->ped_forma_pagamento ?></td>
				<td>Data do pedido: <?= date('d/m/Y', strtotime($pedido->ped_data)) ?></td>
			</tr>
			<tr>
				<td>Observação: <?= $pedido->ped_observacao ?></td>			
			</tr>
		</tbody>
	</table>
	<h3>Itens do pedido</h3>
	<table>
		<thead>
			<tr>
				<th>Código</th>
				<th>Nóme</th>
				<th>Cor</th>
				<th>Tamanho</th>
				<th>Valor</th>
			</tr>
		</thead>
		<tbody>
			<?php 				
				$valor_total = 0;
				foreach ($pedido->itens_do_pedido as $item) { 					
					$valor_total += $item->pro_valor; 
				?>
				<tr>
					<td><?= $item->pro_codigo ?></td>
					<td><?= $item->pro_nome ?></td>
					<td><?= $item->pro_cor ?></td>
					<td><?= $item->pro_tamanho ?></td>
					<td><?= "R$ " . $item->pro_valor ?></td>
				</tr>
			<?php } ?>
				<tr>
					<td>Total</td>
					<td></td>
					<td></td>
					<td></td>
					<td><?= "R$ " . $valor_total ?></td>
				</tr>
		</tbody>
	</table>
</body>
</html>	