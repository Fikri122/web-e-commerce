<?php 
require_once("config.php");
if (!isset($_SESSION)) {
    session_start();
} 

$nama = $_POST['name'];
$alamat = $_POST['address'];
$kota = $_POST['city'];
$provinsi = $_POST['province'];
$nomor_hp = $_POST['phone'];

$id_user = $_SESSION['id'];


$kode_pembelian = $id_user.'-'.date("Ymdhs");
$tanggal_pembelian = date("Y-m-d");


// fungsi untuk mendapatkan isi keranjang belanja
function isi_keranjang(){
	$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	$id_user = $_SESSION['id'];
    $isikeranjang = array();
    $sid = session_id();
    $sql = $link->query("
    					SELECT keranjang.id_keranjang, keranjang.id_produk, keranjang.jumlah_produk, produk.harga_produk, produk.harga_produk * keranjang.jumlah_produk as total_per_item
    					FROM keranjang 
    					INNER JOIN produk ON
    					produk.id_produk = keranjang.id_produk
    					WHERE id_user= $id_user && is_delete = '0'"
    				  );
     
    while ($r=mysqli_fetch_array($sql)) 
    {
        $isikeranjang[] = $r;
    }
    return $isikeranjang;
}
// panggil fungsi isi_keranjang dan hitung jumlah produk yang dipesan
$isikeranjang = isi_keranjang();
$jml          = count($isikeranjang);

if($jml > 0){
	// simpan data detail pembelian  
	for ($i = 0; $i < $jml; $i++){
	  $link->query("INSERT INTO detail_pembelian(id_produk, jumlah_produk, total, tanggal, kode_pembelian) VALUES({$isikeranjang[$i]['id_produk']}, {$isikeranjang[$i]['jumlah_produk']}, {$isikeranjang[$i]['total_per_item']}, '$tanggal_pembelian', '$kode_pembelian')");
	 
	}
	// simpan data pembelian untuk mengkalkulasikan nilai total keseluruhan
	$total_all_item = $link->query("SELECT SUM(total) as total_pembelian FROM detail_pembelian WHERE kode_pembelian = '$kode_pembelian'");
	//output keranjang belanja
	while($data = mysqli_fetch_array($total_all_item))
	{ 
		$total_pembelian = $data['total_pembelian'];

		$link->query("INSERT INTO pembelian (nama_lengkap, alamat_lengkap, kabupaten_kota, provinsi, no_handphone, total_pembelian, tanggal_pembelian, kode_pembelian) VALUES ('$nama', '$alamat', '$kota', '$provinsi', '$nomor_hp', $total_pembelian, '$tanggal_pembelian', '$kode_pembelian')");
	}
	// setelah data pembelian tersimpan, update data di tabel keranjang menjadi is_delete = 1 (soft delete)
	for ($i = 0; $i < $jml; $i++) { $link->query("UPDATE keranjang SET is_delete = '1' WHERE id_produk = {$isikeranjang[$i]['id_produk']}");}

	$_SESSION['kode_pembelian'] = $kode_pembelian;
	header("Location: checkout_success.php");

}
	else
	{
		$_SESSION['message'] = 'Maaf Anda Belum Menambahkan Barang Ke keranjang Belanja';
		header("Location: index.php");
	}

echo $link->error;
?>