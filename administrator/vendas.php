<link rel="stylesheet" type="text/css" href="../estilo/vendas.css" />
<script type="text/javascript" src="../js/vendas.autocomplete.js"></script>
<script type="text/javascript" src="../js/vendas.js"></script>
<script>
	
	var itens = new Array();
	var carrinho = new Carrinho();
	
	function findItens(value) {
		for (var i = 0; i < itens.length; i++) {
			if(itens[i].produto == value) {
				return i;
			}
		}
		return -1;
	}
	
	function trocaModulo(x) {
		 $("#modulo").html(x.value == 0 ? 'Venda' : 'Troca');
	}
	
	function onSubmit(e) {
	
		if(window.event) {// IE8 and earlier
			keynum = e.keyCode;
		} else if(e.which) { // IE9/Firefox/Chrome/Opera/Safari
			keynum = e.which;
		}
		
		if(keynum == 13) {
		
			var ref = $("#produtos").val();
			
			$("#noitem").hide();
			$("select#modulo").attr('disabled','disabled');
			
			$.post("itens.ajax.php", { produto_ref: ref, metodo: "item" },
				function(data) {
				
					var total = $("#total-itens").html();
					
					$("#produtos").val('');
					
					var f = -1;
					
					f = findItens(data[0].referencia);
					
					if (f >= 0)  {
						itens[f].updateItens();
						$("#qtde_"+f).val(itens[f].itens);
					} else {
						itens[total] = new Item();
						
						itens[total].produto = data[0].referencia;
						itens[total].inicializa();
						f = total++;
						
						var preco = Math.random();
				
						$("#itens").last().append('<tr id="'+f+'">'
							+'<td><a href="#">Deletar</td>'
							+'<td>'+data[0].referencia+'</td>'
							+'<td>'+data[0].descricao+'</td>'
							+'<td><input class="preco" type="text" value="'+preco.toPrecision(2)+'" /></td>'
							+'<td><input class="qtde" id="qtde_'+f+'" type="text" value="'+(itens[f].itens+1)+'" /></td>'
							+'<td>'+(preco*(itens[f].itens+1)).toPrecision(2)+'</td>'
							+'</tr>');
					}
										
					$("#total-itens").html(total);
		
			}, "json");
		}
	}
</script>
<div class="vendas">
	<div class="topo">
		<fieldset>
		<h1 id="modulo">Venda</h1>
		<form id="trocaModulo">
			<select name="modulo" id="modulo" onChange="trocaModulo(this)">
				<option value="0">VENDA</option>
				<option value="1">TROCA</option>
			</select>
		</form>
			<input type="button" class="button suspender" value="Suspender" />
			<input type="button" class="button cancelar" value="Cancelar" />
		</fieldset>
	</div>
	
	<div class="venda-rapida">
			<input type="text" id="produtos" name="produtos" accesskey="i" onkeydown="onSubmit(event)" />
			<input type="button" class="button novo-item" value="Novo Item" />
		<table cellspacing="0" id="itens">
	<tr>
		<th></th>
		<th>Cód. Barras</th>
		<th>Descrição do Item</th>
		<th>Preço R$</th>
		<th>Qtde</th>
		<th>Total R$</th>
	</tr>
	<tr id="noitem">
		<td colspan="6">
			Nenhum item
		</td>
	</tr>
</table>



	</div>
	
	<div class="carrinho">
		<h3>Carrinho</h3>
		<h4>Itens no Carrinho: <span id="total-itens">0</span></h4>
		<h4>SubTotal: R$ 0,00</h4>
		<h4>Crédito: R$ 0,00</h4>
		<h2>Total: R$ 0,00</h2>
	</div>

	<div class="pagamento">
		<h3>Pagamento R$ 0,00</h3>
		<h4>Forma:
		<select>
			<option>ESPÉCIE</option>
			<option>CARTÃO</option>
			<option>CHEQUE</option>
		</select>
		</h4>
		<h4>Valor Pago:<input type="text" value="0,00"/></h4>
		<h4>Troco: R$ 0,00</h4>
		<h2>Total: R$ 0,00</h2>
	</div>
</div>