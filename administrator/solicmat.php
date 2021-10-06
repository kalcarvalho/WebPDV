<table id="list1" style="display:none"></table>

<script type="text/javascript">

	function doPost() {
	
		$.post("modify.itemsm.ajax.php", $("#modifyQtde").serialize()) 
		.success (function() {
			
			$('.changeqtde').css('display','none');
		});
	}
	
	function doLocalizacao() {
		$('#modify-erro').remove();
		$('#localizacao').hide();
		$('.carregando').show();
		$.getJSON('localizacao.ajax.php',{localizacao: $(this).val(), ajax: 'true'}, function(j){
			var options = '<option value=""></option>';	
			for (var i = 0; i < j.length; i++) {
				if (i == 0) options += '<option value="' + j[i].id + '" selected="selected">' + j[i].descricao + '</option>';
				else options += '<option value="' + j[i].id + '">' + j[i].descricao + '</option>';
			}	
			$('#localizacao').html(options).show();
			$('.carregando').hide();
		});
		
	}
	
	function submitLocalizacao() {
	
		term = $("#modifyLocalizacao").find('select[name="localizacao"]').val(); 
		
		$('#modify-erro').remove();
		
		if(term.length == 0 ) {
			$('.modify').append('<p><span class="error-message" id="modify-erro" >Você deve selecionar uma Localização</span></p>');
			return;
		}
		
		
	
		$.post("modify.localizacao.ajax.php", $("#modifyLocalizacao").serialize()) 
		.success (function() {
			jQuery("#list1").flexReload(); 
			$('.modify').css('display','none');
		});
		
	}
	
	
</script>
<script type="text/javascript">
function doFlex() {

jQuery("#list1").flexigrid({
   	url:'pesquisa.solicmat.ajax.php?uuid=<?php echo $uuid; ?>',
	dataType: "json",
   	colModel:[
   		{display: 'ID', name:'sma_codigo', sortable: true, width:70, align: 'center', hide: true},
   		{display: 'Numero', name:'sma_referencia', sortable: true, width:70, align: 'center'},
   		{display: 'Data', name:'sma_data', width:80, sortable: true, align: 'center'},
   		{display: 'Contrato', name:'ctr_descricao', width:100, sortable: true, align: 'center'},
   		{display: 'Local', name:'loc_descricao', width:100, sortable: true, align: 'center'},
   		{display: 'Solicitante', name:'usu_nome', width:120, sortable: true, align: 'center'},
   		{display: 'Autorizado', name:'sma_autorizado', width:80, sortable: true, align: 'center'},
   		{display: 'Atendido em', name:'sma_dataatend', width:80, sortable: true, align: 'center'},
   		{display: 'Autorizado por', name:'sma_autorizadopor', width:120, sortable: false, align: 'left'}
   	],
	buttons:[
		{name: 'Mudar Localização', bclass: 'add', onpress: doCommand},
		{separator: true},
		{name: 'Alterar Qtde', bclass: 'add', onpress: doCommand},
		{separator: true},
		{name: 'Revogar Atendimento', bclass: 'add', onpress: doCommand},
		{separator: true},
		{name: 'Revogar Autorização', bclass: 'add', onpress: doCommand},
		{separator: true}
	],
	searchitems: [
		{display: 'Numero', name : 'sma_referencia', isdefault: true},
		{display: 'Autorizante', name : 'sma_autorizadopor'}
	],
   	sortname: "sma_codigo",
    sortorder: "DESC",
	usepager: true,
	useRp: true,
	rp: 15,
	singleSelect: true,
    title:"Solicitação de Material",
	width: 900,
	height: 'auto',
	showTableToggleBtn: true
});

}

function doCommand(com, grid) {
	if(com == 'Mudar Localização') {
		$('.trSelected', grid).each(function() {
			var id = $(this).attr('id');
			id = id.substring(id.lastIndexOf('row')+3);
			doLocalizacao();
			$('.modify').css('display','block');
			$('#modifyLocalizacao').append('<input type="hidden" name="solicmat" value="' + id + '" />');
		});
	} else if(com == 'Alterar Qtde') {
		$('.trSelected', grid).each(function() {
			var id = $(this).attr('id');
			id = id.substring(id.lastIndexOf('row')+3);
			doLocalizacao();
			$('.changeqtde').css('display','block');
			$('#modifyQtde').append('<input type="hidden" name="solicmat" value="' + id + '" />');
		});
	} else if(com == 'Revogar Atendimento') {
		$('.trSelected', grid).each(function() {
			var id = $(this).attr('id');
			id = id.substring(id.lastIndexOf('row')+3);
			
			$.post("modify.atendimento.ajax.php", { solicmat: id });
			jQuery("#list1").flexReload(); 
			
			alert("Atendimento Revogado com sucesso.");
			
			
		});
	}else if(com == 'Revogar Autorização') {
		$('.trSelected', grid).each(function() {
			var id = $(this).attr('id');
			id = id.substring(id.lastIndexOf('row')+3);
			
			$.post("modify.autorizacao.ajax.php", { solicmat: id });
			jQuery("#list1").flexReload(); 
			
			alert(id);
			
			alert("Autorização Revogada com sucesso.");
			
			
		});
	}
}

doFlex();

</script>
<div class="progress-bar">
	Carregando dados ... <span class="progressBar" id="pb1">0%</span>
</table>
</div>

<div class="modify">
	<fieldset>
	<legend>Alterar SM:</legend>
	<form id="modifyLocalizacao" method="post" >
	<label>Modificar Localização:</label>
	<span class="carregando" style="display: none; ">Aguarde, carregando...</span>
	<select name="localizacao" id="localizacao" onChange="submitLocalizacao()">
		<option value="0">Escolha uma localização</option>
	</select>
	</form>
	</fieldset>
</div>

<div class="changeqtde">
	<fieldset>
	<legend>Alterar Qtde:</legend>
	<form id="modifyQtde" method="post">
	
		<label>Nº Item:</label>
		<input type="text" name="item"  value="" />
		<label>Qtde:</label>
		<input type="text" name="qtde"  value="" />
		<input type="button" value="Alterar" onClick="doPost();" />
	
	</form>
	</fieldset>
</div>


