<?php require_once("config.php");
    if (!isset($_SESSION)) {
        session_start();
    } 
?>
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

    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->


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
                                    <ul id="navigation">
                                            <li><a href="index.php"><strong>home</strong></a></li>
                                            <li><a href="shop.php"><strong>shop</strong></a></li>                                         
                                            <li><a href="shopingcart.php"><strong>shopping cart</strong></a></li>
                                            <li><a href="contact.php"><strong>kontak</strong></a></li>
                                        </ul>
                                        </nav>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                                <div class="Appointment">
                                    <div class="book_btn d-none d-lg-block">
                                        <a href="login.php">Sign In</a>
                                    </div>
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

    <!-- slider_area_start -->
    <div class="slider_area">
        <div class="single_slider  d-flex align-items-center slider_bg_1">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-7">
                        <div class="slider_text text-center justify-content-center">
                          
                            <div class="quality">
                                <ul>
                                    <?php
                                        $sql = "SELECT id_produk, nama_produk from produk";
                                        $result = $link->query($sql);

                                        if ($result->num_rows > 0) {
                                            // output data of each row
                                            while($row = $result->fetch_assoc()) {
                                                echo "<li><button>" . $row["nama_produk"] ."</button></li>";
                                            }
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider_area_end -->

    <div class="popular_catagory_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section_title mb-60 text-center">
                     
                        <h3>
                            Kategori Produk
                        </h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                    $sql = "SELECT id_produk, nama_produk, gambar_produk from produk";
                    $result = $link->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $foto_produk = $row['gambar_produk'];
                            $id_produk = $row['id_produk'];
                            $nama_produk = $row['nama_produk'];

                ?>
                <div class="col-xl-3 col-md-4 col-lg-3">
                    <div class="single_catagory">
                        <div class="thumb">
                            <img src='<?php echo $foto_produk; ?>' alt="">
                        </div>
                        <div class="hover_overlay">
                            <div class="hover_inner">
                                <h4><?php echo $nama_produk; ?></h4>
                                <a href="detailproduk.php?id_produk= <?php echo $id_produk; ?>"><span>beli sekarang</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                        }
                    }
                ?>
            </div>
        </div>
    </div>

    <!-- testimonial_area  -->
    <div class="testimonial_area  ">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section_title mb-60 text-center">
                        <h3>
                            Testimoni
                        </h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="testmonial_active owl-carousel">
                        <div class="single_carousel">
                            <div class="single_testmonial text-center">
                                <div>
                                    <img src="img/catagory/aa.png" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="single_carousel">
                            <div class="single_testmonial text-center">
                                <div class="testmonial_author">
                                    <div>
                                        <img src="img/catagory/bb.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single_carousel">
                            <div class="single_testmonial text-center">
                                <div class="testmonial_author">
                                    <div>
                                        <img src="img/catagory/cc.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single_carousel">
                            <div class="single_testmonial text-center">
                                <div class="testmonial_author">
                                    <div>
                                        <img src="img/catagory/dd.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single_carousel">
                            <div class="single_testmonial text-center">
                                <div class="testmonial_author">
                                    <div>
                                        <img src="img/catagory/ee.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /testimonial_area  -->


    <!-- footer start -->
    <footer class="footer">
        <div class="footer_top">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-md-40 col-lg-10">
                        <div class="footer_widget">
                            <div class="footer_logo">
                                <a href="#">
                                    <img src="img/footer_logo.png" alt="">
                                </a>
                            </div>
                            <p>
                                Alamat Kami : <br>Pabelan, IV Pabelan, Mungkid,<br>
                                Magelang, Jawa Tengah</br>56512
                            </p>
                            
                            <div class="socail_links">
                            <p>Contact Support :</p>
                                <ul>
                                    <li>
                                        <a href="https://www.facebook.com/alazaam.group?refid=46&__xts__%5B0%5D=12.Abq7F9ZeD5NgxUQw2CIRs3u9dabAQhPt7f0IHJdFXyFOWMP3gqW8e_FuBCPJCgex4UOXjE7Q3Ox-r8CdYflHkoUcy3Ok5aYslTCRFo9Ls2z1T15YndhKLcuRogwXzwPF2cO1BtGQf2HCgXOzx0qbj4fSOsxmS_cOOkk_7o0eZxOFjXrEbepVPvVXwgrM0LknfeonllMdIOHkjqFrWzQBrryWZm-JH5mhV0iWQc6VIpFVE_1ilq7yiAMx9oV9RUMqqnvUFjPpPNs1Y1bBkWvnAH6-wPdeTa_7jKc00VcNSGv9vA8Y4hCJd2p9U_YSUTXwMUX90fpCwmj8EaXyx00tD5BOwVxE6PAcY5hgRq7NaC5MNyz4acmUJO70OIVhl9HJ1ClKkMLTR88RiP7-TC5oXX5UcJgIbclJYNJrwDlyR54vasstlrJxktOfnwCwpG5Td5A50EshytN27eyrLB734tOjN6dEhYS216Gp3Jvee3O6V-5P3ZZMcjta_ESveN0XRE1GXNl99O82eSHsktAsK_y1-53kuLa60udAwDYJBYZbF13iEJMEgrL2WmdQb0YjiDs">
                                            <i class="ti-facebook"></i>
                                        </a>
                                    </li>
                                    </br>
                                    </br>
                                    <li>
                                        <a href="https://api.whatsapp.com/send?phone=6285326707297">
                                            <i class="fa fa-whatsapp"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    
                    <div class="col-xl-2 col-md-6 col-lg-3">
                        <div class="footer_widget">
                            <h3 class="footer_title">
                                Produk Kami
                            </h3>
                            <ul>
                                <li><a href="shop.php">Madu Kaliandra </a></li>
                                <li><a href="shop.php">Madu Hutan </a></li>
                                <li><a href="shop.php">Madu Randu</a></li>
                                <li><a href="shop.php">Madu Lanceng</a></li>
                            </ul>

                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-lg-2">
                        <div class="footer_widget">
</br>
</br>
                            <ul>
                                <li><a href="shop.php">Madu Karet</a></li>
                                <li><a href="shop.php">Madu Kesambi</a></li>
                                <li><a href="shop.php">Madu Multi Flora</a></li>
                                <li><a href="shop.php">Madu Rimba</a></li>
                                <li>dll</li>
                            </ul>
                        </div>
                    </div>
                   
                    <div class="col-xl-4 col-md-6 col-lg-4">
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="copy-right_text">
            <div class="container">
                <div class="footer_border"></div>
                <div class="row">
                    <div class="col-xl-12">
                        <center><P>
        Copyright &copy;<script>document.write(new Date().getFullYear());</script>  | Al-azzam Prima Mandiri </br>Theme by colorlib </P></center>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--/ footer end  -->

    <!-- link that opens popup -->
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"> </script>
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
    <!-- <script src="js/gijgo.min.js"></script> -->
    <script src="js/slick.min.js"></script>



    <!--contact js-->
    <script src="js/contact.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/mail-script.js"></script>


    <script src="js/main.js"></script>
</body>

</html>