<link rel="stylesheet" type="text/css" href="../estilo/fornecedor.css" />
<div class="fornecedor">
<table id="list1" style="display:none"></table>

<script type="text/javascript">

	function doPessoa() {
		$('#pessoa').html('');
		$('.carregando').show();
		$.getJSON('pessoa.ajax.php',{pessoa: $(this).val(), ajax: 'true'}, function(j){
			var options = '<option value=""></option>';	
			for (var i = 0; i < j.length; i++) {
				if (i == 0) options += '<option value="' + j[i].id + '" selected="selected">' + j[i].descricao + '</option>';
				else options += '<option value="' + j[i].id + '">' + j[i].descricao + '</option>';
			}	
			$('#pessoa').html(options).show();
			$('.carregando').hide();
		});
		
	}
	
	function doEstado() {
		$('#estado').html('');
		$('.carregando').show();
		$.getJSON('estado.ajax.php',{pessoa: $(this).val(), ajax: 'true'}, function(j){
			var options = '<option value=""></option>';	
			for (var i = 0; i < j.length; i++) {
				if (i == 0) options += '<option value="' + j[i].id + '" selected="selected">' + j[i].descricao + '</option>';
				else options += '<option value="' + j[i].id + '">' + j[i].descricao + '</option>';
			}	
			$('#estado').html(options).show();
			$('.carregando').hide();
		});
		
	}
	
	function doSubmit(action) {
	
		if(action == 'incluir') {
		
			$.post("incluir.fornecedor.ajax.php", $("#formCadastroFornecedor").serialize()) 
			.success (function() {
				
				$('.msgbox').css('color','#060');
				$('.msgbox').fadeIn('fast');
				$('.msgbox').html("Fornecedor inserido com sucesso!");
				$('.msgbox').fadeOut(5000);
			
				$('.incluir').css('display','none');
				$('.progress-bar').css('display','block');
				$('.flexigrid').css('display','block');
				jQuery("#list1").flexReload(); 
				$('#formCadastroFornecedor').get(0).reset();
				
			});
			
		}else if(action == 'alterar') {
		
			$.post("update.fornecedor.ajax.php", $("#formCadastroFornecedor").serialize()) 
			.success (function() {
				
				/* Transforma em função */
				$('.msgbox').css('color','#060');
				$('.msgbox').fadeIn('fast');
				$('.msgbox').html("Fornecedor alterado com sucesso!");
				$('.msgbox').fadeOut(5000);
			
				
				$('.alterar').css('display','none');
				
				$('.alterar').addClass('incluir');
				$('.alterar').removeClass('alterar');
				
				$('.progress-bar').css('display','block');
				$('.flexigrid').css('display','block');
				jQuery("#list1").flexReload(); 
				$('#formCadastroFornecedor').get(0).reset();
				

				
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
		$('div#buttons').append('<input type="button" id="cancel" onclick="cancelar(\'.incluir\', \'#formCadastroFornecedor\')" value="Cancelar" name="submit">');
	}
	
</script>

<script type="text/javascript">
function doFlex() {

jQuery("#list1").flexigrid({
   	url:'pesquisa.fornecedor.ajax.php?uuid=<?php echo $uuid; ?>',
	dataType: "json",
   	colModel:[
   		{display: 'ID', name:'for_codigo', sortable: true, width:70, align: 'center', hide: true},
   		{display: 'Referência', name:'for_referencia', sortable: true, width:70, align: 'center'},
   		{display: 'Fornecedor', name:'for_nomerazao', width:300, sortable: true, align: 'left'},
   		{display: 'CNPJ', name:'for_cpfcnpj', width:100, sortable: true, align: 'center'},
   		{display: 'Cidade', name:'for_cidade', width:150, sortable: true, align: 'center'},
   		{display: 'UF', name:'est_abreviatura', width:50, sortable: true, align: 'center'},
   		{display: 'Telefone', name:'for_telefone', width:80, sortable: true, align: 'center'}
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
		{display: 'Referência', name : 'for_referencia', isdefault: true},
		{display: 'Fornecedor', name : 'for_nomerazao'}
	],
   	sortname: "for_nomerazao",
    sortorder: "ASC",
	usepager: true,
	useRp: true,
	rp: 15,
	singleSelect: true,
    title:"Cadastro de Fornecedores",
	width: 900,
	height: 'auto',
	showTableToggleBtn: true
});

}
function doCommand(com, grid) {
	if(com == 'Incluir') {
		
		doPessoa();
		doEstado();
		$('.incluir').css('display','block');
		$('.flexigrid').css('display','none');
		$('.progress-bar').css('display','none');
		$('#legenda').html('Incluir Fornecedor');
		$('#div-referencia').css('display','none');
		
		$('input#submit').remove();
			$('input#cancel').remove();
			
			$('div#buttons').append('<input type="button" id="submit" onclick="doSubmit(\'incluir\')" value="Confirmar" name="submit">');
			$('div#buttons').append('<input type="button" id="cancel" onclick="cancelar(\'.alterar\', \'#formCadastroFornecedor\')" value="Cancelar" name="submit">');
			
		
		
	} else if(com == 'Alterar') {
	
		$('.trSelected', grid).each(function() {
			var id = $(this).attr('id');
			id = id.substring(id.lastIndexOf('row')+3);
			
			doPessoa();
			doEstado();
			$('.incluir').css('display','block');
			$('.incluir').addClass('alterar');
			$('.incluir').removeClass('incluir');
			$('.flexigrid').css('display','none');
			$('.progress-bar').css('display','none');
			$('#div-referencia').css('display','block');
			
			$('input#submit').remove();
			$('input#cancel').remove();
			
			$('div#buttons').append('<input type="button" id="submit" onclick="doSubmit(\'alterar\')" value="Confirmar" name="submit">');
			$('div#buttons').append('<input type="button" id="cancel" onclick="cancelar(\'.alterar\', \'#formCadastroFornecedor\')" value="Cancelar" name="submit">');
			$.post("view.fornecedor.ajax.php", { fornecedor_id: id },
			   function(data) {
			   
					$('input#codigo').val(data.id);
					$('input#referencia').val(data.referencia);
					$('input#nome').val(data.nome);
					$('input#cpfcnpj').val(data.cpfcnpj);
					$('input#rginsest').val(data.rginsest);
					$('input#cep').val(data.cep);
					$('input#logradouro').val(data.logradouro);
					$('input#numero').val(data.numero);
					$('input#complemento').val(data.complemento);
					$('input#bairro').val(data.bairro);
					$('input#cidade').val(data.cidade);
					$('input#telefone').val(data.telefone);
					$('input#comercial').val(data.comercial);
					$('input#celular').val(data.celular);
					$('input#email').val(data.email);
			   }, "json");
				
			$('#legenda').html('Alterar Fornecedor');
			
		});
		
	} else if(com == 'Deletar') {
	
		$('.trSelected', grid).each(function() {
			var id = $(this).attr('id');
			id = id.substring(id.lastIndexOf('row')+3);
			
			if(confirm('Tem certeza que você deseja excluir o fornecedor selecionado?')) {
			
				$.post("delete.fornecedor.ajax.php", { fornecedor_id: id });
				
				$('.msgbox').css('color','#060');
				$('.msgbox').fadeIn('fast');
				$('.msgbox').html("Fornecedor excluído com sucesso!");
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
		<legend id="legenda">Incluir Fornecedor</legend>
		<form id="formCadastroFornecedor">
			<input type="hidden" id="codigo" value="" name="codigo" />
			<fieldset>
				<legend>Dados</legend>
			<div class="label">
				<label>Pessoa F/J:</label>
			</div>
			<div class="field">
				<select name="pessoa" id="pessoa">
					<option value="0">Escolha um tipo de pessoa</option>
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
				<label>Nome / Razão:</label>
			</div>
			<div class="field">
				<input type="text" value="" name="nome" id="nome">
			</div>
			
			<div class="label">
				<label>CNPJ:</label>
			</div>
			<div class="field">
				<input type="text" value="" name="cpfcnpj" id="cpfcnpj">
			</div>
			
			<div class="label">
				<label>Inscr. Estadual:</label>
			</div>
			<div class="field">
				<input type="text" value="" name="rginsest" id="rginsest">
			</div>
			</fieldset>
			
			<fieldset>
				<legend>Endereçamento</legend>
				
				<div class="label">
					<label>CEP:</label>
				</div>
				<div class="field">
					<input type="text" value="" name="cep" id="cep">
				</div>
				
				<div class="label">
					<label>Logradouro:</label>
				</div>
				<div class="field">
					<input type="text" value="" name="logradouro" id="logradouro">
				</div>
				
				<div class="label">
					<label>Número:</label>
				</div>
				<div class="field">
					<input type="text" value="" name="numero" id="numero">
				</div>
				
				<div class="label">
					<label>Complemento:</label>
				</div>
				<div class="field">
					<input type="text" value="" name="complemento" id="complemento">
				</div>
				
				<div class="label">
					<label>Bairro:</label>
				</div>
				<div class="field">
					<input type="text" value="" name="bairro" id="bairro">
				</div>
				
				<div class="label">
					<label>Cidade:</label>
				</div>
				<div class="field">
					<input type="text" value="" name="cidade" id="cidade">
				</div>
				
				<div class="label">
					<label>UF:</label>
				</div>
				<div class="field">
					<select name="estado" id="estado">
						<option value="0">-- UF --</option>
					</select>
				</div>
				
			</fieldset>
			
			<fieldset>
				<legend>Dados complementares</legend>
				
				<div class="label">
					<label>Telefone Residencial:</label>
				</div>
				<div class="field">
					<input type="text" value="" name="telefone" id="telefone">
				</div>
				
				<div class="label">
					<label>Telefone Comercial:</label>
				</div>
				<div class="field">
					<input type="text" value="" name="comercial" id="comercial">
				</div>
				
				<div class="label">
					<label>Telefone Celular:</label>
				</div>
				<div class="field">
					<input type="text" value="" name="celular" id="celular">
				</div>
				
				<div class="label">
					<label>E-mail:</label>
				</div>
				<div class="field">
					<input type="text" value="" name="email" id="email">
				</div>
				
			</fieldset>
			
			<fieldset>
				<div class="label"></div>
				<div class="field" id="buttons">
					<input type="button" id="submit" onclick="doSubmit('incluir')" value="Confirmar" name="submit">
					<input type="button" id="cancel" onclick="cancelar('.incluir', '#formCadastroFornecedor')" value="Cancelar" name="submit">
				</div>
			</fieldset>
			
			
		</form>
	</fieldset>
	
</div>
<div class="msgbox"></div>
</div>