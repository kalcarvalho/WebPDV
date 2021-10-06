<table id="list1" style="display:none"></table>

<script type="text/javascript">

	/* function doLocalizacao() {
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
		
	} */
	
	function doPost() {
	
		var origem = $("#modifyCFOP").find('input[name="origem"]').val(); 
		var destino = $("#modifyCFOP").find('input[name="destino"]').val(); 
		
		$('#modify-erro').remove();
		
		
		if(origem.length == 0 || destino.length == 0) {
			$('.modify').append('<p><span class="error-message" id="modify-erro" >Você deve informar uma CFOP de Origem e Destino</span></p>');
			return;
		}
		
		
	
		$.post("modify.cfop.ajax.php", $("#modifyCFOP").serialize()) 
		.success (function() {
			jQuery("#list1").flexReload(); 
			$('.modify').css('display','none');
		});
		
	} 
	
	
	
</script>
<script type="text/javascript">
function doFlex() {

jQuery("#list1").flexigrid({
   	url:'pesquisa.nfe.ajax.php?uuid=<?php echo $uuid; ?>',
	dataType: "json",
   	colModel:[
   		{display: 'ID', name:'ntf_codigo', sortable: true, width:70, align: 'center', hide: true},
   		{display: 'Numero', name:'ntf_numero', sortable: true, width:70, align: 'center'},
   		{display: 'Tipo', name:'ntf_tipo', width:60, sortable: false, align: 'center'},
		{display: 'Emissão', name:'ntf_emissao', width:80, sortable: true, align: 'center'},
		{display: 'Destinatário', name:'des_nomerazao', width:300, sortable: true, align: 'left'},
		{display: 'V. Total R$', name:'ntf_valor', width:100, sortable: true, align: 'right'},
		{display: 'Cancelada', name:'ntf_cancelada', width:100, sortable: false, align: 'center'},
		{display: 'Protocolo', name:'ntf_protocolo', width:100, sortable: false, align: 'center'}
   		/*{display: 'Contrato', name:'ctr_descricao', width:100, sortable: true, align: 'center'},
   		{display: 'Local', name:'loc_descricao', width:100, sortable: true, align: 'center'},
   		{display: 'Solicitante', name:'usu_nome', width:120, sortable: true, align: 'center'},
   		{display: 'Autorizado', name:'sma_autorizado', width:80, sortable: true, align: 'center'},
   		{display: 'Atendido em', name:'sma_dataatend', width:80, sortable: true, align: 'center'},
   		{display: 'Autorizado por', name:'sma_autorizadopor', width:120, sortable: false, align: 'left'}*/
   	],
	buttons:[
		 {name: 'Alterar CFOP', bclass: 'add', onpress: doCommand},
		{separator: true}
	],
	searchitems: [
		{display: 'Numero', name : 'ntf_numero', isdefault: true}
	],
   	sortname: "ntf_codigo",
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
	if(com == 'Alterar CFOP') {
		$('.trSelected', grid).each(function() {
			var id = $(this).attr('id');
			id = id.substring(id.lastIndexOf('row')+3);
			$('.modify').css('display','block');
			$('#modifyCFOP').append('<input type="hidden" name="notafiscal" value="' + id + '" />');
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
	<legend>Alterar CFOPS da NFe</legend>
	<form id="modifyCFOP" method="post" >
		<label>CFOP Origem:</label>
		<input type="text" name="origem"  value="" />
		<label>CFOP Destino:</label>
		<input type="text" name="destino"  value="" />
		<input type="button" value="Alterar" onClick="doPost();" />
	</form>
	</fieldset>
</div>

