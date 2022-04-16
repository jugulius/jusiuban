<?php

session_start();
//koneksi ke database
  $koneksi= new mysqli("localhost","root","","ubansjuice-project");

  ?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
        <title>Uban's Juice - Fresh and Healthy</title>
         <link rel="stylesheet" href="css/style.css">
         <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700,900'
         rel='stylesheet' type ='text/css'>
         <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700'
         rel='stylesheet' type ='text/css'>
        
         <link rel="stylesheet"
               href="css/style.css">
	    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
        
    </head>
    <body>
    <nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
		
			<ul class="nav navbar-nav">
					<li><img src="Image/logo.png" alt="logo" width="50%" height="50%"></li>
				<li><a href="index.php">Home</a></li>
				<li><a href="product.php">Mulai Belanja</a><li>
                <li><a href="keranjang.php">Keranjang</a></li>
				<?php if (isset($_SESSION["pelanggan"])): ?>
					<li><a href="logout.php">Logout</a></li>
				<?php else: ?>
					<li><a href="login.php">Login</a></li>
					<li><a href="daftar.php">Daftar</a></li>
                <?php endif ?>

                
            </ul>
    
            <!-- <p class="navbar-text navbar-right"> 
            <a href="product.php" class="bold">Mulai Belanja</a><br> 
            </p> -->
                
		</div>
	</nav>

        <div class="big-banner">
            <div class="banner-text">
                    <h1><span class="bold"></span></h1><br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    
                    
                    
                </div>
            </div>    
        </div>
        <!-- End Big banner -->
        
        <!-- Feature-->
        <div class="feature">
        <div class="box">    
        <div class="col-3">
            <img src="Image/about.png"alt="">
            <h3>About Us</h3>
            <p>Uban's Juice menyajikan jus buah segar<br>
                dengan beragam pilihan rasa buah<br>
                Rasanya enak dan menyegarkan.</p>
            </div>
        <div class="col-3">
            <img src="Image/delivery.png"alt="">
            <h3>Pengiriman</h3>
            <p>Pengiriman setiap hari kerja mulai <br>
                08.00 - 15.00. Pesanan yang masuk <br>
                lewat dari jam 15.00 akan dikirimkan <br>
                hari berikutnya.</p>
            </div>
        <div class="col-3">
            <img src="Image/contact.png"alt="">
            <h3>Butuh Bantuan?</h3>
            <p>Silahkan kami di Whatsapp +628989332970 <br>
                atau sosial media Instagram @jusiuban.</p>
            </div>
        </div>
        </div>
        <!-- End Feature -->
   
    </body>
</html>