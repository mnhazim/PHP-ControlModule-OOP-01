<?php

session_start();

class conn{
	function open(){

		$localhost = "localhost";
		$username = "root";
		$password = "";
		$dbname = "controlmodule";

		$conn = mysqli_connect($localhost,$username,$password,$dbname);

		return $conn;
	}
}

?>