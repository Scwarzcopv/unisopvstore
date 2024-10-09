<?php 
//Force move *jika terjadi error
require_once '../process/error-handle.php';
ob_start();
//------------------------------

include '../config/config.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en" >
<head>
	<meta charset="UTF-8">
	<title>Shop - UnisopvStore</title>
	<link rel="icon" href="../images/icon.png">
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
	<link rel="stylesheet" href="../css/style.css">
</head>
<body style="overflow-x: hidden;">
	<!-- NAVBAR 1 -->
	<nav class="navbar navbar-dark bg-dark text-light">
		<div class="container">
			<div class="mx-auto mx-md-0 me-md-auto">
				Wellcome to <a href="../index.php" class="text-decoration-none pe-4 me-4 border-end">Unisopv-Store</a>
				Social Media:
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
			<div class="me-auto me-md-0 ms-md-auto">
				<?php if (!isset($_SESSION['username'])) { ?>
				<a class="btn btn-outline-light" href="login.php#login">Login</a>
				<a class="btn btn-outline-light" href="register.php#register">Register</a>
				<?php ;} else { ?>
				<div class="row">
					<!-- IMAGE USER / USER IMAGE -->
					<form method="post" class="col-auto d-flex align-items-center flex-column pe-0">
						<figure class="imghvr-fade rounded-circle bg-transparent my-auto">
							<label for="upload_image">
							<img src="<?php 
							if ($_SESSION['img-user'] != "") {
								echo "../images/img-user/".$_SESSION['img-user'];
							}
							else echo "../images/user.jpg";
							?>" class="hw-user rounded-circle mw-100" />
								<figcaption class="p-0" style="cursor: pointer;">
									<input type="file" name="image" class="image d-none" id="upload_image" accept=".png, .jpg, .jpeg">
									<img src="<?php 
							if ($_SESSION['img-user'] != "") {
								echo "../images/img-user/".$_SESSION['img-user'];
							}
							else echo "../images/user.jpg";
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
					                    		<img src="" id="sample_image" class=" d-block mw-100" />
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
					<div class="col-auto d-flex align-items-center flex-column ps-2 pe-2">
						<a href="#" class="my-auto text-decoration-none btn-simple-light" data-cooltipz-dir="bottom-left" aria-label="Change password"><?php echo $_SESSION['user']; ?></a>
					</div>
					<div class="col-auto d-flex align-items-center flex-column pe-0">
						<a class="btn btn-outline-light my-auto" href="../process/logout.php">Log Out</a>
					</div>
				</div>
				<?php ;} ?>
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
			<div class="d-flex ms-auto d-block d-md-none pt-3 me-3">
				<!-- show wishlist -->
				<a class="btn btn-cart btn-dark btn-dark-custom rounded-circle pt-2 me-2" href="">
					<i class="fa-solid fa-heart badge-cart" value=<?php echo $total_item_wishlist; ?>></i>
				</a>
				<!-- show cart -->
				<a class="btn btn-cart btn-dark btn-dark-custom rounded-circle pt-2" href="">
					<i class="fa-solid fa-cart-shopping badge-cart" value=<?php echo $total_item_cart; ?>></i>
				</a>
			</div>
		</div>
	</nav>
	<!-- NAVBAR 2 -->
	<nav class="navbar navbar-light bg-light text-dark">
		<div class="container">
			<a href="../index.php" class="w-50 mx-auto mx-md-0 d-block d-md-none" data-aos="fade-right"><img class="navbar-brand w-100" src="../images/eva-logo.png"></a>
			<a href="../index.php" class="w-25 mx-auto mx-md-0 d-none d-md-block" data-aos="fade-right"><img class="navbar-brand w-100" src="../images/eva-logo.png"></a>
<?php 
    if (!isset($_SESSION['s_key'])) {
    	$_SESSION['s_key'] = "";
    }
    if (!isset($_SESSION['s_fg'])) {
    	$_SESSION['s_fg'] = "";
    }
    if (!isset($_SESSION['s_fg_all'])) {
    	$_SESSION['s_fg_all'] = "";
    }
    
    //Search by Keyword
    if (isset($_POST['search'])) {
        $_SESSION['s_key'] = $_POST['s_keyword'];
    }
    //Search by Grade
    if (isset($_POST['s_filter_grade'])) {
    	if ($_POST['s_filter_grade'] != "ALL GRADES") {
    		$_SESSION['s_fg'] = $_POST['s_filter_grade'];
    		$_SESSION['s_fg_all'] = "False";
    	}
    	else { 
    		$_SESSION['s_fg'] = "";
    		$_SESSION['s_fg_all'] = "True"; 
    	}
    }
?>
			<!-- Filter 1 -->
			<form class="d-flex mx-auto col-12 col-md-5" action="#wishlist" method="post">
				<input type="search" class="form-control form-search form-control-lg rounded-0 rounded-start" placeholder="Search" name="s_keyword" value="<?php echo $_SESSION['s_key']; ?>"/>
				<button class="btn btn-lg btn-dark btn-dark-custom rounded-0 rounded-end" type="submit" name="search"><i class="fa-solid fa-magnifying-glass"></i></button>
			</form>
			<!-- NAVBAR 2.2 MD -->
			<div class="d-flex ms-auto d-none d-md-block">
				<!-- show wishlist -->
				<a class="btn btn-cart btn-dark btn-dark-custom rounded-circle pt-2 me-4" href="">
					<i class="fa-solid fa-heart badge-cart" value=<?php echo $total_item_wishlist; ?>></i>
				</a>
				<!-- show cart-->
				<a class="btn btn-cart btn-dark btn-dark-custom rounded-circle pt-2" href="">
					<i class="fa-solid fa-cart-shopping badge-cart" value=<?php echo $total_item_cart; ?>></i>
				</a>
			</div>
		</div>
	</nav>
	<!-- NAVBAR 3 -->
	<nav class="navbar navbar-expand-lg navbar-light bg-danger text-dark fw-bold py-0 sticky-top" style="font-family: serif;">
		<div class="container">
			<!-- NAVBAR 3 MD -->
			<div class="me-auto d-none d-md-block">
				<div class="nav-item dropdown">
					<a class="btn btn-danger active fw-bolder py-3 rounded-0 p-more" href="#" data-bs-toggle="dropdown">
						<i class="fa-solid fa-bars me-2"></i> ALL GUNDAM GRADES
					</a>
					<ul class="dropdown-menu bg-danger w-100 fade-down">
						<!-- Filter 2-md -->
						<form method="post" action="#wishlist">
						<li class="d-grid gap-2">
							<input type="submit" name="s_filter_grade" value="ALL GRADES" class="btn btn-danger fw-bolder text-start <?php if ($_SESSION['s_fg_all']=="True"){ echo "d-none"; } ?>">
						</li>
						<li class="d-grid gap-2">
							<input type="submit" name="s_filter_grade" value="[SD] Super Deformed" class="btn btn-danger fw-bolder text-start <?php if ($_SESSION['s_fg']=="[SD] Super Deformed"){ echo "active"; } ?>">
						</li>
						<li class="d-grid gap-2">
							<input type="submit" name="s_filter_grade" value="[HG] High Grade" class="btn btn-danger fw-bolder text-start <?php if ($_SESSION['s_fg']=="[HG] High Grade"){ echo "active"; } ?>">
						</li>
						<li class="d-grid gap-2">
							<input type="submit" name="s_filter_grade" value="[RG] Real Grade" class="btn btn-danger fw-bolder text-start <?php if ($_SESSION['s_fg']=="[RG] Real Grade"){ echo "active"; } ?>">
						</li>
						<li class="d-grid gap-2">
							<input type="submit" name="s_filter_grade" value="[MG] Master Grade" class="btn btn-danger fw-bolder text-start <?php if ($_SESSION['s_fg']=="[MG] Master Grade"){ echo "active"; } ?>">
						</li>
						<li class="d-grid gap-2">
							<input type="submit" name="s_filter_grade" value="[PG] Perfect Grade" class="btn btn-danger fw-bolder text-start <?php if ($_SESSION['s_fg']=="[PG] Perfect Grade"){ echo "active"; } ?>">
						</li>
						</form>
					</ul>
				</div>
			</div>	
			<!-- NAVBAR 3 SM -->
			<div class="container row d-md-none">
				<button class="col-2 btn-nav-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<i class="fa-solid fa-bars fa-lg"></i>
				</button>
				<div class="nav-item dropdown d-grid gap-2 col-10 px-0">
					<a class="btn btn-danger active fw-bolder py-3 rounded-0 text-start" href="#" data-bs-toggle="dropdown">
						<i class="fa-solid fa-bars me-2"></i> ALL GUNDAM GRADES
					</a>
					<ul class="dropdown-menu bg-danger w-100 fade-down">
						<!-- Filter 2-sm -->
						<form method="post" action="#wishlist">
						<li class="d-grid gap-2">
							<input type="submit" name="s_filter_grade" value="[SD] Super Deformed" class="btn btn-danger fw-bolder text-start <?php if ($s_fg=="[SD] Super Deformed"){ echo "active"; } ?>">
						</li>
						<li class="d-grid gap-2">
							<input type="submit" name="s_filter_grade" value="[HG] High Grade" class="btn btn-danger fw-bolder text-start <?php if ($s_fg=="[HG] High Grade"){ echo "active"; } ?>">
						</li>
						<li class="d-grid gap-2">
							<input type="submit" name="s_filter_grade" value="[RG] Real Grade" class="btn btn-danger fw-bolder text-start <?php if ($s_fg=="[RG] Real Grade"){ echo "active"; } ?>">
						</li>
						<li class="d-grid gap-2">
							<input type="submit" name="s_filter_grade" value="[MG] Master Grade" class="btn btn-danger fw-bolder text-start <?php if ($s_fg=="[MG] Master Grade"){ echo "active"; } ?>">
						</li>
						<li class="d-grid gap-2">
							<input type="submit" name="s_filter_grade" value="[PG] Perfect Grade" class="btn btn-danger fw-bolder text-start <?php if ($s_fg=="[PG] Perfect Grade"){ echo "active"; } ?>">
						</li>
						</form>
					</ul>
				</div>
			</div>
			<!-- NAVBAR 3 COLLAPSE -->
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ms-auto">
					<li class="nav-item">
						<a class="btn btn-danger-nav fw-bolder py-2 py-md-3 me-md-3" href="../index.php">HOME</a>
					</li>
					<li class="nav-item">
						<a class="btn btn-danger-nav fw-bolder py-2 py-md-3 pe-0 me-0" href="product.php">SHOP</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- HEADER -->
	<div class=" bg-gra d-flex align-items-stretch" data-parallax="scroll" data-image-src="../images/banner2-img.jpg" data-aos="fade">
		<div class="container d-flex align-items-stretch position-relative">
			<div class="eva-font my-md-5 align-self-center text-center mx-auto" data-aos="fade-up" data-aos-delay="350">
				<h2 class="fw-bolder eva-heading_title mt-4"># &nbsp;&nbsp;UNISOPV-STORE&nbsp;&nbsp; #</h2>
				<h4 class="fw-bolder eva-heading_title mb-4">WISHLIST</h4>
			</div>
		</div>
	</div >
	<!-- WISHLIST -->
	<div class="container mt-md-5 pt-md-3 text-center">
		<div class="anchor-stickynav" id="wishlist"></div>
		<div style="clear:both;" class="float-end h4 text-start fw-bolder text-secondary p-0 m-0">
			<div class="nav-item dropdown btn-w-sort">
				<div class="btn-w-sort d-grid">
				<a class="btn btn-outline-danger fw-bold rounded-0 text-start d-flex align-items-center" href="#" data-bs-toggle="dropdown">
<?php  
    if (!isset($_SESSION['sort'])) {
    	$_SESSION['sort_val'] = "Sort by latest";
    	$_SESSION['sort'] = "DESC";
    	$_SESSION['short_orderby'] = "id_produk";
    }
    //Search by sort
    if (isset($_POST['sortby'])) {
    	if ($_POST['sortby'] == "Sort by latest" || $_POST['sortby'] == "Sort by oldest") {
			$_SESSION['sort_val'] = $_POST['sortby'];
			$_SESSION['short_orderby'] = "id_produk";    		
    	}
    	else {
			$_SESSION['sort_val'] = $_POST['sortby'];
			$_SESSION['short_orderby'] = "harga_produk";
    	}
    }
    //Initial
    if ($_SESSION['sort_val'] == "Sort by latest" || $_SESSION['sort_val'] == "Sort by price: high to low") {
    	$_SESSION['sort'] = "DESC";
    } 
    else $_SESSION['sort'] = "ASC";

?>
					<?php echo $_SESSION['sort_val']; ?>
                    <span class="right-icon ms-auto">
                        <i class="fa-solid fa-chevron-down"></i>
                    </span>
				</a>
				</div>
				<ul class="dropdown-menu bg-danger w-100 fade-down rounded-0">
					<!-- Filter 3 -->
					<form method="post" action="#wishlist">
					<li class="d-grid gap-2">
						<input type="submit" name="sortby" value="Sort by latest" class="btn btn-danger fw-bold text-start <?php if ($_SESSION['sort_val'] == "Sort by latest") echo"d-none"; ?>">
					</li>
					<li class="d-grid gap-2">
						<input type="submit" name="sortby" value="Sort by oldest" class="btn btn-danger fw-bold text-start <?php if ($_SESSION['sort_val'] == "Sort by oldest") echo"d-none"; ?>">
					</li>
					<li class="d-grid gap-2">
						<input type="submit" name="sortby" value="Sort by price: low to high" class="btn btn-danger fw-bold text-start <?php if ($_SESSION['sort_val'] == "Sort by price: low to high") echo"d-none"; ?>">
					</li>
					<li class="d-grid gap-2">
						<input type="submit" name="sortby" value="Sort by price: high to low" class="btn btn-danger fw-bold text-start <?php if ($_SESSION['sort_val'] == "Sort by price: high to low") echo"d-none"; ?>">
					</li>
					</form>
				</ul>
			</div>
		</div>
<?php 
// Show Data
$order_by = $_SESSION['short_orderby'];
$sort = $_SESSION['sort'];
$search_fg = '%'. $_SESSION['s_fg'] .'%';
$search_key = '%'. $_SESSION['s_key'] .'%';
$no = 1;

$query = "SELECT * FROM produk WHERE grade_produk LIKE ? AND (grade_produk LIKE ? OR nama_produk LIKE ? OR harga_produk LIKE ? OR ket_produk LIKE ?) ORDER BY $order_by $sort";
$search = $conn->prepare($query);
$search->bind_param('sssss', $search_fg, $search_key, $search_key, $search_key, $search_key);
$search->execute();
$res1 = $search->get_result();

$username = $_SESSION['username'];
$query = "SELECT * FROM wishlist WHERE username LIKE ?";
$search = $conn->prepare($query);
$search->bind_param('s', $username);
$search->execute();
$res2 = $search->get_result();
$JumlahData = mysqli_num_rows($res2);
?>
		<div class="h4 text-start fw-bolder text-secondary d-flex align-items-center">
			Showing <?php echo $JumlahData; ?> results
		</div>
		<div class="container bg-secondary w-100 mt-md-3 mb-md-5" style="height: 1px;"></div>
		<div class="row mt-md-2">
<?php
if ($res1->num_rows > 0) {
	while ($row = $res1->fetch_assoc()) {
		$username = $_SESSION['username'];
		$id_produk = $row['id_produk'];
		$sql_wish = "SELECT * FROM wishlist";
		$res_wish = mysqli_query($conn,$sql_wish);
		while($row_wish = mysqli_fetch_array($res_wish)){
			if ($row_wish['username'] == $username && $row_wish['id_produk'] == $id_produk) {
?>
			<div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-5 mb-sm-3 mb-lg-4 bg-white" " id="tr_<?php echo $row_wish['id_produk']?>">
				<div class="anchor-stickynav" id="<?php echo $row['id_produk']; ?>"></div>
				<div class="col-12 rounded product-shadow pb-md-2 zoom h-100 d-flex align-items-center flex-column">
					<figure class="imghvr-fade mb-md-2 rounded-top bg-transparent">
						<img src="../images/product/<?php echo $row['img_produk']; ?>" class="w-100 pb-md-2 bg-primary">
							<figcaption class="p-0 m-0 bg-danger">
								<img src="../images/product-hover/<?php echo $row['img_produk-hover']; ?>" class="w-100">
							</figcaption>
					</figure>
					<div class="h5 text-secondary fw-bolder px-md-2"><?php echo $row['grade_produk']; ?></div>
					<a href="#" class="btn h5 text-dark btn-item px-md-2"><?php echo $row['nama_produk']; ?></a>
					<div class="mt-auto w-100">
						<div class="h4 text-danger fw-bolder pt-md-2 px-md-2">Rp <?php echo number_format($row['harga_produk'] , 0, ',', '.'); ?>,00</div>
						<div class="row px-2 px-md-3 pb-md-2">
							<!-- delete from wishlist -->						
							<div class="col-6">
								<div class="d-grid gap-2"><button class="btn rounded-0 fw-bolder border-2 btn-outline-danger"  onclick="delete_date('<?php echo $row_wish['id_produk']?>')"><i class="fa-solid fa-trash fa-lg"></i></button></div>
							</div>
							<!-- add to cart -->
<?php 
$btn_cart = "btn-outline-dark";
$btn_cart_fa = "<i class='fa-solid fa-cart-plus fa-lg'></i>";
if (isset($_SESSION['username'])) {
	$username = $_SESSION['username'];
	$id_produk = $row['id_produk'];
	$sql = "SELECT * FROM cart";
	$result = mysqli_query($conn,$sql);
	while($row_cart = mysqli_fetch_array($result)){
		if ($row_cart['username'] == $username && $row_cart['id_produk'] == $id_produk) {
			$btn_cart = "btn-success disabled";
			$btn_cart_fa = "<i class='fa-solid fa-circle-check fa-lg'></i>";
		}
	}
}
?>
							<form class="col-6" method="post" action="../process/add_to-cart.php">
								<input type="hidden" name="cart_val" value="<?php echo $row['id_produk']; ?>">
								<div class="d-grid gap-2"><button class="btn rounded-0 fw-bolder border-2 <?php echo $btn_cart; ?>" name="cart_wishlist"><?php echo $btn_cart_fa ?></button></div>
							</form>
						</div>
					</div>
				</div>
			</div>
<?php 
			}
		}
	} 
} else { 
?> 
    		<div class="h4 text-center fw-bolder text-secondary">Data Not Found</div>
<?php 
} 
?>
		</div>
	</div>
	<!-- FOOTER -->
	<div class="container mt-md-5 pt-md-4 text-center">
		<div class="h4 text-center fw-bolder text-secondary p-0 m-0">
			Social Media
		</div>
		<div class="h2 text-center fw-bolder text-secondary p-0 m-0">
			Contact Me @UNISOPV-STORE
		</div>
		<div class="line bg-secondary mx-auto mt-md-3 mb-md-5 pb-md-2"></div>
	</div>
	<div class="container-fluid bg-dark">
		<div class="container py-md-5">
			<div class="row">
				<div class="col-md-6 d-flex align-items-center flex-column justify-content-center">
					<div class="col-md-6 mx-auto">
						<img class="w-100" src="../images/eva-logo2.png"></a>
					</div>
					<div class="p-0 m-0 text-secondary">
						© <a href="../index.php" class="text-decoration-none">Unisopv-Store</a>. All Rights Reserved.
					</div>
				</div>
				<div class="col-md-6 d-flex align-items-center flex-column justify-content-center">
					<div class="mx-auto text-light">
						<table class="table table-borderless text-light h4 mb-0">
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
	            		url: "../process/upload-pp.php",
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
					    		window.location = 'wishlist.php';
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
		function delete_date(id){
			jQuery.ajax({
				url:'../process/del_from-wishlist.php',
				type:'POST',
				data:'id='+id,
				success:function(result){
					jQuery('#tr_'+id).fadeOut(200);
					Custom.fire({
					  	icon: 'success',
					  	title : 'Successfully removed',
					})
<?php  
	if ($JumlahData == 0) {
		echo "window.location = 'product.php';";
	}
?>
				}
			});

        };
	 </script>
</body>
</html>
<?php ob_end_flush();?>