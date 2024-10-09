<?php 
	include '../config/config.php';
	session_start();
	if (isset($_SESSION['username'])) {
	    header("Location: ../index.php");
	}
?>
<!DOCTYPE html>
<html lang="en" >
<head>
	<meta charset="UTF-8">
	<title>Login - UnisopvStore</title>
	<link rel="icon" href="../images/icon.png">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/cooltipz-css/cooltipz.min.css'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
	<link rel='stylesheet' href='https://unpkg.com/aos@2.3.0/dist/aos.css'>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css" rel="stylesheet">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body class="d-flex flex-column min-vh-100" style="overflow-x: hidden;">
	<!-- NAVBAR 1 -->
	<nav class="navbar navbar-dark bg-dark text-light">
		<div class="container-fluid container-lg">
			<div class="mx-auto mx-md-0 me-md-auto">
				<span class="d-none d-md-inline">Wellcome to</span> <a href="../index.php" class="text-decoration-none pe-4 me-4 border-end">Unisopv-Store</a>
				<span class="d-none d-md-inline">Social Media:</span>
				<a class="btn btn-light btn-fb rounded-circle btn-lg-custom mx-1" href=""
				data-cooltipz-dir="bottom-left" aria-label="Facebook">
					<i class="fab fa-facebook-f"></i>
				</a>
				<a class="btn btn-light btn-wa rounded-circle btn-lg-custom me-1" href=""
				data-cooltipz-dir="bottom-left" aria-label="Whatsapp">
					<i class="fab fa-whatsapp"></i>
				</a>
				<a class="btn btn-light btn-ig rounded-circle btn-lg-custom" href=""
				data-cooltipz-dir="bottom-left" aria-label="Instagram">
					<i class="fab fa-instagram"></i>
				</a>
			</div>
			<div class="container-fluid container-lg border-top mt-2 bg-light d-flex d-md-none"></div>
			<div class="mx-auto mx-md-0 ms-md-auto mt-2 mt-md-0 col-12 col-md-auto px-3 px-md-0">
				<div class="row me-0 ">
					<a class="btn btn-outline-light col-auto ms-auto" href="register.php#register">Register</a>
				</div>
			</div>
		</div>
	</nav>
	<!-- NAVBAR 2 -->
	<nav class="navbar navbar-light bg-light text-dark">
		<div class="container-fluid container-lg">
			<a href="../index.php" class="w-50 mx-auto mx-md-0 d-block d-md-none" data-aos="fade-right"><img class="navbar-brand w-100" src="../images/eva-logo.png"></a>
			<a href="../index.php" class="w-25 mx-auto mx-md-0 d-none d-md-block" data-aos="fade-right"><img class="navbar-brand w-100" src="../images/eva-logo.png"></a>
			<form method="post" action="product.php#product" class="d-flex ms-auto col-12 col-md-5">
				<input type="search" class="form-control form-search form-control-lg rounded-0 rounded-start" placeholder="Search" name="s_keyword" value="">
				<button class="btn btn-lg btn-dark btn-dark-custom rounded-0 rounded-end" type="submit" name="search"><i class="fa-solid fa-magnifying-glass"></i></button>
			</form>
		</div>
	</nav>
	<!-- NAVBAR 3 -->
	<nav class="navbar navbar-expand-md navbar-light bg-danger text-dark fw-bold py-0 sticky-top mt-2 mt-md-0" style="font-family: serif;">
		<div class="container-fluid container-lg">
			<!-- NAVBAR 3 MD -->
			<div class="me-auto d-none d-md-block">
				<div class="nav-item dropdown">
					<a class="btn btn-danger active fw-bolder py-3 rounded-0 p-more" href="#" data-bs-toggle="dropdown">
						<i class="fa-solid fa-bars me-2"></i> ALL GUNDAM GRADES
					</a>
					<ul class="dropdown-menu bg-danger w-100 fade-down">
						<form method="post" action="product.php#product">
						<li class="d-grid gap-2">
							<input type="submit" name="s_filter_grade" value="[SD] Super Deformed" class="btn btn-danger fw-bolder text-start">
						</li>
						<li class="d-grid gap-2">
							<input type="submit" name="s_filter_grade" value="[HG] High Grade" class="btn btn-danger fw-bolder text-start">
						</li>
						<li class="d-grid gap-2">
							<input type="submit" name="s_filter_grade" value="[RG] Real Grade" class="btn btn-danger fw-bolder text-start">
						</li>
						<li class="d-grid gap-2">
							<input type="submit" name="s_filter_grade" value="[MG] Master Grade" class="btn btn-danger fw-bolder text-start">
						</li>
						<li class="d-grid gap-2">
							<input type="submit" name="s_filter_grade" value="[PG] Perfect Grade" class="btn btn-danger fw-bolder text-start">
						</li>
						</form>
					</ul>
				</div>
			</div>	
			<!-- NAVBAR 3 SM -->
			<div class="container-fluid container-lg row d-md-none">
				<button class="col-2 btn-nav-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<i class="fa-solid fa-bars fa-lg"></i>
				</button>
				<div class="nav-item dropdown d-grid gap-2 col-10 px-0">
					<a class="btn btn-danger active fw-bolder py-3 rounded-0 text-start" href="#" data-bs-toggle="dropdown">
						<i class="fa-solid fa-bars me-2"></i> ALL GUNDAM GRADES
					</a>
					<ul class="dropdown-menu bg-danger w-100 fade-down">
						<form method="post" action="product.php#product">
						<li class="d-grid gap-2">
							<input type="submit" name="s_filter_grade" value="[SD] Super Deformed" class="btn btn-danger fw-bolder text-start">
						</li>
						<li class="d-grid gap-2">
							<input type="submit" name="s_filter_grade" value="[HG] High Grade" class="btn btn-danger fw-bolder text-start">
						</li>
						<li class="d-grid gap-2">
							<input type="submit" name="s_filter_grade" value="[RG] Real Grade" class="btn btn-danger fw-bolder text-start">
						</li>
						<li class="d-grid gap-2">
							<input type="submit" name="s_filter_grade" value="[MG] Master Grade" class="btn btn-danger fw-bolder text-start">
						</li>
						<li class="d-grid gap-2">
							<input type="submit" name="s_filter_grade" value="[PG] Perfect Grade" class="btn btn-danger fw-bolder text-start">
						</li>
						</form>
					</ul>
				</div>
			</div>
			<!-- NAVBAR 3 COLLAPSE -->
			<div class="collapse navbar-collapse navbar-collapse-custom" id="navbarSupportedContent">
				<ul class="navbar-nav ms-auto">
					<li class="nav-item">
						<a class="btn btn-danger btn-danger-nav fw-bolder py-2 py-md-3 me-md-3 w-100 rounded-0" href="../index.php">HOME</a>
					</li>
					<li class="nav-item">
						<a class="btn btn-danger btn-danger-nav fw-bolder py-2 py-md-3 me-0 w-100 rounded-0" href="product.php">SHOP</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- HEADER -->
	<div class="bg-gra align-items-stretch d-none d-lg-flex" data-parallax="scroll" data-image-src="../images/banner2-img.jpg" data-aos="fade">
		<div class="container-fluid container-lg d-flex align-items-stretch position-relative">
			<div class="eva-font my-md-5 align-self-center text-center mx-auto" data-aos="fade-up" data-aos-delay="350">
				<h2 class="fw-bolder eva-heading_title mt-4"># &nbsp;&nbsp;UNISOPV-STORE&nbsp;&nbsp; #</h2>
				<h4 class="fw-bolder eva-heading_title mb-4">LOGIN</h4>
			</div>
		</div>
	</div >
	<div class="align-items-stretch d-flex d-lg-none" data-parallax="scroll" data-image-src="../images/banner2-img.jpg">
		<div class="bg-gra container-fluid container-lg d-flex align-items-stretch position-relative" data-aos="fade">
			<div class="eva-font my-md-5 align-self-center text-center mx-auto" data-aos="fade-up" data-aos-delay="350">
				<h2 class="fw-bolder eva-heading_title mt-4"># &nbsp;&nbsp;UNISOPV-STORE&nbsp;&nbsp; #</h2>
				<h4 class="fw-bolder eva-heading_title mb-4">LOGIN</h4>
			</div>
		</div>
	</div >
	<!-- LOGIN -->
	<div class="container-fluid container-lg mt-4 mt-md-5 pt-md-3 text-start text-secondary">
		<div class="anchor-stickynav" id="login"></div>
		<h4 class="border-bottom d-inline-block pb-md-2 border-secondary border-3 mb-4 mb-md-5 mt-2 mt-md-0 fw-bolder">
			Login
		</h4>
		<form method="POST" action="">
			<h4>
				Username <span class="text-danger">*</span>
				<div class="col-md-6 d-grid my-2 my-md-3">
					<div class="input-group input-group-lg">
						<input type="text" class="form-control rounded-0" name="username" placeholder="Username" required>
					</div>
				</div>
				Password <span class="text-danger">*</span>
				<div class="col-md-6 d-grid my-2 my-md-3">
					<div class="input-group input-group-lg">
						<input type="password" class="form-control rounded-0" name="password" placeholder="Password" required>
					</div>
				</div>
				<div class="col-md-2 d-grid mt-3 mt-md-4">
					<button class="btn btn-lg btn-dark btn-dark-custom rounded-0 fw-bolder" type="submit" name="submit-login">LOG IN</button>
				</div>
			</h4>
		</form>
		<div class="my-2"></div>
		<a href="register.php#register" class="btn-red">Don't have an account?</a>
	</div>
	<!-- FOOTER -->
	<footer class="mt-auto">
	<div class="container-fluid container-lg mt-4 mt-md-5 pt-md-3 text-center">
		<h4 class="text-center fw-bolder text-secondary p-0 m-0">
			Social Media
		</h4>
		<div class="h2 text-center fw-bolder text-secondary p-0 m-0">
			Contact Me @UNISOPV-STORE
		</div>
		<div class="line bg-secondary mx-auto mt-2 mt-md-3 mb-4 mb-md-5 pb-md-2" data-aos="fade-left"></div>
	</div>
	<div class="container-fluid bg-dark">
		<div class="container-fluid container-lg py-md-5">
			<div class="row">
				<div class="col-md-6 d-flex align-items-center flex-column justify-content-center">
					<div class="col-md-6 mx-auto" data-aos="fade-right">
						<img class="w-100" src="../images/eva-logo2.png"></a>
					</div>
					<div class="p-0 m-0 text-secondary">
						© <a href="../index.php" class="text-decoration-none">Unisopv-Store</a>. All Rights Reserved.
					</div>
				</div>
				<div class="col-md-6 d-flex align-items-center flex-column justify-content-center">
					<div class="mx-auto text-light">
						<table class="table table-borderless text-light h4 mb-0 align-middle">
							<tr>
								<td><i class="fa-solid fa-check text-danger"></i></td>
								<td>Instagram</td>
								<td>:</td>
								<td><a href="" class="btn btn-outline-light rounded-0"><i class="fa-brands fa-instagram-square fa-lg"></i></a></td>
							</tr>
							<tr>
								<td><i class="fa-solid fa-check text-danger"></i></td>
								<td>WhatsApp</td>
								<td>:</td>
								<td><a href="" class="btn btn-outline-light rounded-0"><i class="fa-brands fa-whatsapp-square fa-lg"></i></a></td>
							</tr>
							<tr>
								<td><i class="fa-solid fa-check text-danger"></i></td>
								<td>Facebook</td>
								<td>:</td>
								<td><a href="" class="btn btn-outline-light rounded-0"><i class="fa-brands fa-facebook-square fa-lg"></i></a></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	</footer>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="../js/parallax.js"></script>
	<script src='https://unpkg.com/aos@2.3.0/dist/aos.js'></script>
	<script>
		AOS.init({
			duration: 1000,
		})

		if ( window.history.replaceState ) {
			window.history.replaceState( null, null, window.location.href );
		}
	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php 
if (isset($_POST['submit-login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM akun WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if($row['status']=="1"){
            $_SESSION['username'] = $row['username'];
            $_SESSION['success-login'] = 'True';
            $_SESSION['status'] = $row['status'];
            $_SESSION['user'] = strlen($row['username']) > 12 ? substr($row['username'],0,12)."..." : $row['username'];
            echo '<script>window.location="../index.php"</script>';
        }else if($row['status']=="2"){
            $_SESSION['username'] = $row['username'];
            $_SESSION['success-login'] = 'True';
            $_SESSION['status'] = $row['status'];
            $_SESSION['user'] = strlen($row['username']) > 12 ? substr($row['username'],0,12)."..." : $row['username'];
            echo '<script>window.location="../index.php"</script>';
        }
    } else {
    	echo "<script>
    		window.location='#login'
			const Custom = Swal.mixin({
				position: 'top',
				timer: 3000,
				timerProgressBar: true,
				backdrop: false,
				keydownListenerCapture: true,
				didOpen: (toast) => {
					toast.addEventListener('mouseenter', Swal.stopTimer)
					toast.addEventListener('mouseleave', Swal.resumeTimer)
				}
			})
			Custom.fire({
			  	icon: 'error',
			  	title: 'Oops...',
			  	text: 'Incorrect username / password' 
			})
    	</script>";
    }
}
?>
<?php 
	if (isset($_SESSION['massage'])) {
		echo $_SESSION['massage'];
	}
	unset($_SESSION['massage']);
?>
</body>
</html>