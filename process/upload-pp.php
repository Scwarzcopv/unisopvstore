<?php 	

include '../config/config.php';
session_start();

if(isset($_POST["image"]))
{
	$data = $_POST["image"];
	$image_array_1 = explode(";", $data);
	$image_array_2 = explode(",", $image_array_1[1]);
	$data = base64_decode($image_array_2[1]);
	$imageName = '../images/img-user/' . time() . '.png';

	//Insert ke dbs
	if ($_SESSION['img-user']!="") {
		unlink('../images/img-user/'.$_SESSION['img-user']);
	}
	$filename = time().'.png';
	$username = $_SESSION['username'];
	$update = "UPDATE akun SET images = '$filename' WHERE username='$username'";
    mysqli_query($conn, $update);
    $sql = "SELECT * FROM akun WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $_SESSION['img-user'] = $row['images'];

	file_put_contents($imageName, $data);
}
?>