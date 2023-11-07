<?php
require_once '../config/connection.php';


class Transactions {

	public $id;
	public $id_currency_sold;
	public $id_currency_purchased;
	public $id_client;
	public $id_cashier;
	public $rate_sold;
	public $rate_purchased;
	public $date_of_transaction;
	public $sum_currency_sold;
	public $sum_currency_purchased;


	public function getCountRows() {
		$sql = "SELECT COUNT(*) FROM transactions";
		return fetchArray(query($sql))[0]['count'];
	}

	public function load($id1, $id2) {
		$sql = "SELECT id, id_currency_sold, id_currency_purchased, id_client, id_cashier, rate_sold, rate_purchased, date_of_transaction, sum_currency_sold, sum_currency_purchased FROM transactions ORDER BY id LIMIT ".strval($id2 - $id1 + 1)." OFFSET ".strval($id1 - 1).";";
		return query($sql);
	}

	public function insert() {
		$sql = "INSERT INTO transactions (id_currency_sold, id_currency_purchased, id_client, id_cashier, rate_sold, rate_purchased, date_of_transaction, sum_currency_sold, sum_currency_purchased) VALUES (".
		       $this->id_currency_sold.", ".
		       $this->id_currency_purchased.", ".
		       $this->id_client.", ".
		       $this->id_cashier.", ".
		       $this->rate_sold.", ".
		       $this->rate_purchased.", '".
		       $this->date_of_transaction."', ".
		       $this->sum_currency_sold.", ".
		       $this->sum_currency_purchased.");";
		if(query($sql)) {
			return true;
		}
		return false;
	}

	public function delete() {
		$sql = "DELETE FROM transactions WHERE id = ".$this->id.";";
		if(query($sql)) {
			return true;
		}
		return false;
	}

	public function update() {
		$sql = "UPDATE transactions SET ".
		       (isset($this->id_currency_sold) ? "id_currency_sold = ".$this->id_currency_sold.", " : "id_currency_sold = id_currency_sold,").
		       (isset($this->id_currency_purchased) ? "id_currency_purchased = ".$this->id_currency_purchased.", " : "id_currency_purchased = id_currency_purchased,").
		       (isset($this->id_client) ? "id_client = ".$this->id_client.", " : "id_client = id_client,").
		       (isset($this->id_cashier) ? "id_cashier = ".$this->id_cashier.", " : "id_cashier = id_cashier,").
		       (isset($this->rate_sold) ? "rate_sold = ".$this->rate_sold.", " : "rate_sold = rate_sold,").
		       (isset($this->rate_purchased) ? "rate_purchased = ".$this->rate_purchased.", " : "rate_purchased = rate_purchased,").
		       (isset($this->date_of_transaction) ? "date_of_transaction = '".$this->date_of_transaction."', " : "date_of_transaction = date_of_transaction,").
		       (isset($this->sum_currency_sold) ? "sum_currency_sold = ".$this->sum_currency_sold.", " : "sum_currency_sold = sum_currency_sold,").
		       (isset($this->sum_currency_purchased) ? "sum_currency_purchased = ".$this->sum_currency_purchased." " : "sum_currency_purchased = sum_currency_purchased ").
		       "WHERE id = ".$this->id.";";
		if(query($sql)) {
			return true;
		}
		return false;
	}
}

?>