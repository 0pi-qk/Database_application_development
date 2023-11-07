<?php
require_once '../config/connection.php';

class Cashiers {

	public $id;
	public $name;
	public $surname;
	public $patronymic;


	public function getCountRows() {
		$sql = "SELECT COUNT(*) FROM cashiers";
		return fetchArray(query($sql))[0]['count'];
	}

	public function load($id1, $id2) {
		$sql = "SELECT id, name, surname, patronymic FROM cashiers ORDER BY id LIMIT ".strval($id2 - $id1 + 1)." OFFSET ".strval($id1 - 1).";";
		return query($sql);
	}

	public function loadById($id) {
		$sql = "SELECT id, name, surname, patronymic FROM cashiers WHERE id = ".strval($id).";";
		return query($sql);
	}

	public function insert() {
		$sql = "INSERT INTO cashiers (name, surname, patronymic) VALUES ('".
		       $this->name."', '".
		       $this->surname."', '".
		       $this->patronymic."');";
		if(query($sql)) {
			return true;
		}
		return false;
	}

	public function delete() {
		$sql = "DELETE FROM cashiers WHERE id = ".$this->id.";";
		if(query($sql)) {
			return true;
		}
		return false;
	}

	public function update() {
		$sql = "UPDATE cashiers SET ".
		       (isset($this->name) ? "name = '".$this->name."', " : "name = name,").
		       (isset($this->surname) ? "surname = '".$this->surname."', " : "surname = surname,").
		       (isset($this->patronymic) ? "patronymic = '".$this->patronymic."' " : "patronymic = patronymic ").
		       "WHERE id = ".$this->id.";";
		if(query($sql)) {
			return true;
		}
		return false;
	}


}

?>