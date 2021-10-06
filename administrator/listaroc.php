<?php

	include_once '../domain/OrdemCompra.class.php';
	include_once '../domain/Fornecedor.class.php';
	include_once '../persistence/OrdemCompraDAO.class.php';
	include_once '../persistence/FornecedorDAO.class.php';
	
	$od = new OrdemCompraDAO();
	$oc = new OrdemCompra();
	$fd = new FornecedorDAO();
	$ff = new Fornecedor();
	$rs = $od->listAll();
	$at = array( -1 => 'Cancelada', 0 => 'Não', 1 => 'Sim' );
	
	
	

?>
<div class="content">
<?php if( $rs ) { ?>
		<table cellspacing="0" >
			<tr class="header" >
				<th>Número</th>
				<th class="operacao">Data</th>
				<th class="empresa">Empresa</th>
				<th class="operacao">Autorizada</th>
				<th class="operacao">Entrega</th>
				<th class="operacao">Revisada</th>
			</tr>
			<?php foreach($rs as $oc) { ?>
				<?php $ff = $fd->findByPK($oc->getFornecedor()); ?>
				<?php $ff = $fd->findByPK($oc->getFornecedor()); ?>
				<tr class="<?php echo ($i++ % 2 == 0 ? 'even' : 'odd'); ?>">
					<td class="id"><?php echo $oc->getReferencia(); ?></td>
					<td class="center"><?php echo $oc->getDataOC(); ?></td>
					<td><?php echo $ff->getNomeRazao(); ?></td>
					<td class="center">
						<?php echo $at[$oc->getAutorizada()]; ?>
						<!--
						<a href="#"><img class="acao" src="../images/eye.png" title="visualizar"/></a>
						<a href="#"><img class="acao" src="../images/edit.png" title="editar"/></a>
						<a href="#"><img class="acao" src="../images/del.png" title="apagar"/></a>
						-->
					</td>
					<td class="center"><?php echo $oc->getEntrega(); ?></td>
					<td class="center"><?php echo $at[$oc->getRevisada()]; ?></td>
				</tr>
				
			<?php } ?>	
			
		</table>
		<?php } else { ?>
			<p>Nenhuma Ordem de Compra foi encontrada.</p>
		<?php } ?>
</div>