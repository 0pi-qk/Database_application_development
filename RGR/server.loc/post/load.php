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
	$id1 = intval($_GET['id1']);
	$id2 = intval($_GET['id2']);

	if($table == "clients") {
		$clients = new Clients();
		$countRows = $clients->getCountRows();
		$result = fetchArray($clients->load($id1, $id2));
	}

	if($table == "cashiers") {
		$cashiers = new Cashiers();
		$countRows = $cashiers->getCountRows();
		$result = fetchArray($cashiers->load($id1, $id2));
	}

	if($table == "currencies") {
		$currencies = new Currencies();
		$countRows = $currencies->getCountRows();
		$result = fetchArray($currencies->load($id1, $id2));
	}

	if($table == "rates") {
		$currencies = new Currencies();
		$rates = new Rates();
		$countRows = $rates->getCountRows();
		$result = fetchArray($rates->load($id1, $id2));
		for($i = 0; $i < count($result); $i++) {
			$result[$i]['id_currency_sold'] = fetchArray($currencies->loadById(intval($result[$i]['id_currency_sold'])));
			$result[$i]['id_currency_purchased'] = fetchArray($currencies->loadById(intval($result[$i]['id_currency_purchased'])));
		}
	}

	if($table == "transactions") {
		$currencies = new Currencies();
		$clients = new Clients();
		$cashiers = new Cashiers();
		$transactions = new Transactions();
		$countRows = $transactions->getCountRows();
		$result = fetchArray($transactions->load($id1, $id2));
		for($i = 0; $i < count($result); $i++) {
			$result[$i]['id_currency_sold'] = fetchArray($currencies->loadById(intval($result[$i]['id_currency_sold'])));
			$result[$i]['id_currency_purchased'] = fetchArray($currencies->loadById(intval($result[$i]['id_currency_purchased'])));
			$result[$i]['id_client'] = fetchArray($clients->loadById(intval($result[$i]['id_client'])));
			$result[$i]['id_cashier'] = fetchArray($cashiers->loadById(intval($result[$i]['id_cashier'])));
		}
	}

	$postArray = array();
	$postArray['countRows'] = $countRows;
	$postArray['data'] = $result;
	echo json_encode($postArray);
?>