<table id="list1" style="display:none"></table>
<script type="text/javascript">
jQuery("#list1").flexigrid({
   	url:'pesquisa_audit_sms.php?uuid=<?php echo $uuid; ?>',
	dataType: "json",
   	colModel:[
   		{display: 'Numero', name:'referencia', sortable: true, width:70, align: 'center'},
   		{display: 'Data', name:'data', width:80, sortable: true, align: 'center'},
   		{display: 'Contrato', name:'contrato', width:100, sortable: true, align: 'center'},
   		{display: 'Local', name:'local', width:100, sortable: true, align: 'center'},
   		{display: 'Solicitante', name:'solicitante', width:100, sortable: true, align: 'center'},
   		{display: 'Autorizado', name:'autorizado', width:80, sortable: true, align: 'center'},
   		{display: 'Atendido em', name:'data_atend', width:80, sortable: true, align: 'center'},
   		{display: 'Autorizado por', name:'autorizante', width:100, sortable: false, align: 'left'}
   	],
	searchitems: [
		{display: 'Numero', name : 'referencia', isdefault: true},
		{display: 'Autorizante', name : 'autorizante'}
	],
   	sortname: "id",
    sortorder: "desc",
	usepager: true,
    title:"Auditoria de SMs",
	width: 900,
	height: 400
});
</script>
<table>
	<tr><td>Carregando dados...</td><td><span class="progressBar" id="pb1">0%</span></td></tr>
</table>

