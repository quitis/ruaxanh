var Qtable = {
	
	table : '',
	
	init: function(table){
		this.table = table;
		
		$('#'+ this.table).find('td').bind('click', Qtable.editCell);
		$(document).click(function (event) {
			if (!$(event.target).is("#"+ Qtable.table + ' td') &&  !$(event.target).is("#q_cell_input")) {
				Qtable.removeCellInput();
			}
		});
		
		//button more row
		var oMoreRow = $('<button>');
		oMoreRow.attr('class','btn btn-info');
		oMoreRow.text('More...');
		oMoreRow.click(function(){
			Qtable.addRow();
		});
		$(oMoreRow).insertAfter($('#'+ this.table));
	},
	
	editCell: function(){
		var sValue = $(this).text();
		if($('#q_cell_input').length>0 && !$('#q_cell_input').parent().is($(this))) {
			Qtable.removeCellInput();
		}
		
		if( $('#q_cell_input').length==0 ||  ($('#q_cell_input').length>0 && !$('#q_cell_input').parent().is($(this)))  ){
			var sInput = $('<input>');
			sInput.attr('id','q_cell_input');
			sInput.attr('type','text');
			sInput.attr('class','q-cell-input');
			sInput.val(sValue);
			$(this).text('');
			$(this).append(sInput);
			sInput.focus();
		}
	},
	
	removeCellInput: function(){
		if( $('#q_cell_input').length>0 ){
			var sTd = $('#q_cell_input').parent();
			var sCellValue = $('#q_cell_input').val();
			$('#q_cell_input').remove();
			sTd.html('');
			sTd.html(sCellValue);
		}
	},
	
	getMaxColumn: function(){
		var max = 0, trList = $('#' + Qtable.table + ' tr');
		trList.each(function(){
			if($(this).find('td').length > max){
				max = $(this).find('td').length;
			}
		});
		return max;
	},
	
	addRow: function(){
		var colsCount = $('#' +Qtable.table+ ' tr:last').find('td').length;
		var td,tr = $('<tr>');
		for(var i=1;i<=colsCount;i++){
			td = $('<td>');
			td.html('test'+i);
			td.bind('click', Qtable.editCell);
			tr.append(td);
		}
		$('#'+Qtable.table).append(tr);
		var sInput = $('<input>');
		sInput.attr('id','q_cell_input');
		sInput.attr('type','text');
		sInput.attr('class','q-cell-input');
		sInput.val('');
		//$('#' +Qtable.table+ ' tr:last td:first').find('td:first').append(sInput);
		console.log($('#' +Qtable.table+ ' tr:last td:first').text());
		sInput.focus();
		$('#' +Qtable.table+ ' tr:last td:first').append(sInput);
	}
}