<?php

	include_once '../domain/Banco.class.php';
	include_once '../persistence/BancoDAO.class.php';
	
	$bd = new BancoDAO($system);
	$bc = new Banco();
	$rs = $bd->listAll();
	

?>
<div class="toolbox">	
	<form method="POST" action="?p=novo-banco">
		<input type="submit" class="button" value="Novo Banco"/>
	</form>
</div>
<div class="content">
<?php if( $rs ) { ?>
		<table cellspacing="0" >
			<tr class="header" >
				<th>#</th>
				<th class="operacao">Abertura</th>
				<th class="descricao">Descrição</th>
				<th>Agência</th>
				<th>C/C</th>
				<th>Limite</th>
				<th class="operacao">Saldo Inic.</th>
				
			</tr>
			<?php foreach($rs as $bc) { ?>
				
				<tr class="<?php echo ($i++ % 2 == 0 ? 'even' : 'odd'); ?>">
					<td class="id"><?php echo $bc->getCodigo(); ?></td>
					<td class="center"><?php echo date('d/m/Y', strtotime($bc->getAbertura())); ?></td>
					<td><?php echo $bc->getDescricao(); ?></td>
					<td class="center"><?php echo $bc->getAgencia(); ?></td>
					<td class="center"><?php echo $bc->getContacorrente(); ?></td>
					<td class="right"><?php echo $bc->getLimite(); ?></td>
					<td class="right"><?php echo $bc->getSaldoinic(); ?></td>
				</tr>
				
			<?php } ?>	
			
		</table>
		<?php } else { ?>
			<p>Nenhum Caixa / Banco foi encontrado.</p>
		<?php } ?>
</div>