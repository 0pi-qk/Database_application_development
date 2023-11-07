$('document').ready( function() {

	var state = {
		'table': "clients",
		'columns': ["N", "name", "surname", "patronymic", "passport_series", "passport_number"],
		'rows': [],
		'countRows': 0,
		'page': 1,
		'countObjectOnPage': 5
	}


	function createTable(columns, rows) {
		$('#table-space').html("");
		let id1 = 1 + (state.page - 1) * state.countObjectOnPage;
		let id = id1;
		$('#table-space').append('<table class="custom-table" border="1"></table>');
		$('.custom-table').append('<tr id="tr00" class="custom-table__row custom-table__row_head"></tr>');
		for(let i = 0; i < columns.length; i++) {
			$('#tr00').append('<th>'+columns[i]+'</th>');
		}
		for(let i = 0; i < rows.length; i++) {
			$('.custom-table').append('<tr id="tr'+i+'" class="custom-table__row"></tr>');
			if(state.table == "clients") {
				$('#tr'+i).append('<td>'+(id++)+'</td>');
				$('#tr'+i).append('<td>'+rows[i]['name']+'</td>');
				$('#tr'+i).append('<td>'+rows[i]['surname']+'</td>');
				$('#tr'+i).append('<td>'+rows[i]['patronymic']+'</td>');
				$('#tr'+i).append('<td>'+rows[i]['passport_series']+'</td>');
				$('#tr'+i).append('<td>'+rows[i]['passport_number']+'</td>');
			}
			if(state.table == "cashiers") {
				$('#tr'+i).append('<td>'+(id++)+'</td>');
				$('#tr'+i).append('<td>'+rows[i]['name']+'</td>');
				$('#tr'+i).append('<td>'+rows[i]['surname']+'</td>');
				$('#tr'+i).append('<td>'+rows[i]['patronymic']+'</td>');
			}
			if(state.table == "currencies") {
				$('#tr'+i).append('<td>'+(id++)+'</td>');
				$('#tr'+i).append('<td>'+rows[i]['code']+'</td>');
				$('#tr'+i).append('<td>'+rows[i]['name']+'</td>');
			}
			if(state.table == "rates") {
				$('#tr'+i).append('<td>'+(id++)+'</td>');
				$('#tr'+i).append('<td>'+rows[i]['id_currency_sold'][0]['name']+'</td>');
				$('#tr'+i).append('<td>'+rows[i]['id_currency_purchased'][0]['name']+'</td>');
				$('#tr'+i).append('<td>'+rows[i]['date_of_use']+'</td>');
				$('#tr'+i).append('<td>'+rows[i]['sale_rate']+'</td>');
				$('#tr'+i).append('<td>'+rows[i]['purchase_rate']+'</td>');
			}
			if(state.table == "transactions") {
				$('#tr'+i).append('<td>'+(id++)+'</td>');
				$('#tr'+i).append('<td>'+rows[i]['id_currency_sold'][0]['name']+'</td>');
				$('#tr'+i).append('<td>'+rows[i]['id_currency_purchased'][0]['name']+'</td>');
				$('#tr'+i).append('<td>'+rows[i]['id_client'][0]['surname']+'</td>');
				$('#tr'+i).append('<td>'+rows[i]['id_cashier'][0]['surname']+'</td>');
				$('#tr'+i).append('<td>'+rows[i]['rate_sold']+'</td>');
				$('#tr'+i).append('<td>'+rows[i]['rate_purchased']+'</td>');
				$('#tr'+i).append('<td>'+rows[i]['date_of_transaction']+'</td>');
				$('#tr'+i).append('<td>'+rows[i]['sum_currency_sold']+'</td>');
				$('#tr'+i).append('<td>'+rows[i]['sum_currency_purchased']+'</td>');
			}
			$('.custom-table').append('<button id="button-delete'+(id-1)+'" class="table-button" style="margin: -30px 0  0 -170px;">Удалить</button>');
			$('.custom-table').append('<button id="button-update'+(id-1)+'" class="table-button" style="margin: -30px 0  0 -90px;">Обновить</button>');
			let N = id - 1;
			$("#button-delete"+(id-1)).click(function() {
				del(N);
			});
			$("#button-update"+(id-1)).click(function() {
				update(N);
			});
		}
	}

	function createPageState() {
		let maxPage = parseInt(state.countRows % state.countObjectOnPage == 0 ? state.countRows / state.countObjectOnPage : state.countRows / state.countObjectOnPage + 1);
		$('#page-state').text('Страница: '+state.page+'/'+maxPage);
	}

	function createInputs() {
		$('#inputs-insert').html("");
		$('#inputs-update').html("");
		if(state.table == "clients") {
			$('#inputs-insert').append('<div class="title-page">Добавление записи</div><br/>');
			$('#inputs-insert').append('<input id="i1" type="text" placeholder="Enter name"/><br/>');
			$('#inputs-insert').append('<input id="i2" type="text" placeholder="Enter surname"/><br/>');
			$('#inputs-insert').append('<input id="i3" type="text" placeholder="Enter patronymic"/><br/>');
			$('#inputs-insert').append('<input id="i4" type="text" placeholder="Enter passport_series"/><br/>');
			$('#inputs-insert').append('<input id="i5" type="text" placeholder="Enter passport_number"/><br/>');
			$('#inputs-insert').append('<button id="button-insert">Добавить новую запись</button><br/>');
			$("#button-insert").click(function() {
				insert();
			});
			$('#inputs-update').append('<br/><div class="title-page">Обновление записи</div><br/>');
			$('#inputs-update').append('<input id="u1" type="text" placeholder="Enter name"/><br/>');
			$('#inputs-update').append('<input id="u2" type="text" placeholder="Enter surname"/><br/>');
			$('#inputs-update').append('<input id="u3" type="text" placeholder="Enter patronymic"/><br/>');
			$('#inputs-update').append('<input id="u4" type="text" placeholder="Enter passport_series"/><br/>');
			$('#inputs-update').append('<input id="u5" type="text" placeholder="Enter passport_number"/><br/>');
		}
		if(state.table == "cashiers") {
			$('#inputs-insert').append('<div class="title-page">Добавление записи</div><br/>');
			$('#inputs-insert').append('<input id="i1" type="text" placeholder="Enter name"/><br/>');
			$('#inputs-insert').append('<input id="i2" type="text" placeholder="Enter surname"/><br/>');
			$('#inputs-insert').append('<input id="i3" type="text" placeholder="Enter patronymic"/><br/>');
			$('#inputs-insert').append('<button id="button-insert">Добавить новую запись</button><br/>');
			$("#button-insert").click(function() {
				insert();
			});
			$('#inputs-update').append('<br/><div class="title-page">Обновление записи</div><br/>');
			$('#inputs-update').append('<input id="u1" type="text" placeholder="Enter name"/><br/>');
			$('#inputs-update').append('<input id="u2" type="text" placeholder="Enter surname"/><br/>');
			$('#inputs-update').append('<input id="u3" type="text" placeholder="Enter patronymic"/><br/>');
		}
		if(state.table == "currencies") {
			$('#inputs-insert').append('<div class="title-page">Добавление записи</div><br/>');
			$('#inputs-insert').append('<input id="i1" type="text" placeholder="Enter code"/><br/>');
			$('#inputs-insert').append('<input id="i2" type="text" placeholder="Enter name"/><br/>');
			$('#inputs-insert').append('<button id="button-insert">Добавить новую запись</button><br/>');
			$("#button-insert").click(function() {
				insert();
			});
			$('#inputs-update').append('<br/><div class="title-page">Обновление записи</div><br/>');
			$('#inputs-update').append('<input id="u1" type="text" placeholder="Enter code"/><br/>');
			$('#inputs-update').append('<input id="u2" type="text" placeholder="Enter name"/><br/>');
		}
		if(state.table == "rates") {
			$('#inputs-insert').append('<div class="title-page">Добавление записи</div><br/>');
			$('#inputs-insert').append('<input id="i1" type="text" placeholder="Enter N sold"/><br/>');
			$('#inputs-insert').append('<input id="i2" type="text" placeholder="Enter N purchased"/><br/>');
			$('#inputs-insert').append('<input id="i3" type="text" placeholder="Enter sale_rate"/><br/>');
			$('#inputs-insert').append('<input id="i4" type="text" placeholder="Enter purchase_rate"/><br/>');
			$('#inputs-insert').append('<button id="button-insert">Добавить новую запись</button><br/>');
			$("#button-insert").click(function() {
				insert();
			});
			$('#inputs-update').append('<br/><div class="title-page">Обновление записи</div><br/>');
			$('#inputs-update').append('<input id="u1" type="text" placeholder="Enter N sold"/><br/>');
			$('#inputs-update').append('<input id="u2" type="text" placeholder="Enter N purchased"/><br/>');
			$('#inputs-update').append('<input id="u3" type="text" placeholder="Enter date"/><br/>');
			$('#inputs-update').append('<input id="u4" type="text" placeholder="Enter sale_rate"/><br/>');
			$('#inputs-update').append('<input id="u5" type="text" placeholder="Enter purchase_rate"/><br/>');
		}
		if(state.table == "transactions") {
			$('#inputs-insert').append('<div class="title-page">Добавление записи</div><br/>');
			$('#inputs-insert').append('<input id="i1" type="text" placeholder="Enter N sold"/><br/>');
			$('#inputs-insert').append('<input id="i2" type="text" placeholder="Enter N purchased"/><br/>');
			$('#inputs-insert').append('<input id="i3" type="text" placeholder="Enter N client"/><br/>');
			$('#inputs-insert').append('<input id="i4" type="text" placeholder="Enter N cashier"/><br/>');
			$('#inputs-insert').append('<input id="i5" name="r" type="radio" value="1" checked="checked"/>');
			$('#inputs-insert').append('<span>Купить</span>');
			$('#inputs-insert').append('<input id="i6" name="r" type="radio" value="2" checked="checked"/>');
			$('#inputs-insert').append('<span>Продать</span><br/>');
			$('#inputs-insert').append('<input id="i7" type="text" placeholder="Enter money"/><br/>');
			$('#inputs-insert').append('<button id="button-insert">Добавить новую запись</button><br/>');
			$("#button-insert").click(function() {
				insert();
			});
			$('#inputs-update').append('<br/><div class="title-page">Обновление записи</div><br/>');
			$('#inputs-update').append('<input id="u1" type="text" placeholder="Enter N sold"/><br/>');
			$('#inputs-update').append('<input id="u2" type="text" placeholder="Enter N purchased"/><br/>');
			$('#inputs-update').append('<input id="u3" type="text" placeholder="Enter N client"/><br/>');
			$('#inputs-update').append('<input id="u4" type="text" placeholder="Enter N cashier"/><br/>');
			$('#inputs-update').append('<input id="u5" type="text" placeholder="Enter rate_sold"/><br/>');
			$('#inputs-update').append('<input id="u6" type="text" placeholder="Enter rate_purchased"/><br/>');
			$('#inputs-update').append('<input id="u7" type="text" placeholder="Enter date"/><br/>');
			$('#inputs-update').append('<input id="u8" type="text" placeholder="Enter sum_sold"/><br/>');
			$('#inputs-update').append('<input id="u9" type="text" placeholder="Enter sum_purchased"/><br/>');
		}
	}

	function loadTable() {
		let id1 = 1 + (state.page - 1) * state.countObjectOnPage;
		let id2 = state.countObjectOnPage + (state.page - 1) * state.countObjectOnPage;
		$.ajax({
			url: 'http://server.loc/post/load.php',      
			method: 'GET',                    
			data: {table: state.table,
				   id1: id1,
			       id2: id2},    
			success: function(data){
				if(data.countRows != 0) {
					state.countRows = data.countRows;
					state.rows = data.data;  
					createTable(state.columns, state.rows);
					createPageState();
				} else {
					$('#table-space').html("");
					$('#table-space').append('<div>Объект пуст!</div>');
				}
			},
			error: function(data){
				console.log(data);
			}
		});
	}

	function insert() {
		let array = null;
		if(state.table == "clients") {
			array = {
				table: state.table,
				name: $("#i1").val(),
				surname: $("#i2").val(),
				patronymic: $("#i3").val(),
				passport_series: $("#i4").val(),
				passport_number: $("#i5").val()
			}
		}
		if(state.table == "cashiers") {
			array = {
				table: state.table,
				name: $("#i1").val(),
				surname: $("#i2").val(),
				patronymic: $("#i3").val()
			}
		}
		if(state.table == "currencies") {
			array = {
				table: state.table,
				code: $("#i1").val(),
				name: $("#i2").val()
			}
		}
		if(state.table == "rates") {
			array = {
				table: state.table,
				Nsold: $("#i1").val(),
				Npurchased: $("#i2").val(),
				sale_rate: $("#i3").val(),
				purchase_rate: $("#i4").val()
			}
		}
		if(state.table == "transactions") {
			array = {
				table: state.table,
				Nsold: $("#i1").val(),
				Npurchased: $("#i2").val(),
				Nclient: $("#i3").val(),
				Ncashier: $("#i4").val(),
				type: $('#i5').is(':checked') ?  $("#i5").val() :  $("#i6").val(),
				money: $("#i7").val()
			}
		}
		console.log(array);
		$.ajax({
			url: 'http://server.loc/post/insert.php',      
			method: 'GET',                    
			data: array,    
			success: function(data){
				state.countRows = data.countRows;
				if(data.data) {
					alert("Запись добавлена!");
				} else {
					alert("Запись не добавлена!");
				}
				loadTable();
			}
		});
	}

	function del(N) {
		console.log(N);
		$.ajax({
			url: 'http://server.loc/post/delete.php',      
			method: 'GET',                    
			data: {
				table: state.table,
				N: N
			},    
			success: function(data){
				state.countRows = data.countRows;
				if(data.data) {
					alert("Запись удалена!");
				} else {
					alert("Запись не удалена!");
				}
				let maxPage = parseInt(state.countRows % state.countObjectOnPage == 0 ? state.countRows / state.countObjectOnPage : state.countRows / state.countObjectOnPage + 1);
				if(state.page > maxPage) {
    				let page = state.page - 1;
    				state.page = page;
    			}
    			loadTable();
			},
			error: function(data){
				alert("Запись не удалена!");
			}
		});
	}

	function update(N) {
		let array = null;
		array = {
			table: state.table,
			N: N
		}
		if(state.table == "clients") {
			if(isNaN($("#u1").val())) {
				array['name'] = $("#u1").val();
			}
			if(isNaN($("#u2").val())) {
				array['surname'] = $("#u2").val();
			}
			if(isNaN($("#u3").val())) {
				array['patronymic'] = $("#u3").val();
			}
			if($("#u4").val() != 0) {
				array['passport_series'] = $("#u4").val();
			}
			if($("#u5").val() != 0) {
				array['passport_number'] = $("#u5").val();
			}
		}
		if(state.table == "cashiers") {
			if(isNaN($("#u1").val())) {
				array['name'] = $("#u1").val();
			}
			if(isNaN($("#u2").val())) {
				array['surname'] = $("#u2").val();
			}
			if(isNaN($("#u3").val())) {
				array['patronymic'] = $("#u3").val();
			}
		}
		if(state.table == "currencies") {
			if($("#u1").val() != 0) {
				array['code'] = $("#u1").val();
			}
			if(isNaN($("#u2").val())) {
				array['name'] = $("#u2").val();
			}
		}
		if(state.table == "rates") {
			if($("#u1").val() != 0) {
				array['Nsold'] = $("#u1").val();
			}
			if($("#u2").val() != 0) {
				array['Npurchased'] = $("#u2").val();
			}
			if(isNaN($("#u3").val())) {
				array['date'] = $("#u3").val();
			}
			if($("#u4").val() != 0) {
				array['sale_rate'] = $("#u4").val();
			}
			if($("#u5").val() != 0) {
				array['purchase_rate'] = $("#u5").val();
			}
		}
		if(state.table == "transactions") {
			if($("#u1").val() != 0) {
				array['Nsold'] = $("#u1").val();
			}
			if($("#u2").val() != 0) {
				array['Npurchased'] = $("#u2").val();
			}
			if($("#u3").val() != 0) {
				array['Nclient'] = $("#u3").val();
			}
			if($("#u4").val() != 0) {
				array['Ncashier'] = $("#u4").val();
			}
			if($("#u5").val() != 0) {
				array['rate_sold'] = $("#u5").val();
			}
			if($("#u6").val() != 0) {
				array['rate_purchased'] = $("#u6").val();
			}
			if(isNaN($("#u7").val())) {
				array['date'] = $("#u7").val();
			}
			if($("#u8").val() != 0) {
				array['sum_sold'] = $("#u8").val();
			}
			if($("#u9").val() != 0) {
				array['sum_purchased'] = $("#u9").val();
			}
		}
		$.ajax({
			url: 'http://server.loc/post/update.php',      
			method: 'GET',                    
			data: array,  
			success: function(data){
				state.countRows = data.countRows;
				if(data.data) {
					alert("Запись обновлена!");
				} else {
					alert("Запись не обновлена!");
				}
				loadTable();
			},
			error: function(data){
				console.log(data);
				alert("ERRЗапись не обновлена!");
			}
		});
	}

	$("#button-prev").click(function() {
		if(state.page > 1) {
			let v =  state.page - 1;
			state.page = v;
		}
		loadTable();
	});

	$("#button-next").click(function() {
		let maxPage = parseInt(state.countRows % state.countObjectOnPage == 0 ? state.countRows / state.countObjectOnPage : state.countRows / state.countObjectOnPage + 1);
		if(state.page < maxPage) {
			let v =  state.page + 1;
			state.page = v;
		}
		loadTable();
	});


	$("#button-clients").click(function() {
		state.table = "clients";
		state.columns = ["N", "name", "surname", "patronymic", "passport_series", "passport_number"];
		state.page = 1;
		$('#tp').text('Объект clients');
		loadTable();
		createInputs();
	});

	$("#button-cashiers").click(function() {
		state.table = "cashiers";
		state.columns = ["N", "name", "surname", "patronymic"];
		state.page = 1;
		$('#tp').text('Объект cashiers');
		loadTable();
		createInputs();
	});

	$("#button-currencies").click(function() {
		state.table = "currencies";
		state.columns = ["N", "code", "name"];
		state.page = 1;
		$('#tp').text('Объект currencies');
		loadTable();
		createInputs();
	});

	$("#button-rates").click(function() {
		state.table = "rates";
		state.columns = ["N", "sold", "purchased", "date", "sale_rate", "purchase_rate"];
		state.page = 1;
		$('#tp').text('Объект rates');
		loadTable();
		createInputs();
	});

	$("#button-transactions").click(function() {
		state.table = "transactions";
		state.columns = ["N", "sold", "purchased", "client", "cashier", "rate_sold", "rate_purchased", "date", "sum_sold", "sum_purchased"];
		state.page = 1;
		$('#tp').text('Объект transactions');
		loadTable();
		createInputs();
	});

	function main() {
		createInputs();
		loadTable();
		//createTable(state.columns,[["Daniil", "mostovoy", "fg"],["fdg", "dfgf", "dfgdf"]]);
	}

	main();
}); 