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
  	title : 'Please login first!',
})</script>";
if (isset($_SESSION['username'])) {
	if (isset($_POST['id'])) {
		$username = $_SESSION['username'];
		$id_cart = $_POST['id'];

		$sql = "DELETE FROM cart WHERE username='$username' AND id_cart='$id_cart'";
		mysqli_query($conn,$sql);
	}
}
else {
	$_SESSION['massage'] = $sweet_login;
	header("Location:../pages/login.php#login"); 
}
?>