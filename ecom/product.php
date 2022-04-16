
<?php

session_start();
//koneksi ke database
  $koneksi= new mysqli("localhost","root","","ubansjuice-project");

  if (!isset($_GET['cari'])) { 
	$ambil = $koneksi->query("SELECT * FROM produk"); 
	 } else { 
	$cari = $_GET['cari'];   
	$ambil = $koneksi->query("SELECT * FROM produk WHERE nama_produk LIKE '%".$cari."%'");   
	 }

  ?> 

<!DOCTYPE html>
<html>
<head>
	<title>Product - Uban's Juice - Fresh and Healthy </title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>

<?php include 'menu.php'; ?>
	<!-- Konten -->

	<section class="konten">
		<div class="container">

		<form action="product.php" method="get" class="navbar-form navbar-right" role="search"> 
  				<div class="form-group"> 
	    			<input type="text" class="form-control" placeholder="Cari Jus" name="cari"> 
  				</div> 
  			<input type="submit" class="btn btn-default" value="Cari"></button> 
		</form>

			<h1>Our Product</h1>

			<div class="row">


				<?php while($perproduk = $ambil->fetch_assoc()){ ?>

				<div class="col-md-3">
					<div class="thumbnail">
						<img src="foto_produk/<?php echo $perproduk['foto_produk'];?>" alt="">
						<div class="caption">
							<h3><?php echo $perproduk['nama_produk'];?></h3>
							<h5>Rp. <?php echo number_format($perproduk['harga_produk']);?></h5>
							<a href="detail.php?id=<?php echo $perproduk['id_produk'];?>" class="btn btn-primary">Beli</a>
							
							
						</div>
						
					</div>
					
				</div>
				<?php }?>
		
			</div>
			
		</div>
	
	</section>	

</body>
</html>