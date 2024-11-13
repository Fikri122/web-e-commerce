<?php 
    require_once("config.php");
    session_start();
    //jika pengunjung belum login saat memesan barang
	if (!isset($_SESSION['id'])) {
        $_SESSION['message'] = 'Silahkan login terlebih dahulu, untuk melakukan pembelian';
        header("Location: login.php");
    }   
        //jika pengunjung sudah melakukan login
        else
        {
            $id_produk = $_POST['id_produk'];
            $jumlah = $_POST['quantity'];
            $id_user = $_SESSION['id'];

            $tgl_skrg = date("Y-m-d");

            //cek apakah jumlah produk yang akan dibeli stoknya tersedia atau tidak
            $cek_ketersediaan_stok = $link->query("SELECT nama_produk, stok_produk FROM produk where id_produk = $id_produk");
            while($data = mysqli_fetch_array($cek_ketersediaan_stok))
            {
                $stok_tersedia = $data['stok_produk']; 
                $nama_produk = $data['nama_produk'];
            }

            if($stok_tersedia >= $jumlah && $jumlah != 0){
                //di cek dulu apakah barang yang di beli sudah ada di tabel keranjang
                $sql = "SELECT * FROM keranjang WHERE id_produk='$id_produk' AND id_user='$id_user' AND is_delete = '0'";
                $result= $link->query($sql);
                if ($result->num_rows == 0){
                    // kalau barang belum ada, maka di jalankan perintah insert
                    $link->query("INSERT INTO keranjang (id_produk, jumlah_produk, id_user, tanggal)
                            VALUES ('$id_produk', $jumlah, '$id_user', '$tgl_skrg')");

                    //kurangi stok barang yang masuk sesuai jumlah barang yang masuk kekeranjang belanja
                    $link->query("UPDATE produk SET stok_produk = stok_produk - $jumlah WHERE id_produk = $id_produk");    
                } else {
                    //  kalau barang ada, maka di jalankan perintah update
                    $link->query("UPDATE keranjang
                            SET jumlah_produk = jumlah_produk + $jumlah, tanggal = '$tgl_skrg'
                            WHERE id_user ='$id_user' AND id_produk='$id_produk'");

                    //kurangi stok barang yang masuk sesuai jumlah barang yang masuk ke keranjang belanja
                    $link->query("UPDATE produk SET stok_produk = stok_produk - $jumlah WHERE id_produk = $id_produk");    
                }

                $_SESSION['message'] = '<p class="text-success"><i class="fa fa-check"> '.$jumlah.' produk '.$nama_produk.' berhasil ditambahkan ke keranjang belanja</i></p>';
                header("Location: shopingcart.php");    

            }
                else if($jumlah == ''){
                    $_SESSION['message'] = 'jumlah barang harus diisi';
                    header("Location: produk.php?id_produk=$id_produk");
                }
                //jika produk yang dibeli jumlahnya kurang atau tidak ada stok
                else
                {
                    $_SESSION['message'] = 'Maaf, Stok produk yang anda pilih tidak mencukupi';
                    header("Location: produk.php?id_produk=$id_produk");
                }
        }
    

	
?>