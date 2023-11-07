<?php
require_once '../config/connection.php';

class Rates {

	public $id;
	public $id_currency_sold;
	public $id_currency_purchased;
	public $date_of_use;
	public $sale_rate;
	public $purchase_rate;


	public function getCountRows() {
		$sql = "SELECT COUNT(*) FROM rates";
		return fetchArray(query($sql))[0]['count'];
	}

	public function load($id1, $id2) {
		$sql = "SELECT id, id_currency_sold, id_currency_purchased, date_of_use, sale_rate, purchase_rate FROM rates ORDER BY id LIMIT ".strval($id2 - $id1 + 1)." OFFSET ".strval($id1 - 1).";";
		return query($sql);
	}

	public function loadRates($id1, $id2) {
		$sql = "SELECT sale_rate, purchase_rate FROM rates WHERE id_currency_sold = ".strval($id1)." AND id_currency_purchased = ".strval($id2)." ORDER BY date_of_use DESC;";
		return query($sql);
	}

	public function insert() {
		$sql = "INSERT INTO rates (id_currency_sold, id_currency_purchased, date_of_use, sale_rate, purchase_rate) VALUES (".
		       $this->id_currency_sold.", ".
		       $this->id_currency_purchased.", '".
		       $this->date_of_use."', ".
		       $this->sale_rate.", ".
		       $this->purchase_rate.");";
		if(query($sql)) {
			return true;
		}
		return false;
	}

	public function delete() {
		$sql = "DELETE FROM rates WHERE id = ".$this->id.";";
		if(query($sql)) {
			return true;
		}
		return false;
	}

	public function update() {
		$sql = "UPDATE rates SET ".
		       (isset($this->id_currency_sold) ? "id_currency_sold = ".$this->id_currency_sold.", " : "id_currency_sold = id_currency_sold,").
		       (isset($this->id_currency_purchased) ? "id_currency_purchased = ".$this->id_currency_purchased.", " : "id_currency_purchased = id_currency_purchased,").
		       (isset($this->date_of_use) ? "date_of_use = '".$this->date_of_use."', " : "date_of_use = date_of_use,").
		       (isset($this->sale_rate) ? "sale_rate = ".$this->sale_rate.", " : "sale_rate = sale_rate,").
		       (isset($this->purchase_rate) ? "purchase_rate = ".$this->purchase_rate." " : "purchase_rate = purchase_rate ").
		       "WHERE id = ".$this->id.";";
		if(query($sql)) {
			return true;
		}
		return false;
	}
}

?>