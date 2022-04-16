<?php
session_start();
$koneksi= new mysqli("localhost","root","","ubansjuice-project");

if(!isset($_SESSION["pelanggan"]))
{
	echo "<script>alert('Anda harus login terlebih dahulu untuk melanjutkan');</script>";
	echo "<script>location = 'login.php';</script>"; 
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Checkout</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>

<?php include 'menu.php'; ?>



<section class="kontent">
		<div class="container">
			<h1>Keranjang Belanja</h1>
			<hr>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Produk</th>
						<th>Harga</th>
						<th>Jumlah</th>
						<th>Subharga</th>
					
					</tr>
				</thead>
				<tbody>
					<?php $nomor=1; ?>
					<?php $totalbelanja = 0; ?>
					<?php $jumlahbelanja = 0; ?>
					<?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah):?> 
					<!-- Menampilkan yang sedang di perulangkan berdasarkan id produk -->	
					<?php
					$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
					$pecah = $ambil->fetch_assoc();
					$subharga = $pecah ["harga_produk"]*$jumlah;
					
					?>
					
					<tr>
						<td><?php echo $nomor; ?></td>
						<td><?php echo $pecah["nama_produk"]; ?></td>
						<td><?php echo number_format($pecah["harga_produk"]);?></td>
						<td><?php echo $jumlah; ?></td>
						<td>Rp. <?php echo number_format($subharga); ?></td>
						

					</tr>
					<?php $nomor++; ?>
					<?php $totalbelanja+=$subharga; ?>
					<?php $jumlahbelanja+=$jumlah; ?>

				<?php endforeach ?>
				</tbody>

				<tfoot>
					<tr>
						<th colspan="4">Total belanja</th>
						<th>Rp. <?php echo number_format($totalbelanja) ?></th>
					</tr>
				</tfoot>

				</table>



			<form method="post">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['nama_pelanggan'] ?>" class="form-control">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['telepon_pelanggan']?>" class="form-control">
						</div>
					</div>
					<div class="col-md-4">
						<select class="form-control" name="id_ongkir">
							<option value="" disabled selected hidden>Pilih Lokasi Anda</option>
							<?php
							$ambil = $koneksi->query("SELECT * FROM ongkir");
							while($perongkir = $ambil->fetch_assoc()){
								?>
							<option value="<?php echo $perongkir["id_ongkir"]?>"><?php echo $perongkir['nama_kota'] ?>
								Rp. <?php echo number_format($perongkir['tarif']) ?> per item</option>
							<?php } ?>
							</select>
						</div>
				</div>
				<div class="form-group">
					<label>Nama lengkap penerima : </label>
					<input cols="5" rows="1" type="text" name="nama_pengirim" placeholder="Masukkan nama penerima"></input><br><br>
					<label>No. HP penerima : </label>
					<input cols="5" rows="1" type="text" name="kontak_pengirim" placeholder="Masukkan No.HP penerima"></input><br><br>
					<label>Alamat lengkap penerima : </label>
					<textarea class="form-control" name="alamat_pengirim" placeholder="Masukkan alamat penerima"></textarea>
				<button class="btn btn-primary" name="checkout">Checkout</button>

			</form>
<?php

			if(isset($_POST["checkout"]))
			{
				$id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
				$id_ongkir = isset($_POST["id_ongkir"]) ? $_POST["id_ongkir"]:0;
								

				if($id_ongkir==0) {
					echo "<script>alert('Anda belum memilih lokasi. Silahkan pilih lokasi anda.');</script>";
				}

				else {
					$tanggal_pembelian = date("Y-m-d");
				$alamat_pengirim = $_POST['alamat_pengirim'];


				$ambil = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir ='$id_ongkir'");
				$arrayongkir = $ambil->fetch_assoc();
				$nama_kota = $arrayongkir['nama_kota'];
				$tarif = $arrayongkir['tarif'];
				
				$subtarif = $tarif*$jumlahbelanja;
				$total_pembelian = $totalbelanja + $subtarif;
				$koneksi->query("INSERT INTO pembelian (id_pelanggan,id_ongkir,tanggal_pembelian,total_pembelian,nama_kota,tarif,alamt_pengiriman,subtarif)VALUES ('$id_pelanggan','$id_ongkir','$tanggal_pembelian','$total_pembelian','$nama_kota','$tarif','$alamat_pengirim','$subtarif')");

				$id_pembelian_barusan = $koneksi->insert_id;
				foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) 
				{

					$ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
					$perproduk = $ambil->fetch_assoc();
					$nama=$perproduk['nama_produk'];
					$harga=$perproduk['harga_produk'];
					$berat=$perproduk['berat_produk'];

					$subberat = $perproduk['berat_produk']*$jumlah;
					$subharga = $perproduk['harga_produk']*$jumlah;

					$koneksi->query("INSERT INTO pembelian_produk (id_pembelian,id_produk,nama,harga,berat,subberat,subharga,jumlah) VALUES ('$id_pembelian_barusan','$id_produk','$nama','$harga','$berat','$subberat','$subharga','$jumlah')");
				}
				unset($_SESSION["keranjang"]);


				echo "<script>alert('Pembelian Sukses');</script>";
				echo "<script>location = 'nota.php?id=$id_pembelian_barusan';</script>"; 

				}
				
				
				
				
			}

			?>
			
							
				
</div>


			
		</div> 
		 
	</section>


<!-- <script>
	const element = document.getElementById("pengiriman");
	if(element=="Pilih Jasa Pengiriman")
		alert("Anda belum memilih jasa pengiriman");
</script> -->


</body>
</html>