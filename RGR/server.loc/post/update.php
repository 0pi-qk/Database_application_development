<?php
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	require '../models/Clients.php';
	require '../models/Cashiers.php';
	require '../models/Currencies.php';
	require '../models/Rates.php';
	require '../models/Transactions.php';

	$result = null;
	$countRows = 0;
	$table = htmlspecialchars(strip_tags($_GET['table']));
	$N = intval($_GET['N']);

	if($table == "clients") {
		$clients = new Clients();
		$clients->id = fetchArray($clients->load($N, $N))[0]['id'];
		if(isset($_GET['name'])) {
			$clients->name = htmlspecialchars(strip_tags($_GET['name']));
		}
		if(isset($_GET['surname'])) {
			$clients->surname = htmlspecialchars(strip_tags($_GET['surname']));
		}
		if(isset($_GET['patronymic'])) {
			$clients->patronymic = htmlspecialchars(strip_tags($_GET['patronymic']));
		}
		if(isset($_GET['passport_series'])) {
			$clients->passport_series = htmlspecialchars(strip_tags($_GET['passport_series']));
		}
		if(isset($_GET['passport_number'])) {
			$clients->passport_number = htmlspecialchars(strip_tags($_GET['passport_number']));
		}
		$result = $clients->update();
		$countRows = $clients->getCountRows();
	}

	if($table == "cashiers") {
		$cashiers = new Cashiers();
		$cashiers->id = fetchArray($cashiers->load($N, $N))[0]['id'];
		if(isset($_GET['name'])) {
			$cashiers->name = htmlspecialchars(strip_tags($_GET['name']));
		}
		if(isset($_GET['surname'])) {
			$cashiers->surname = htmlspecialchars(strip_tags($_GET['surname']));
		}
		if(isset($_GET['patronymic'])) {
			$cashiers->patronymic = htmlspecialchars(strip_tags($_GET['patronymic']));
		}
		$result = $cashiers->update();
		$countRows = $cashiers->getCountRows();
	}

	if($table == "currencies") {
		$currencies = new Currencies();
		$currencies->id = fetchArray($currencies->load($N, $N))[0]['id'];
		if(isset($_GET['code'])) {
			$currencies->code = htmlspecialchars(strip_tags($_GET['code']));
		}
		if(isset($_GET['name'])) {
			$currencies->name = htmlspecialchars(strip_tags($_GET['name']));
		}
		$result = $currencies->update();
		$countRows = $currencies->getCountRows();
	}

	if($table == "rates") {
		$currencies = new Currencies();
		$rates = new Rates();
		$rates->id = fetchArray($rates->load($N, $N))[0]['id'];
		if(isset($_GET['Nsold'])) {
			$rates->id_currency_sold =  fetchArray($currencies->load(intval($_GET['Nsold']), intval($_GET['Nsold'])))[0]['id'];
		}
		if(isset($_GET['Npurchased'])) {
			$rates->id_currency_purchased = fetchArray($currencies->load(intval($_GET['Npurchased']), intval($_GET['Npurchased'])))[0]['id'];
		}
		if(isset($_GET['date'])) {
			$rates->date_of_use = htmlspecialchars(strip_tags($_GET['date']));
		}
		if(isset($_GET['sale_rate'])) {
			$rates->sale_rate = htmlspecialchars(strip_tags($_GET['sale_rate']));
		}
		if(isset($_GET['purchase_rate'])) {
			$rates->purchase_rate = htmlspecialchars(strip_tags($_GET['purchase_rate']));
		}
		$result = $rates->update();
		$countRows = $rates->getCountRows();
	}

	if($table == "transactions") {
		$currencies = new Currencies();
		$clients = new Clients();
		$cashiers = new Cashiers();
		$transactions = new Transactions();
		$transactions->id = fetchArray($transactions->load($N, $N))[0]['id'];
		if(isset($_GET['Nsold'])) {
			$transactions->id_currency_sold =  fetchArray($currencies->load(intval($_GET['Nsold']), intval($_GET['Nsold'])))[0]['id'];
		}
		if(isset($_GET['Npurchased'])) {
			$transactions->id_currency_purchased = fetchArray($currencies->load(intval($_GET['Npurchased']), intval($_GET['Npurchased'])))[0]['id'];
		}
		if(isset($_GET['Nclient'])) {
			$transactions->id_client =  fetchArray($clients->load(intval($_GET['Nclient']), intval($_GET['Nclient'])))[0]['id'];
		}
		if(isset($_GET['Ncashier'])) {
			$transactions->id_cashier = fetchArray($cashiers->load(intval($_GET['Ncashier']), intval($_GET['Ncashier'])))[0]['id'];
		}
		if(isset($_GET['rate_sold'])) {
			$transactions->rate_sold = floatval($_GET['rate_sold']);
		}
		if(isset($_GET['rate_purchased'])) {
			$transactions->rate_purchased = floatval($_GET['rate_purchased']);
		}
		if(isset($_GET['date'])) {
			$transactions->date_of_transaction = htmlspecialchars(strip_tags($_GET['date']));
		}
		if(isset($_GET['sum_sold'])) {
			$transactions->sum_currency_sold = floatval($_GET['sum_sold']);
		}
		if(isset($_GET['sum_purchased'])) {
			$transactions->id_currency_purchased = floatval($_GET['sum_purchased']);
		}
		$result = $transactions->update();
		$countRows = $transactions->getCountRows();
	}

	$postArray = array();
	$postArray['countRows'] = $countRows;
	$postArray['data'] = $result;
	echo json_encode($postArray);
?>