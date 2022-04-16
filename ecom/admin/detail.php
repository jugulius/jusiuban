<h2>Detail Pembelian</h2>
<?php 
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>

<p>
<strong>Nama    : <?php echo $detail['nama_pelanggan']; ?></strong> <br>
 		Telepon : <?php echo $detail['telepon_pelanggan']; ?> <br>
 		Email   : <?php echo $detail['email_pelanggan']; ?> <br>
 		Tanggal : <?php echo $detail['tanggal_pembelian']; ?> <br>
 	</p>

 	<table class= "table table-bordered">
 		<thead> 
 			<tr>
 				<th>No</th>
 				<th>Nama Produk</th>
 				<th>Harga</th>
 				<th>Jumlah</th>
 				<th>Subtotal</th>
 			
 		</tr>
 	</thead>
 	<tbody>
		<?php $total_biaya=0; ?>
 		<?php $nomor=1; ?>
 		<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]'"); ?>
 		<?php while($pecah=$ambil->fetch_assoc()){ ?>
 		<tr>
 			<td><?php echo $nomor; ?></td>
 			<td><?php echo $pecah['nama'];?></td>
 			<td>Rp. <?php echo number_format ($pecah['harga']);?></td>
 			<td><?php echo $pecah['jumlah'];?></td>
 			<td>
 				Rp. <?php echo number_format ($pecah['harga']*$pecah['jumlah']); ?>
 			</td>
 		</tr>
 		<?php $nomor++; ?>
		<?php $total_biaya=$total_biaya+($pecah['harga']*$pecah['jumlah']); ?>
 		<?php } ?>
 	</tbody>


	<tfoot>
					<tr>
						<th colspan="4">Total</th>
						<th>Rp. <?php echo number_format($detail['total_pembelian']); ?></th>
					</tr>
				</tfoot>
	 
	<tfoot>
					<tr>
						<th colspan="4">SubTotal belanja</th>
						<th>Rp. <?php echo number_format($total_biaya) ?></th>
					</tr>
				</tfoot>

	<tfoot>
					<tr>
						<th colspan="4">Ongkos Kirim</th>
						<th>Rp. <?php echo number_format($detail['total_pembelian']-$total_biaya); ?></th>
					</tr>
				</tfoot>

</table>

<button class="btn btn-primary" onclick="history.go(-1);">Kembali </button>
