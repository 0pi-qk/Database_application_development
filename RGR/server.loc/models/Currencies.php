<?php
require_once '../config/connection.php';

class Currencies {

	public $id;
	public $code;
	public $name;


	public function getCountRows() {
		$sql = "SELECT COUNT(*) FROM currencies";
		return fetchArray(query($sql))[0]['count'];
	}

	public function loadById($id) {
		$sql = "SELECT id, code, name FROM currencies WHERE id = ".strval($id).";";
		return query($sql);
	}

	public function load($id1, $id2) {
		$sql = "SELECT id, code, name FROM currencies ORDER BY id LIMIT ".strval($id2 - $id1 + 1)." OFFSET ".strval($id1 - 1).";";
		return query($sql);
	}

	public function insert() {
		$sql = "INSERT INTO currencies (code, name) VALUES ('".
		       $this->code."', '".
		       $this->name."');";
		if(query($sql)) {
			return true;
		}
		return false;
	}

	public function delete() {
		$sql = "DELETE FROM currencies WHERE id = ".$this->id.";";
		if(query($sql)) {
			return true;
		}
		return false;
	}

	public function update() {
		$sql = "UPDATE currencies SET ".
		       (isset($this->code) ? "code = '".$this->code."', " : "code = code,").
		       (isset($this->name) ? "name = '".$this->name."' " : "name = name ").
		       "WHERE id = ".$this->id.";";
		if(query($sql)) {
			return true;
		}
		return false;
	}


}

?>