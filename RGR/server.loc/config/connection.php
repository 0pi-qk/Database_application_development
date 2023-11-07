<?php

$connect = odbc_pconnect("PostgreSQL35W","student","123");


if(!$connect) {
	echo "not connect";
}

function query($sql) {
	global $connect;
	return odbc_exec($connect, $sql);
}

function fetchArray($query) {
	$array = array();
	while($result = odbc_fetch_array($query)) {
		array_push($array, $result);
	}
	return $array;
}

//print_r(fetchArray(query("SELECT * FROM clients;")));
?>