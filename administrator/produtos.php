<link rel="stylesheet" type="text/css" href="../estilo/produto.css" />
<div class="produto">
<table id="list1" style="display:none"></table>

<script type="text/javascript">

	function doUnidade() {
		$('#unidade').html('');
		$('.carregando').show();
		$.getJSON('unidade.ajax.php',{pessoa: $(this).val(), ajax: 'true'}, function(j){
			var options = '<option value="">-- Selecione --</option>';	
			for (var i = 0; i < j.length; i++) {
				//if (i == 0) options += '<option value="' + j[i].id + '" selected="selected">' + j[i].descricao + '</option>';
				//else 
				options += '<option value="' + j[i].id + '">' + j[i].abreviacao + '</option>';
			}	
			$('#unidade').html(options).show();
			$('.carregando').hide();
		});
		
	}
	
	function doSubmit(action) {
	
		if(action == 'incluir') {
		
			$.post("incluir.especproduto.ajax.php", $("#formCadastroProduto").serialize()) 
			.success (function() {
				
				$('.msgbox').css('color','#060');
				$('.msgbox').fadeIn('fast');
				$('.msgbox').html("Produto inserido com sucesso!");
				$('.msgbox').fadeOut(5000);
			
				$('.incluir').css('display','none');
				$('.progress-bar').css('display','block');
				$('.flexigrid').css('display','block');
				jQuery("#list1").flexReload(); 
				$('#formCadastroProduto').get(0).reset();
				
			});
			
		}else if(action == 'alterar') {
		
			$.post("update.especproduto.ajax.php", $("#formCadastroProduto").serialize()) 
			.success (function() {
				
				/* Transforma em função */
				$('.msgbox').css('color','#060');
				$('.msgbox').fadeIn('fast');
				$('.msgbox').html("Produto alterado com sucesso!");
				$('.msgbox').fadeOut(5000);
			
				
				$('.alterar').css('display','none');
				
				$('.alterar').addClass('incluir');
				$('.alterar').removeClass('alterar');
				
				$('.progress-bar').css('display','block');
				$('.flexigrid').css('display','block');
				jQuery("#list1").flexReload(); 
				$('#formCadastroProduto').get(0).reset();
				

				
			});
		}
		
	}
	
	function cancelar(d, f) {
	
		$(d).css('display','none');
		$('.progress-bar').css('display','block');
		$('.flexigrid').css('display','block');
		$(f).get(0).reset();
		
		if(d == '.alterar') {
			$('.alterar').addClass('incluir');
			$('.alterar').removeClass('alterar');
		}
		
		$('input#cancel').removeAttr('onclick');
		$('input#cancel').remove();
		$('div#buttons').append('<input type="button" id="cancel" onclick="cancelar(\'.incluir\', \'#formCadastroProduto\')" value="Cancelar" name="submit">');
	}
	
</script>

<script type="text/javascript">
function doFlex() {

jQuery("#list1").flexigrid({
   	url:'pesquisa.especproduto.ajax.php?uuid=<?php echo $uuid; ?>',
	dataType: "json",
   	colModel:[
   		{display: 'ID', name:'esp_codigo', sortable: true, width:70, align: 'center', hide: true},
   		{display: 'Referência', name:'esp_referencia', sortable: true, width:70, align: 'center'},
   		{display: 'Cod. Barras', name:'esp_codbarras', width:150, sortable: true, align: 'left'},
   		{display: 'Descrição', name:'esp_descricao', width:630, sortable: true, align: 'left'}
   	],
	buttons:[
		{name: 'Incluir', bclass: 'add', onpress: doCommand},
		{separator: true},
		{name: 'Alterar', bclass: 'update', onpress: doCommand},
		{separator: true},
		{name: 'Deletar', bclass: 'delete', onpress: doCommand},
		{separator: true}
	],
	searchitems: [
		{display: 'Referência', name : 'esp_referencia', isdefault: true},
		{display: 'Descrição', name : 'esp_descricao'}
	],
   	sortname: "esp_descricao",
    sortorder: "ASC",
	usepager: true,
	useRp: true,
	rp: 15,
	singleSelect: true,
    title:"Produtos",
	width: 900,
	height: 'auto',
	showTableToggleBtn: true
});

}
function doCommand(com, grid) {
	if(com == 'Incluir') {
		
		doUnidade();
		$('.incluir').css('display','block');
		$('.flexigrid').css('display','none');
		$('.progress-bar').css('display','none');
		$('#legenda').html('Incluir Produto');
		$('#div-referencia').css('display','none');
		
		$('input#submit').remove();
			$('input#cancel').remove();
			
			$('div#buttons').append('<input type="button" id="submit" onclick="doSubmit(\'incluir\')" value="Confirmar" name="submit">');
			$('div#buttons').append('<input type="button" id="cancel" onclick="cancelar(\'.alterar\', \'#formCadastroProduto\')" value="Cancelar" name="submit">');
			
		
		
	} else if(com == 'Alterar') {
	
		$('.trSelected', grid).each(function() {
			var id = $(this).attr('id');
			id = id.substring(id.lastIndexOf('row')+3);
			
			doUnidade();
			$('.incluir').css('display','block');
			$('.incluir').addClass('alterar');
			$('.incluir').removeClass('incluir');
			$('.flexigrid').css('display','none');
			$('.progress-bar').css('display','none');
			$('#div-referencia').css('display','block');
			
			$('input#submit').remove();
			$('input#cancel').remove();
			
			$('div#buttons').append('<input type="button" id="submit" onclick="doSubmit(\'alterar\')" value="Confirmar" name="submit">');
			$('div#buttons').append('<input type="button" id="cancel" onclick="cancelar(\'.alterar\', \'#formCadastroProduto\')" value="Cancelar" name="submit">');
			$.post("view.especproduto.ajax.php", { produto_id: id },
			   function(data) {
			   
					$('input#codigo').val(data.id);
					$('input#referencia').val(data.referencia);
					$('input#descricao').val(data.descricao);
					$('input#cpfcnpj').val(data.codbarras);
					$('input#custo').val(data.custo);
					$('input#venda').val(data.venda);
					
					
			   }, "json");
			   
			
				
			$('#legenda').html('Alterar Produto');
			
		});
		
	} else if(com == 'Deletar') {
	
		$('.trSelected', grid).each(function() {
			var id = $(this).attr('id');
			id = id.substring(id.lastIndexOf('row')+3);
			
			if(confirm('Tem certeza que você deseja excluir o produto selecionado?')) {
			
				$.post("delete.especproduto.ajax.php", { produto_id: id });
				
				$('.msgbox').css('color','#060');
				$('.msgbox').fadeIn('fast');
				$('.msgbox').html("Produto excluído com sucesso!");
				$('.msgbox').fadeOut(5000);
				
				jQuery("#list1").flexReload(); 
				
				
			}
			
		});
		
	}
}

doFlex();

</script>
<div class="progress-bar">
	Carregando dados ... <span class="progressBar" id="pb1">0%</span>
</table>
</div>


<div class="incluir">
	<fieldset>
		<legend id="legenda">Incluir Produto</legend>
		<form id="formCadastroProduto">
			<input type="hidden" id="codigo" value="" name="codigo" />
			<fieldset>
				<legend>Dados</legend>
				<div class="label">
					<label>Un. Medida:</label>
				</div>
				<div class="field">
					<select name="unidade" id="unidade">
						<option value="0">-- Selecione --</option>
					</select>
				</div>
				
				<div id="div-referencia">
					<div class="label">
						<label>Referência</label>
					</div>
					<div class="field">
						<input type="text" value="" name="referencia" id="referencia" disabled>
					</div>
				</div>
			
				<div class="label">
					<label>Descrição:</label>
				</div>
				<div class="field">
					<input type="text" value="" name="descricao" id="descricao">
				</div>
			
				<div class="label">
					<label>Código de Barras:</label>
				</div>
				<div class="field">
					<input type="text" value="" name="codbarras" id="codbarras">
				</div>
			
				<div class="label">
					<label>Marca:</label>
				</div>
				<div class="field">
					<input type="text" value="" name="marca" id="marca">
				</div>
			
			</fieldset>
			
			<fieldset>
			
				<legend>Informações Fiscais</legend>
				
				<div class="label">
					<label>Código do NCM:</label>
				</div>
				<div class="field">
					<input type="text" value="" name="cpfcnpj" id="cpfcnpj">
				</div>
				
				<div class="label">
					<label>Descrição NCM:</label>
				</div>
				<div class="field">
					<input type="text" value="" name="ncmdesc" id="ncmdesc">
				</div>
				
			</fieldset>
			
			<fieldset>
				<legend>Tabelas de Preço</legend>
				<div class="label">
					<label>Preço de Custo:</label>
				</div>
				<div class="field">
					<input type="text" value="" name="custo" id="custo">
				</div>
				<div class="label">
					<label>Preço de Venda:</label>
				</div>
				<div class="field">
					<input type="text" value="" name="venda" id="venda">
				</div>
			</fieldset>
			
			<fieldset>
			
				<div class="label"></div>
				<div class="field" id="buttons">
					<input type="button" id="submit" onclick="doSubmit('incluir')" value="Confirmar" name="submit">
					<input type="button" id="cancel" onclick="cancelar('.incluir', '#formCadastroProduto')" value="Cancelar" name="submit">
				</div>
			</fieldset>
			
			
		</form>
	</fieldset>
	
</div>
<div class="msgbox"></div>
</div>