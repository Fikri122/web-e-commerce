<?php require_once("config.php");
    if (!isset($_SESSION)) {
        session_start();
    } ?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Al-azzam</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/gijgo.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/slicknav.css">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css">

    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
</head>

<body>

    <!-- header-start -->
       <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container-fluid ">
                    <div class="header_bottom_border">
                        <div class="row align-items-center">
                            <div class="col-xl-3 col-lg-2">
                                <div class="logo">
                                    <a href="index.php">
                                        <img src="img/logo.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-7">
                                <div class="main-menu  d-none d-lg-block">
                                    <nav>
                                       <ul id="navigation">
                                            <li><a href="index.php"><strong>home</strong></a></li>
                                            <li><a href="shop.php"><strong>shop</strong></a></li>                                         
                                            <li><a href="shopingcart.php"><strong>shopping cart</strong></a></li>
                                            <li><a href="contact.php"><strong>kontak</strong></a></li>
                                        </ul>
										</nav>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->

     <!-- bradcam_area  -->
     <div class="bradcam_area bradcam_bg_2">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="bradcam_text text-center">
                            <h3>Shopping cart</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ bradcam_area  --> 			

   <!--shoping cart-->
   
   
	<!--start: Wrapper-->
	<div id="wrapper">
				
		<!-- start: Container -->
		<div class="container">
      <div class="col-12 row_shoping_cart">
      <?php 
        if(isset($_SESSION['message'])){
          echo $_SESSION['message'];
          unset($_SESSION['message']);
        }
      ?>
        <table class="table table-bordered table-striped table-responsive">
          <thead>
            <tr>
              <th scope="col" class="text-center">#</th>
              <th scope="col" class="text-center">Foto Produk</th>
              <th scope="col" class="text-center">Nama Produk</th>
              <th scope="col" class="text-center">Harga Satuan</th>
              <th scope="col" class="text-center">Quantity</th>
              <th scope="col" class="text-center">Total Per Item</th>
              <th scope="col" class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if(isset($_SESSION['id']))
            {
              $sql = "
                    SELECT keranjang.id_keranjang, keranjang.id_produk, keranjang.jumlah_produk, produk.nama_produk, produk.harga_produk, produk.gambar_produk 
                    FROM keranjang
                    INNER JOIN produk ON produk.id_produk = keranjang.id_produk
                    WHERE id_user = $_SESSION[id] AND is_delete = '0'
                   ";
              $query = $link->query($sql);
              //any product in cart?
              if($query->num_rows > 0)
              {
                $total_per_item = 0; 
                $jumlah_total = 0;
                $index = 1;
                
                //output keranjang belanja
                while($data = mysqli_fetch_array($query))
                { 
                  $id_keranjang = $data['id_keranjang'];
                  $id_produk = $data['id_produk'];       
                  $quantity = $data['jumlah_produk'];
                  $nama_produk = $data['nama_produk'];      
                  $harga_satuan = $data['harga_produk'];        
                  $foto_produk = $data['gambar_produk'];        

                  $total_per_item = $harga_satuan * $quantity;
                  $jumlah_total = $jumlah_total + $total_per_item;
            
            ?>
            <tr>
              <th class="column1" scope="row"><?php echo $index; ?></th>
              <td class="column2"><img class="photo_product_cart mx-auto d-block" src="<?php echo $foto_produk; ?>"></td>
              <td class="column3"><?php echo $nama_produk; ?></td>
              <td class="column4 text-right">Rp <?php echo number_format($harga_satuan,0,',','.'); ?></td>
              <td class="column5">
                <div class="input-group" id="input_group_cart">
                  <input 
                    onblur="valueChange('<?php echo $id_keranjang; ?>')" 
                    type="button" 
                    value="-" 
                    class="button-minus" 
                    data-field="quantity"
                  >
                  <input 
                    onblur="valueChange('<?php echo $id_keranjang; ?>')"
                    type="number" 
                    step="1" 
                    min="1" 
                    max="" 
                    name="quantity" 
                    id="quantity<?php echo $id_keranjang; ?>" 
                    class="quantity-field" 
                    value="<?php echo $quantity; ?>"
                  >
                  <input 
                    onblur="valueChange('<?php echo $id_keranjang; ?>')"
                    type="button" value="+" 
                    class="button-plus" 
                    data-field="quantity"
                  >
                </div>
              </td>
              <td class="column6 text-right">Rp <?php echo number_format($total_per_item,0,',','.'); ?></td>
              <td>
                <a href="<?php echo "delete_item_process.php?id_keranjang="; echo $id_keranjang; 
                  echo '&jumlah_produk='; echo $quantity;
                  echo '&id_produk='; echo $id_produk; echo '&nama_produk='; echo $nama_produk;  ?>">
                  <button class="btn btn-danger">Delete</button>
                </a>
              </td>
            </tr>
            <?php
                $index++;
                }
              } 
              else
              {
                echo "<tr>
                        <td colspan='7' style='width:1400px;'>Belum Ada Produk Di Keranjang Belanja
                        </td>
                      </tr>
                     ";
              }
            } 
              else
              {
                echo "<tr>
                        <td colspan='7' style='width:1400px;'>Belum Ada Produk Di Keranjang Belanja
                        </td>
                      </tr>
                     ";
              }
            ?>
          </tbody>
        </table>
        <?php
          if(isset($_SESSION['id']))
          {
            if($query->num_rows > 0)
            { 
            
        ?>
        <div class="cart_total_text">Cart Total</div>
        <table class="table table-bordered table-responsive table-sub-total">
          <tr>
            <td id="column_cart_total_title">Total</td>
            <td class="text-right" id="column_cart_total">Rp <?php echo number_format($jumlah_total,0,',','.'); ?></td>
          </tr>
        </table>

        <a href="checkout.php"><button class="btn btn-primary float-right" >Lanjut Ke Checkout</button></a>
        <?php
            }
          }

        ?>
      </div>
			
		</div>
		<!-- end: Container -->
				
	</div>
	<!-- end: Wrapper  -->	
	
   <!--end shoping cart-->
    <!-- footer start -->
    <footer class="footer">
        
        <div class="copy-right_text">
            <div class="container">
                <div class="footer_border"></div>
                <div class="row">
                    <div class="col-xl-12">
                       <center><P>
		Copyright &copy;2019 - <script>document.write(new Date().getFullYear());</script>  | Al-azzam Prima Mandiri </br>Theme by colorlib </P></center>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--/ footer end  -->


  <!-- JS here -->
  <script src="js/vendor/modernizr-3.5.0.min.js"></script>
  <script src="js/vendor/jquery-1.12.4.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/isotope.pkgd.min.js"></script>
  <script src="js/ajax-form.js"></script>
  <script src="js/waypoints.min.js"></script>
  <script src="js/jquery.counterup.min.js"></script>
  <script src="js/imagesloaded.pkgd.min.js"></script>
  <script src="js/scrollIt.js"></script>
  <script src="js/jquery.scrollUp.min.js"></script>
  <script src="js/wow.min.js"></script>
  <script src="js/nice-select.min.js"></script>
  <script src="js/jquery.slicknav.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/plugins.js"></script>
  <script src="js/gijgo.min.js"></script>

  <!--contact js-->
  <script src="js/contact.js"></script>
  <script src="js/jquery.ajaxchimp.min.js"></script>
  <script src="js/jquery.form.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <script src="js/mail-script.js"></script>

  <!--counter js-->
  <script src="js/custom.js"></script>

  <script src="js/main.js"></script>
</body>

</html>