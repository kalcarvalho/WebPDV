<?php

    include_once '../domain/Modulo.class.php';
    include_once '../persistence/ModuloDAO.class.php';

    $m = new Modulo();
    $md = new ModuloDAO($system);
	$titulo = '';
    $rs = $md->listAllActive();
?>
<ul class="nav nav-list">
	<li class="active">
		<a href="?">
			<img src="../images/control-panel-icon.png" title="Painel de Controle" />
		<span>Painel de Controle</span>
		</a>
	</li>
	<?php if($rs) { ?>
		<?php foreach($rs as $m) { ?>
			<li class="nav-header">
				<a href="?p=<?php echo $m->getReferencia(); ?>">
					<img src="../images/<?php echo $m->getReferencia(); ?>-menu.png" title="<?php echo $m->getRotulo(); ?>"/>
					<span><?php echo $m->getRotulo(); ?></span>
				</a>
			</li>
		<?php } ?>
	<?php } ?>
	<li class="nav-header">
		<a href="../session/destruir.php">
			<img src="../images/sair.png" title="Desconectar" />
			<span>Desconectar</span>
		</a>
	</li>
</ul>

<?php

$m = $md->findByReferencia(str_replace(".php", "", $p));
if(!$m) {
	$titulo = 'Painel de Controle';
} else {
	$titulo = $m->getDescricao();
}
?>