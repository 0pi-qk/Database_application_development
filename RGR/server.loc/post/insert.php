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

	if($table == "clients") {
		$clients = new Clients();
		$clients->name = htmlspecialchars(strip_tags($_GET['name']));
		$clients->surname = htmlspecialchars(strip_tags($_GET['surname']));
		$clients->patronymic = htmlspecialchars(strip_tags($_GET['patronymic']));
		$clients->passport_series = htmlspecialchars(strip_tags($_GET['passport_series']));
		$clients->passport_number = htmlspecialchars(strip_tags($_GET['passport_number']));
		$result = $clients->insert();
		$countRows = $clients->getCountRows();
	}

	if($table == "cashiers") {
		$cashiers = new Cashiers();
		$cashiers->name = htmlspecialchars(strip_tags($_GET['name']));
		$cashiers->surname = htmlspecialchars(strip_tags($_GET['surname']));
		$cashiers->patronymic = htmlspecialchars(strip_tags($_GET['patronymic']));
		$result = $cashiers->insert();
		$countRows = $cashiers->getCountRows();
	}

	if($table == "currencies") {
		$currencies = new Currencies();
		$currencies->code = htmlspecialchars(strip_tags($_GET['code']));
		$currencies->name = htmlspecialchars(strip_tags($_GET['name']));
		$result = $currencies->insert();
		$countRows = $currencies->getCountRows();
	}

	if($table == "rates") {
		$currencies = new Currencies();
		$rates = new Rates();
		$rates->id_currency_sold = fetchArray($currencies->load(intval($_GET['Nsold']), intval($_GET['Nsold'])))[0]['id'];
		$rates->id_currency_purchased = fetchArray($currencies->load(intval($_GET['Npurchased']), intval($_GET['Npurchased'])))[0]['id'];
		$rates->date_of_use = date("Y-m-d");
		$rates->sale_rate = $_GET['sale_rate'];
		$rates->purchase_rate = $_GET['purchase_rate'];
		$result = $rates->insert();
		$countRows = $rates->getCountRows();
	}

	if($table == "transactions") {
		$currencies = new Currencies();
		$clients = new Clients();
		$cashiers = new Cashiers();
		$rates = new Rates();
		$transactions = new Transactions();
		$id1 = fetchArray($currencies->load(intval($_GET['Nsold']), intval($_GET['Nsold'])))[0]['id'];
		$transactions->id_currency_sold = $id1;
		$id2 = fetchArray($currencies->load(intval($_GET['Npurchased']), intval($_GET['Npurchased'])))[0]['id'];
		$transactions->id_currency_purchased = $id2;
		$transactions->id_client = fetchArray($clients->load(intval($_GET['Nclient']), intval($_GET['Nclient'])))[0]['id'];
		$transactions->id_cashier = fetchArray($cashiers->load(intval($_GET['Ncashier']), intval($_GET['Ncashier'])))[0]['id'];
		$rateSold = fetchArray($rates->loadRates($id1, $id2))[0]['sale_rate'];
		$transactions->rate_sold = $rateSold;
		$ratePurchased = fetchArray($rates->loadRates($id1, $id2))[0]['purchase_rate'];
		$transactions->rate_purchased = $ratePurchased;
		$transactions->date_of_transaction = date("Y-m-d");
		$sum1 = 0;
		$sum2 = 0;
		if($_GET['type'] == 1) {
    		$sum2 = floatval($_GET['money']) * floatval($rateSold);
            $sum1 = floatval($_GET['money']);
    	}
    	if($_GET['type'] == 2) {
    		$sum1 = floatval($_GET['money']) / floatval($ratePurchased);
    		$sum2 = floatval($_GET['money']);
    	}
		$transactions->sum_currency_sold = $sum1;
		$transactions->sum_currency_purchased = $sum2;
		$result = $transactions->insert();
		$countRows = $transactions->getCountRows();
	}

	$postArray = array();
	$postArray['countRows'] = $countRows;
	$postArray['data'] = $result;
	echo json_encode($postArray);
?>