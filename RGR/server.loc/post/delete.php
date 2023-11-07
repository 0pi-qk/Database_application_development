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
		$result = $clients->delete();
		$countRows = $clients->getCountRows();
	}

	if($table == "cashiers") {
		$cashiers = new Cashiers();
		$cashiers->id = fetchArray($cashiers->load($N, $N))[0]['id'];
		$result = $cashiers->delete();
		$countRows = $cashiers->getCountRows();
	}

	if($table == "currencies") {
		$currencies = new Currencies();
		$currencies->id = fetchArray($currencies->load($N, $N))[0]['id'];
		$result = $currencies->delete();
		$countRows = $currencies->getCountRows();
	}

	if($table == "rates") {
		$rates = new Rates();
		$rates->id = fetchArray($rates->load($N, $N))[0]['id'];
		$result = $rates->delete();
		$countRows = $rates->getCountRows();
	}

	if($table == "transactions") {
		$transactions = new Transactions();
		$transactions->id = fetchArray($transactions->load($N, $N))[0]['id'];
		$result = $transactions->delete();
		$countRows = $transactions->getCountRows();
	}

	$postArray = array();
	$postArray['countRows'] = $countRows;
	$postArray['data'] = $result;
	echo json_encode($postArray);
?>