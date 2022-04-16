<?php session_start()?>
<?php $koneksi= new mysqli("localhost","root","","ubansjuice-project");?>
<?php
$id_produk = $_GET["id"];
$ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$detail=$ambil->fetch_assoc();

// echo "<pre>";
// print_r($detail);
// echo "</pre>";

?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Detail Produk</title>
 	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
 </head>
 <body>
 

<?php include 'menu.php'; ?>

<section class="kontent">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<img src="foto_produk/<?php echo $detail["foto_produk"]; ?>" alt="" class="img-responsive">
			</div>
			<div class="col-md-6">
				<h2><?php echo $detail["nama_produk"]?></h2>
				<h4>Rp. <?php echo number_format($detail["harga_produk"]); ?></h4>
				<h5>Jumlah Stock : <?php echo number_format($detail["stok_produk"]); ?>
				
				<?php if ($detail["stok_produk"] == 0)

					{
						echo '<span style="color:#FF0000;"> Maaf stok saat ini habis</span>';
					}
					
					?> </h5>
	
				<form method="post">
					<div class="form-group">
						<div class="input-group">
						<input type="number" min="1" max="$stok_produk" class="form-control" name="jumlah" placeholder="Mau beli berapa?" required
						
						<?php if ($detail["stok_produk"] == 0)

						{
							echo 'disabled=disabled';
						}
						
						?> >

						<div class="input-group-btn">
								<button class="btn btn-primary" name="beli"
								
						<?php if ($detail["stok_produk"] == 0)

						{
							echo 'disabled=disabled';
						}
						
						?> >Beli</button> <br>
				</div>

			</div>
		</div>
	</form>

			<?php

			if(isset($_POST["beli"])) 
			
			{

				if(($detail["jumlah"]) <= ($detail["stok_produk"]))
				
				{
				$jumlah = $_POST["jumlah"];
				$_SESSION["keranjang"] [$id_produk] += $jumlah;
					echo "<script>alert('Produk berhasil ditambahkan ke keranjang');</script>";
					echo "<script>location = 'keranjang.php';</script>";
				}

				elseif(($detail["jumlah"]) > ($detail["stok_produk"]))
			
				{
					echo "<script>alert('Maaf, pesananmu melebihi stok.');</script>";
				}
			}

			?>

				<p><?php echo $detail["deskripsi_produk"]; ?></p>
			</div>
		</div>
	</div>
</section>



 </body>
 </html>