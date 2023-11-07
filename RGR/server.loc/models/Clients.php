<?php
require_once '../config/connection.php';

class Clients {

	public $id;
	public $name;
	public $surname;
	public $patronymic;
	public $passport_series;
	public $passport_number;


	public function getCountRows() {
		$sql = "SELECT COUNT(*) FROM clients";
		return fetchArray(query($sql))[0]['count'];
	}

	public function load($id1, $id2) {
		$sql = "SELECT id, name, surname, patronymic, passport_series, passport_number FROM clients ORDER BY id LIMIT ".strval($id2 - $id1 + 1)." OFFSET ".strval($id1 - 1).";";
		return query($sql);
	}

	public function loadById($id) {
		$sql = "SELECT id, name, surname, patronymic, passport_series, passport_number FROM clients WHERE id = ".strval($id).";";
		return query($sql);
	}

	public function insert() {
		$sql = "INSERT INTO clients (name, surname, patronymic, passport_series, passport_number) VALUES ('".
		       $this->name."', '".
		       $this->surname."', '".
		       $this->patronymic."', '".
		       $this->passport_series."', '".
		       $this->passport_number."');";
		if(query($sql)) {
			return true;
		}
		return false;
	}

	public function delete() {
		$sql = "DELETE FROM clients WHERE id = ".$this->id.";";
		if(query($sql)) {
			return true;
		}
		return false;
	}

	public function update() {
		$sql = "UPDATE clients SET ".
		       (isset($this->name) ? "name = '".$this->name."', " : "name = name,").
		       (isset($this->surname) ? "surname = '".$this->surname."', " : "surname = surname,").
		       (isset($this->patronymic) ? "patronymic = '".$this->patronymic."', " : "patronymic = patronymic,").
		       (isset($this->passport_series) ? "passport_series = '".$this->passport_series."', " : "passport_series = passport_series,").
		       (isset($this->passport_number) ? "passport_number = '".$this->passport_number."' " : "passport_number = passport_number ").
		       "WHERE id = ".$this->id.";";
		if(query($sql)) {
			return true;
		}
		return false;
	}


}

?>