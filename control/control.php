<?php
include '../connection/conn.php';
session_start();
$obj = new control();
class control{
	public function __construct(){
		if (isset($_GET['mode'])) {
			$action = $_GET['mode'];
			switch ($action) {
				case 'register':
					$this->register();
					break;

				case 'delete':
					$this->delete();
					break;

				case 'update':
					$this->update();
					break;

				case 'login':
					$this->login();
					break;

				case 'logout':
					$this->logout();
					break;

			}
		}
	}

	public function logout(){
		session_destroy();
		echo "<script>window.alert('Logout')</script>";
		echo "<script>window.location='../login.php'</script>";
	}

	public function login(){
		$connection = new conn();
		$conn = $connection->open();

		$email = $_POST['email'];
		$pass = $_POST['password'];

		$sqllogin = "SELECT * FROM pengguna WHERE email = '$email' AND password = '$pass'";
		$rslogin = mysqli_query($conn, $sqllogin);
		if (mysqli_num_rows($rslogin) > 0) {
			$rowlogin = mysqli_fetch_array($rslogin);
			$_SESSION['id'] = $rowlogin['id_pengguna'];
			$_SESSION['nama'] = $rowlogin['nama'];

			echo "<script>window.alert('Berjaya Log Masuk')</script>";
			echo "<script>window.location='../home.php'</script>";
		} else {
			echo "<script>window.alert('Invalid, Please try again')</script>";
			echo "<script>window.location='../login.php'</script>";
		}
	}

	public function update(){
		$connection = new conn();
		$conn = $connection->open();

		$nama = $_POST['nama'];
		$email = $_POST['email'];
		$alamat = $_POST['alamat'];
		$idpengguna = $_POST['id_pengguna'];
		$password =  $_POST['password'];


		$sqlupdate = "UPDATE pengguna SET nama='$nama',email='$email',alamat='$alamat', password = '$password' WHERE id_pengguna = '$idpengguna'";
		$rsupdate = mysqli_query($conn, $sqlupdate);
		if ($rsupdate) {
			echo "<script>window.alert('data anda berjaya di kemaskini')</script>";
			echo "<script>window.location='../index.php'</script>";
		} else {
			echo "error update function";
		}
	}

	public function delete(){
		$connection = new conn();
		$conn = $connection->open();
		$iddel = "-1";
		if (isset($_POST['iddel'])) {
			$iddel = $_POST['iddel'];
		}

		$sqldelete = "DELETE FROM pengguna WHERE id_pengguna = '$iddel'";
		$rsdelete = mysqli_query($conn, $sqldelete);

		if ($rsdelete) {
			echo "<script>window.alert('data anda telah berjaya di padam')</script>";
			echo "<script>window.location='../index.php'</script>";
		} else {
			echo "error delete function";
		}
	}

	public function register(){
		$connection = new conn();
		$conn = $connection->open();

		$nama = $_POST['nama'];
		$email = $_POST['email'];
		$alamat = $_POST['alamat'];
		$password = $_POST['password'];

		$sqlregister = "INSERT INTO pengguna (nama,email,alamat,password) VALUES ('$nama','$email','$alamat', '$password')";
		$rsregister = mysqli_query($conn, $sqlregister);
		if ($rsregister) {
			echo "<script>window.alert('Pendaftaran anda telah berjaya.')</script>";
			echo "<script>window.location='../index.php'</script>";
		} else {
			echo "error insert";
		}
	}
}

?>