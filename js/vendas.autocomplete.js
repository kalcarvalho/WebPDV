$(document).ready(function() {

	$("#produtos").focus();

	$.getJSON("itens.ajax.php?metodo=all", function(data) {
	
		var list = [];
	
		$(data).each(function(key, value) {
			list.push(value);
		});
	
		$( "#produtos" ).autocomplete({
			source: list,
			autoFill: true,
			matchContains: true
		});
	
	});
	
	/*
	$( "#produtos" ).autocomplete({
		source: "itens.ajax.php",
		delay: 10,
		autoFocus: false,
		minLength: 0,
		select: function(event, ui)
		{
			console.log(ui);
 			event.preventDefault();
 			$( "#produtos" ).val(ui.item.id);
			$('#add_item_form').ajaxSubmit({target: "#venda-rapida", beforeSubmit: salesBeforeSubmit, success: salesSuccess});
		},
		change: function(event, ui)
		{
			if ($(this).attr('value') != '' && $(this).attr('value') != "Type item name or scan barcode...")
			{
				$("#add_item_form").ajaxSubmit({target: "#venda-rapida", beforeSubmit: salesBeforeSubmit, success: salesSuccess});
			}
	
    		$(this).attr('value',"Type item name or scan barcode...");
		}
	});
	
	setTimeout(function(){$('#produtos').focus();}, 10);
	
	*/
	
	// $('#produtos').click(function() {
    	// $(this).attr('value','');
    // });
	
	
});
