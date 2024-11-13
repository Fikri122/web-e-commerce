<?php 
require_once("config.php");
if (!isset($_SESSION)) {
    session_start();
}


$id_keranjang = $_POST['id_keranjang'];
$quantity = $_POST['quantity'];
$quantity_yang_dikembalikan = 0;


//cek apakah jumlah produk yang akan dibeli stoknya tersedia atau tisak
$cek_ketersediaan_stok = $link->query("SELECT keranjang.id_produk, produk.stok_produk, produk.nama_produk
									   FROM keranjang
									   INNER JOIN produk
									   ON produk.id_produk = keranjang.id_produk
									   WHERE id_keranjang = $id_keranjang");
while($data = mysqli_fetch_array($cek_ketersediaan_stok))
{
    $stok_tersedia = $data['stok_produk'];  
    $nama_produk =$data['nama_produk'];
}


	//hitung jumlah barang yg ada di db sesuai id_keranjang
	$sql = "SELECT jumlah_produk, id_produk FROM keranjang WHERE id_keranjang = $id_keranjang";
	$query = $link->query($sql);

	while($data = mysqli_fetch_array($query))
	{      
	$quantity_di_db = $data['jumlah_produk'];
	$id_produk = $data['id_produk'];
	}

	//hitung jumlah barang yg akan di kembalikan atau dikurangi ke tabel produk
	$quantity_yang_dikembalikan = $quantity_di_db - $quantity;
	$quantity_pertambahan =  $quantity - $quantity_di_db;

	if($quantity_yang_dikembalikan > 0 || ($quantity_yang_dikembalikan < 0 && $stok_tersedia >= $quantity_pertambahan)){
		//update jumlah produk yang ada keranjang belanja
		$update_keranjang_belanja = "UPDATE keranjang SET jumlah_produk = $quantity WHERE id_keranjang= $id_keranjang";
		$link->query($update_keranjang_belanja);

		//update jumlah produk yang ada di table
		$update_jumlah_produk = "UPDATE produk SET stok_produk = stok_produk + $quantity_yang_dikembalikan WHERE id_produk = $id_produk";
		$link->query($update_jumlah_produk);
	} 
		else
		{
			$_SESSION['message'] = "<p class='text-danger'><i class='fa fa-times'> Stok produk <b>$nama_produk</b> tidak mencukupi</i></p>";
		}
?>