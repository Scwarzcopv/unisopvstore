<?php 
	//Force move *jika terjadi error
	require_once 'process/error-handle.php';
	ob_start();
	//------------------------------

	include 'config/config.php';
	session_start();
?>
<!DOCTYPE html>
<html lang="en" >
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Home - UnisopvStore</title>
	<link rel="icon" href="images/icon.png">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/cooltipz-css/cooltipz.min.css'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
	<link rel='stylesheet' href='https://unpkg.com/aos@2.3.0/dist/aos.css'>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/imagehover.css/2.0.0/css/imagehover.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>   
	<link rel="stylesheet" href="https://unpkg.com/dropzone/dist/dropzone.css" />
	<link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>
	<script src="https://unpkg.com/dropzone"></script>
	<script src="https://unpkg.com/cropperjs"></script>
	<link rel="stylesheet" href="css/style.css">
</head>
<body class="d-flex flex-column min-vh-100" style="overflow-x: hidden;">
	<!-- NAVBAR 1 -->
	<nav class="navbar navbar-dark bg-dark text-light ">
		<div class="container-fluid container-lg">
			<div class="mx-auto mx-md-0 me-md-auto">
				<span class="d-none d-md-inline">Wellcome to</span> <a href="#" class="text-decoration-none pe-4 me-4 border-end">Unisopv-Store</a>
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
				<?php if (!isset($_SESSION['username'])) { ?>
				<div class="row me-0">
					<a class="btn btn-outline-light col-auto ms-auto me-2" href="pages/login.php#login">Login</a>
					<a class="btn btn-outline-light col-auto" href="pages/register.php#register">Register</a>
				</div>
				<?php ;} else { ?>
				<div class="row">
					<!-- IMAGE USER / USER IMAGE -->
					<form method="post" class="col-auto d-flex align-items-center flex-column px-0">
						<figure class="me-auto imghvr-fade rounded-circle bg-transparent my-auto">
							<label for="upload_image">
								<img src="<?php 
							if (isset($_SESSION['username'])) {
								$username = $_SESSION['username'];
								$status = $_SESSION['status'];
								$sql = "SELECT * FROM akun WHERE username='$username' AND status='$status'";
								$result = mysqli_query($conn, $sql);
								$row = mysqli_fetch_assoc($result);
								$img_user = $row['images'];
								if ($img_user != "") {
									echo "images/img-user/".$img_user;
								}
								else echo "images/user.jpg";
							}
								?>" class="hw-user rounded-circle mw-100" />
								<figcaption class="p-0" style="cursor: pointer;">
									<input type="file" name="image" class="image d-none" id="upload_image" accept=".png, .jpg, .jpeg">
									<img src="<?php 
							if (isset($_SESSION['username'])) {
								$username = $_SESSION['username'];
								$status = $_SESSION['status'];
								$sql = "SELECT * FROM akun WHERE username='$username' AND status='$status'";
								$result = mysqli_query($conn, $sql);
								$row = mysqli_fetch_assoc($result);
								$img_user = $row['images'];
								if ($img_user != "") {
									echo "images/img-user/".$img_user;
								}
								else echo "images/user.jpg";
							}
									?>" class="hw-user rounded-circle mw-100">
								</figcaption>
							</label>
						</figure>
		    		</form>
					<!-- MODAL -->
					<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
					  	<div class="modal-dialog modal-lg" role="document">
					    	<div class="modal-content">
					      		<div class="modal-header">
					        		<h5 class="modal-title text-dark" id="modalLabel">Please crop the image</h5>
					        		<button type="button" class="btn-close" data-bs-dismiss="modal">
					        		</button>
					      		</div>
					      		<div class="modal-body">
					        		<div class="img-container">
					            		<div class="row">
					                		<div class="col-md-8">
					                    		<img src="" id="sample_image" class=" h-100 w-100" />
					                		</div>
					                		<div class="col-md-4 d-flex align-items-center flex-column">
					                    		<div class="preview rounded-circle"></div>
					                		</div>
					            		</div>
					        		</div>
					      		</div>
					      		<div class="modal-footer">
					        		<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
					        		<button type="button" class="btn btn-primary" id="crop">Crop</button>
					      		</div>
					    	</div>
					  	</div>
					</div>
					<!-- END MODAL -->	
					<div class="me-auto col-auto d-flex align-items-center flex-column ps-2 pe-2">
						<a href="#" class="my-auto text-decoration-none btn-simple-light" data-cooltipz-dir="bottom-left" aria-label="Change password"><?php echo $_SESSION['user']; ?></a>
					</div>
					<div class="col-auto d-flex align-items-center flex-column pe-0">
						<a class="btn btn-outline-light my-auto" href="process/logout.php">Log Out</a>
					</div>
				</div>
				<?php ;} ?>
			</div>
<?php  
if (isset($_SESSION['username'])) {
	$username = $_SESSION['username'];
	//db_cart
	$sql = "SELECT * FROM cart WHERE username LIKE ?";
	$search = $conn->prepare($sql);
	$search->bind_param('s', $username);
	$search->execute();
	$res_cart = $search->get_result();
	$total_item_cart = mysqli_num_rows($res_cart);
	if ($total_item_cart > 9) {
		$total_item_cart = "9+";
	}
	//db_wishlist
	$sql = "SELECT * FROM wishlist WHERE username LIKE ?";
	$search = $conn->prepare($sql);
	$search->bind_param('s', $username);
	$search->execute();
	$res_wishlist = $search->get_result();
	$total_item_wishlist = mysqli_num_rows($res_wishlist);
	if ($total_item_wishlist > 9) {
		$total_item_wishlist = "9+";
	}
}
else {
	$total_item_cart = 0;
	$total_item_wishlist = 0;
}
?>
			<!-- NAVBAR 2.1 SM -->
			<!-- 
			<div class="d-flex ms-auto d-none d-md-none pt-3 me-3">
				-- show wishlist --
				<a class="btn btn-cart btn-dark btn-dark-custom rounded-circle pt-2 me-4" href="wishlist.php">
					<i class="d-none" id="show_wishlist_primary" value="<?php echo intval($total_item_wishlist); ?>"></i>
					<i class="fa-solid fa-heart badge-cart" id="show_wishlist" value="<?php echo intval($total_item_wishlist); ?>"></i>
				</a>
				-- show cart --
				<a class="btn btn-cart btn-dark btn-dark-custom rounded-circle pt-2" href="">
					<i class="d-none" id="show_cart_primary" value="<?php echo intval($total_item_cart); ?>"></i>
					<i class="fa-solid fa-cart-shopping badge-cart" id="show_cart" value="<?php echo intval($total_item_cart); ?>"></i>
				</a>
			</div>
			-->
		</div>
	</nav>
	<!-- NAVBAR 2 -->
	<nav class="navbar navbar-light bg-light text-dark">
		<div class="container-fluid container-lg">
			<a href="" class="w-50 mx-auto mx-md-0 d-block d-md-none" data-aos="fade-right"><img class="navbar-brand w-100" src="images/eva-logo.png"></a>
			<a href="" class="w-25 mx-auto mx-md-0 d-none d-md-block" data-aos="fade-right"><img class="navbar-brand w-100" src="images/eva-logo.png"></a>
			<!-- Filter 1 -->
			<form class="d-none d-md-flex mx-auto col-12 col-md-5" action="pages/product.php#product" method="post">
				<input type="search" class="form-control form-search form-control-lg rounded-0 rounded-start" placeholder="Search" name="s_keyword" value="">
				<button class="btn btn-lg btn-dark btn-dark-custom rounded-0 rounded-end" type="submit" name="search"><i class="fa-solid fa-magnifying-glass"></i></button>
			</form>
			<!-- NAVBAR 2.2 MD -->
			<div class="d-flex ms-auto">
				<!-- show wishlist -->
				<a class="btn btn-cart btn-dark btn-dark-custom rounded-circle pt-2 me-4" href="pages/wishlist.php">
					<i class="d-none" id="show_wishlist_primary" value="<?php echo intval($total_item_wishlist); ?>"></i>
					<i class="fa-solid fa-heart badge-cart" id="show_wishlist" value="<?php echo intval($total_item_wishlist); ?>"></i>
				</a>
				<!-- show cart -->
				<a class="btn btn-cart btn-dark btn-dark-custom rounded-circle pt-2" href="pages/cart.php">
					<i class="d-none" id="show_cart_primary" value="<?php echo intval($total_item_cart); ?>"></i>
					<i class="fa-solid fa-cart-shopping badge-cart" id="show_cart" value="<?php echo intval($total_item_cart); ?>"></i>
				</a>
			</div>
			<!-- Filter 1 -->
			<form class="d-flex d-md-none mx-auto col-12 mb-2" action="pages/product.php#product" method="post">
				<input type="search" class="form-control form-search form-control-lg rounded-0 rounded-start" placeholder="Search" name="s_keyword" value="">
				<button class="btn btn-lg btn-dark btn-dark-custom rounded-0 rounded-end" type="submit" name="search"><i class="fa-solid fa-magnifying-glass"></i></button>
			</form>
		</div>
	</nav>
	<!-- NAVBAR 3 -->
	<nav class="navbar navbar-expand-md navbar-light bg-danger text-dark fw-bold py-0 sticky-top" style="font-family: serif;">
		<div class="container-fluid container-lg">
			<!-- NAVBAR 3 MD -->
			<div class="me-auto d-none d-md-block">
				<div class="nav-item dropdown">
					<a class="btn btn-danger active fw-bolder py-3 rounded-0 p-more" href="#" data-bs-toggle="dropdown">
						<i class="fa-solid fa-bars me-2"></i> ALL GUNDAM GRADES
					</a>
					<ul class="dropdown-menu bg-danger w-100 fade-down">
						<!-- Filter 2-md -->
						<form method="post" action="pages/product.php#product">
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
						<!-- Filter 2-sm -->
						<form method="post" action="pages/product.php#product">
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
						<a class="btn btn-danger btn-danger-nav fw-bolder py-2 py-md-3 me-md-3 text-light w-100 rounded-0" href="">HOME</a>
					</li>
					<li class="nav-item">
						<a class="btn btn-danger btn-danger-nav fw-bolder py-2 py-md-3 me-0 w-100 rounded-0" href="pages/product.php">SHOP</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- HEADER -->
	<div class="parallax-window bg-gra align-items-stretch d-none d-lg-flex" data-parallax="scroll" data-image-src="images/banner-img.jpg" data-aos="fade">
		<div class="container-fluid container-lg d-flex align-items-stretch position-relative">
			<div class="eva-font my-0 align-self-center" data-aos="fade-up" data-aos-delay="350">
				<h1 class="fw-bolder eva-heading_title p-0 m-0">UNISOPV-STORE</h1>
				<h2 class="fw-bolder eva-heading_title p-0 mb-0 mt-2 mt-md-4">Shop with us</h2>
				<h3 class="fw-bolder eva-heading_title p-0 mb-2 mb-md-4 mt-0">Find products with original quality, and get the best prices</h3>
				<a href="pages/product.php" class="btn btn-lg btn-outline-light fw-bolder mt-2 rounded-0">SHOP NOW <i class="fa-solid fa-angles-right"></i></h3></a>
			</div>
		</div>
	</div>
	<div class="align-items-stretch d-flex d-lg-none" data-parallax="scroll" data-image-src="images/banner-img.jpg">
		<div class="parallax-window bg-gra container-fluid container-lg d-flex align-items-stretch position-relative" data-aos="fade">
			<div class="eva-font my-0 align-self-center" data-aos="fade-up" data-aos-delay="350">
				<h1 class="fw-bolder eva-heading_title p-0 m-0">UNISOPV-STORE</h1>
				<h2 class="fw-bolder eva-heading_title p-0 mb-0 mt-2 mt-md-4">Shop with us</h2>
				<h3 class="fw-bolder eva-heading_title p-0 mb-2 mb-md-4 mt-0">Find products with original quality, and get the best prices</h3>
				<a href="pages/product.php" class="btn btn-lg btn-outline-light fw-bolder mt-2 rounded-0">SHOP NOW <i class="fa-solid fa-angles-right"></i></h3></a>
			</div>
		</div>
	</div>
	<!-- PRODUCT -->
	<div class="container-fluid container-lg mt-4 mt-md-5 pt-md-3 text-center">
		<div class="anchor-stickynav" id="product"></div>
		<h4 class="text-center fw-bolder text-secondary p-0 m-0">
			New Product
		</h4>
		<div class="h2 text-center fw-bolder text-secondary p-0 m-0">
			LATEST UPDATE @UNISOPV-STORE
		</div>
		<div class="line bg-secondary mx-auto mt-2 mt-md-3 mb-4 mb-md-5 pb-md-2" data-aos="fade-left"></div>
		<div class="row">
<?php 
	$now = 0;
	$limit = 8;
	$data = mysqli_query($conn,"SELECT * FROM produk ORDER BY id_produk DESC");
	while($row = mysqli_fetch_array($data)){
?>
			<div class="col-6 col-sm-6 col-md-4 col-lg-3 px-vs-1 px-vmd-2 mb-4 mb-sm-3 mb-lg-4 bg-white">
				<div class="anchor-stickynav" id="<?php echo $row['id_produk']; ?>"></div>
				<div class="col-12 rounded product-shadow pb-md-2 zoom h-100 d-flex align-items-center flex-column">
					<figure class="imghvr-fade mb-md-2 rounded-top bg-transparent">
						<img src="images/product/<?php echo $row['img_produk']; ?>" class="w-100 pb-md-2 bg-primary">
							<figcaption class="p-0 m-0 bg-danger">
								<img src="images/product-hover/<?php echo $row['img_produk-hover']; ?>" class="w-100">
							</figcaption>
					</figure>
					<div class="h5 text-secondary fw-bolder px-md-2"><?php echo $row['grade_produk']; ?></div>
					<a href="#" class="btn h5 text-dark btn-item px-md-2"><?php echo $row['nama_produk']; ?></a>
					<div class="mt-auto w-100">
						<div class="h4 text-danger fw-bolder pt-md-2 px-md-2">Rp <?php echo number_format($row['harga_produk'] , 0, ',', '.'); ?>,00</div>
						<div class="row px-2 px-md-3 pb-2">
<?php 
$btn_wishlist = "btn-outline-dark";
$btn_wishlist_fa = "<i class='fa-solid fa-heart-circle-plus fa-lg' id='btn_wishlist_fa".$row['id_produk']."'></i>";
if (isset($_SESSION['username'])) {
	$username = $_SESSION['username'];
	$id_produk = $row['id_produk'];
	$sql = "SELECT * FROM wishlist";
	$result = mysqli_query($conn,$sql);
	while($row_wishlist = mysqli_fetch_array($result)){
		if ($row_wishlist['username'] == $username && $row_wishlist['id_produk'] == $id_produk) {
			$btn_wishlist = "btn-outline-danger";
			$btn_wishlist_fa = "<i class='fa-solid fa-heart fa-lg' id='btn_wishlist_fa".$row['id_produk']."'></i>";
		}
	}
}
?>	
							<!-- add to wishlist -->
							<div class="col-6 pe-vs-1">
								<div class="d-grid gap-2"><button class="wishbutton btn rounded-0 fw-bolder border-2 <?php echo $btn_wishlist; ?>" id="btn_wishlist<?php echo $row['id_produk']; ?>" onclick="add_wishlist('<?php echo $row['id_produk']?>')"><?php echo $btn_wishlist_fa ?></button></div>
							</div>
<?php 
$btn_cart = "btn-outline-dark";
$btn_cart_fa = "<i class='fa-solid fa-cart-plus fa-lg' id='btn_cart_fa".$row['id_produk']."'></i>";
if (isset($_SESSION['username'])) {
	$username = $_SESSION['username'];
	$id_produk = $row['id_produk'];
	$sql = "SELECT * FROM cart";
	$result = mysqli_query($conn,$sql);
	while($row_cart = mysqli_fetch_array($result)){
		if ($row_cart['username'] == $username && $row_cart['id_produk'] == $id_produk) {
			$btn_cart = "btn-success";
			$btn_cart_fa = "<i class='fa-solid fa-circle-check fa-lg' id='btn_cart_fa".$row['id_produk']."'></i>";
		}
	}
}
?>
							<!-- add to cart -->
							<div class="col-6 ps-vs-1">
								<div class="d-grid gap-2"><button class="btn rounded-0 fw-bolder border-2 <?php echo $btn_cart; ?>" id="btn_cart<?php echo $row['id_produk']; ?>" onclick="add_cart('<?php echo $row['id_produk']?>')"><?php echo $btn_cart_fa ?></button></div>
							</div>
						</div>
					</div>
				</div>
			</div>
<?php 
		$now++;
		if ($now == $limit) {
			break;
		}
	}
?>
		</div>

		<a href="pages/product.php#product" class="btn btn-lg btn-outline-dark fw-bolder mt-md-3 rounded-0" data-aos="fade-right">Show More <i class="fa-solid fa-angles-right"></i></a>
	</div>
	<!-- FOOTER -->
	<footer class="mt-auto">
	<div class="container-fluid container-lg mt-3 mt-md-5 pt-md-3 text-center">
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
						<img class="w-100" src="images/eva-logo2.png"></a>
					</div>
					<div class="p-0 m-0 text-secondary">
						© <a href="#" class="text-decoration-none">Unisopv-Store</a>. All Rights Reserved.
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
	<script src="js/parallax.js"></script>
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
    if (isset($_SESSION['success-login'])) {
    	echo "<script>
			const Custom2 = Swal.mixin({
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
			Custom2.fire({
			  	icon: 'success',
			  	title : 'Wellcome, ".$_SESSION['user']."!',
			})
    	</script>";
    }
    unset($_SESSION['success-login']);
    ?>
	<script>
	$(document).ready(function(){
		var $modal = $('#modal');
		var image = document.getElementById('sample_image');
		var cropper;
		$('#upload_image').change(function(event){
	    	var files = event.target.files;
	    	var done = function (url) {
	      		image.src = url;
	      		$modal.modal({backdrop: 'static', keyboard: false});
	      		$modal.modal('show');
	    	};
	    	if (files && files.length > 0)
	    	{
	    		reader = new FileReader();
		        reader.onload = function (event) {
		          	done(reader.result);
		        };
	    		reader.readAsDataURL(files[0]);
	    	}
		});

		$modal.on('shown.bs.modal', function() {
	    	cropper = new Cropper(image, {
	    		aspectRatio: 1,
	    		viewMode: 3,
	    		preview: '.preview'
	    	});
		}).on('hidden.bs.modal', function() {
	   		cropper.destroy();
	   		cropper = null;
		});

		$("#crop").click(function(){
	    	canvas = cropper.getCroppedCanvas({
	      		width: 400,
	      		height: 400,
	    	});

	    	canvas.toBlob(function(blob) {
	        	var reader = new FileReader();
	         	reader.readAsDataURL(blob); 
	         	reader.onloadend = function() {
	            	var base64data = reader.result;  
	            
	            	$.ajax({
	            		url: "process/upload-pp.php",
	                	method: "POST",
	                	data: {image: base64data},
	                	success: function(data){
	                    	console.log(data);
	                    	$modal.modal('hide');
							const Custom2 = Swal.mixin({
								timer: 3000,
								timerProgressBar: true,
								keydownListenerCapture: true,
								didOpen: (toast) => {
									toast.addEventListener('mouseenter', Swal.stopTimer)
									toast.addEventListener('mouseleave', Swal.resumeTimer)
								}
							})
							Custom2.fire({
							  	icon: 'success',
							  	title: 'Profile photo successfully changed',
							}).then(function() {
					    		window.location = 'index.php';
							});
	                	}
	              	});
	         	}
	    	});
	    });
		
	});
	</script>
	<script>
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
		var max_num = 9;
<?php if (isset($_SESSION['username'])) { ?> 
		function add_cart(id){
			jQuery.ajax({
				url:'process/add_to-cart.php',
				type:'POST',
				data:'id='+id,
				success:function(result){
					btn_cart = 'btn-outline-dark';
					btn_cart_fa = 'fa-solid fa-cart-plus fa-lg';

					btn_cart2 = 'btn-success';
					btn_cart_fa2 = 'fa-solid fa-circle-check fa-lg';

					var count_cart = parseInt($("#show_cart_primary").attr('value'));

				    if ($("#btn_cart"+id).hasClass(btn_cart)) {
						$("#btn_cart"+id).removeClass(btn_cart).addClass(btn_cart2);
						$("#btn_cart_fa"+id).removeClass(btn_cart_fa).addClass(btn_cart_fa2);
						//showcart
						$("#show_cart_primary").attr("value",count_cart+1);
						var count_cart = parseInt($("#show_cart_primary").attr('value'));
						if (count_cart <= max_num) {
							cart = count_cart;
						}
						else {
							cart = "9+";
						}
						//sweetalert
						$("#show_cart").attr("value",cart);
						Custom.fire({
						  	icon: 'success',
						  	title : 'Successfully added to cart',
						})
			    	}
			    	else {
						$("#btn_cart"+id).removeClass(btn_cart2).addClass(btn_cart);
						$("#btn_cart_fa"+id).removeClass(btn_cart_fa2).addClass(btn_cart_fa);
						//showcart
						$("#show_cart_primary").attr("value",count_cart-1);
						var count_cart = parseInt($("#show_cart_primary").attr('value'));
						if (count_cart <= max_num) {
							cart = count_cart;
						}
						else {
							cart = "9+";
						}						
						$("#show_cart").attr("value",cart);
						//sweetalert
						Custom.fire({
						  	icon: 'success',
						  	title : 'Successfully removed from cart',
						})
			    	}
				},
				error:function(result){
					Custom.fire({
					  	icon: 'error',
					  	title : 'Failed to connect dbs',
					});
				}
			});
        };
        function add_wishlist(id){
			jQuery.ajax({
				url:'process/add_to-wishlist.php',
				type:'POST',
				data:'id='+id,
				success:function(result){
					btn_wishlist = 'btn-outline-dark';
					btn_wishlist_fa = 'fa-solid fa-heart-circle-plus fa-lg';

					btn_wishlist2 = 'btn-outline-danger';
					btn_wishlist_fa2 = 'fa-solid fa-heart fa-lg';

					var count_wishlist = parseInt($("#show_wishlist_primary").attr('value'));

				    if ($("#btn_wishlist"+id).hasClass(btn_wishlist)) {
						$("#btn_wishlist"+id).removeClass(btn_wishlist).addClass(btn_wishlist2);
						$("#btn_wishlist_fa"+id).removeClass(btn_wishlist_fa).addClass(btn_wishlist_fa2);
						//showishlist
						$("#show_wishlist_primary").attr("value",count_wishlist+1);
						var count_wishlist = parseInt($("#show_wishlist_primary").attr('value'));
						if (count_wishlist <= max_num) {
							wishlist = count_wishlist;
						}
						else {
							wishlist = "9+";
						}						
						$("#show_wishlist").attr("value",wishlist);
						//sweetalert
						Custom.fire({
						  	icon: 'success',
						  	title : 'Successfully added to wishlist',
						})
			    	}
			    	else {
						$("#btn_wishlist"+id).removeClass(btn_wishlist2).addClass(btn_wishlist);
						$("#btn_wishlist_fa"+id).removeClass(btn_wishlist_fa2).addClass(btn_wishlist_fa);
						//showishlist
						$("#show_wishlist_primary").attr("value",count_wishlist-1);
						var count_wishlist = parseInt($("#show_wishlist_primary").attr('value'));
						if (count_wishlist <= max_num) {
							wishlist = count_wishlist;
						}
						else {
							wishlist = "9+";
						}						
						$("#show_wishlist").attr("value",wishlist);
						//sweetalert
						Custom.fire({
						  	icon: 'success',
						  	title : 'Successfully removed from wishlist',
						})
			    	}
				},
				error:function(result){
					Custom.fire({
					  	icon: 'error',
					  	title : 'Failed to connect dbs',
					});
				}
			});
        };
<?php 
} 
else {
?>
		function add_wishlist(id) {
			window.location="process/login-required.php";
		}
		function add_cart(id) {
			window.location="process/login-required.php";
		}
<?php } ?>
	 </script>
</body>
</html>
<?php ob_end_flush();?>