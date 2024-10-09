<?php
include '../config/config.php';
session_start();
$sweet_login = "<script>
const Custom = Swal.mixin({
	toast: true,
	position: 'top-right',
	showConfirmButton: false,
	showCloseButton: true,
	timer: 3000,
	timerProgressBar: true,
	keydownListenerCapture: true,
	didOpen: (toast) => {
		toast.addEventListener('mouseenter', Swal.stopTimer)
		toast.addEventListener('mouseleave', Swal.resumeTimer)
	}
})
Custom.fire({
	icon: 'warning',
  	title : 'Please login first',
})</script>";
if (isset($_SESSION['username'])) {
	if (isset($_POST['id'])) {
		$username = $_SESSION['username'];
		$id_produk = $_POST['id'];
		$already = false;

		$sql = "SELECT * FROM wishlist";
		$result = mysqli_query($conn,$sql);
		while($row = mysqli_fetch_array($result)){
			if ($row['username'] == $username && $row['id_produk'] == $id_produk) {
				$already = true;
			}
		}

		if ($already == false) {
			$sql_product = "SELECT * FROM produk WHERE id_produk = '$id_produk'";
			$res_product = mysqli_query($conn,$sql_product);
			$row = mysqli_fetch_assoc($res_product);
			$harga = $row['harga_produk'];

			$sql = "INSERT INTO wishlist (username, id_produk, harga) VALUES ('$username', '$id_produk', '$harga')";
			$result = mysqli_query($conn, $sql);
		}
		else {
			mysqli_query($conn,"DELETE FROM wishlist WHERE username='$username' AND id_produk='$id_produk'");
		}
	}
}
else {
	$_SESSION['massage'] = $sweet_login;
	header("Location:../pages/login.php#login"); 
}
?>