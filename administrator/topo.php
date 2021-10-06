<ul class="btn-group">
	<li class="btn">
		<i class="icon">
			<img src="../images/user.png" />
		</i>
		<span class="text">
			<?php echo "Bem-vindo, " . $_SESSION['nome']; ?>
		</span>
	</li>
	<li class="btn disabled">
		<i class="icon">
			<img src="../images/time.png" />
		</i>
		<span class="text">
			<?php echo date("d/m/Y H:i:s"); ?>
		</span>
	</li>
	<li class="btn">
		<i class="icon">
			<img src="../images/settings.png"  />
		</i>
		<span class="text">
			Configurar
		</span>
	</li>
	<li class="btn">
		<a href="../session/destruir.php" data-toggle="modal" data-target="#myModal">
			<i class="icon">
				<img src="../images/shutdown.png"  />
			</i>
			<span class="text">
				Desconectar
			</span>
		</a>
	</li>
</ul>