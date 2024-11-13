<?php 

require_once("config.php");
if (!isset($_SESSION)) {
    session_start();
} 

$id_keranjang = $_GET['id_keranjang'];
$id_produk = $_GET['id_produk'];
$jumlah_produk = $_GET['jumlah_produk'];
$nama_produk = $_GET['nama_produk'];


$kembalikan_produk = "UPDATE produk SET stok_produk = stok_produk + $jumlah_produk  WHERE id_produk = $id_produk";
$test = $link->query($kembalikan_produk);


//update keranjang agar tidak ditampilkan di shopingcart (soft delete))
$sql = "UPDATE keranjang SET is_delete = '1'  WHERE id_keranjang = $id_keranjang";
$link->query($sql);

$_SESSION['message'] = "<p class='text-success'><i class='fa fa-check'> Berhasil menghapus produk <b>$nama_produk</b> dari keranjang belanja</i></p>";

header("Location: shopingcart.php");
?>