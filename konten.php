<?php 

if (empty($_GET['p'])){
    $title="Sistem Informasi Biaya Pendidikan";
    $konten="konten/home.php";
}
else if($_GET['p']=='periode'){
    $title="Data Periode Pendidikan";
    $konten="konten/periode.php";
}
else if($_GET['p']=='biaya'){
    $title="Data biaya Pendidikan";
    $konten="konten/biaya.php";
}
else if($_GET['p']=='siswa'){
    $title="Data siswa";
    $konten="konten/siswa.php";
}
else if($_GET['p']=='user'){
    $title="Data user Pendidikan";
    $konten="konten/user.php";
}

//menu untuk transaksi
else if($_GET['p']=='tagihan'){
    $title="Data tagihan";
    $konten="konten/tagihan.php";
}
else if($_GET['p']=='tagihan-info'){
    $title="Informasi Riwayat Transaksi Tagihan";
    $konten="konten/tagihan-info.php";
}
else if($_GET['p']=='tagihan-edit'){
    $title="Ubah Data Tagihan";
    $konten="konten/tagihan-edit.php";
}
else if($_GET['p']=='bayar'){
    $title="Data Pembayaran";
    $konten="konten/bayar.php";
}
else if($_GET['p']=='bayar-tambah'){
    $title="Input Pembayaran Siswa";
    $konten="konten/bayar-tambah.php";
}
else if($_GET['p']=='bayar-konfirmasi'){
    $title="Konfirmasi Pembayaran Siswa";
    $konten="konten/bayar-konfirmasi.php";
}
else if($_GET['p']=='bayar-alokasi'){
    $title="Alokasi Pembayaran Siswa";
    $konten="konten/bayar-alokasi.php";
}
else if($_GET['p']=='laporan'){
    $title="Laporan Sistem";
    $konten="konten/laporan.php";
}
else if($_GET['p']=='backup'){
    $title="backup Sistem";
    $konten="konten/backup.php";
}
else if($_GET['p']=='restore'){
    $title="Restore Sistem";
    $konten="konten/restore.php";
}

//ahkir menu transaksi. (shift alt bawah buat copy cepat)

//menu untuk siswa
else if($_GET['p']=='input-bayar'){
    $title="input Laporan Siswa";
    $konten="konten/siswa-input-bayar.php";
}
else if($_GET['p']=='riwayat'){
    $title="Riwayat Pembayaran Siswa";
    $konten="konten/siswa-riwayat.php";
}
else if($_GET['p']=='siswa-info'){
    $title="Informasi Riwayat Transaksi Tagihan";
    $konten="konten/siswa-info.php";
}
else if($_GET['p']=='bayar-alokasi-siswa'){
    $title="Alokasi Pembayaran Siswa";
    $konten="konten/bayar-alokasi-siswa.php";
}
else if($_GET['p']=='siswa-laporan'){
    $title="Laporan Siswa";
    $konten="konten/siswa-laporan.php";
}
//detail pembayaran tagihan

//ahkir menu untuk siswa

else {
    $title="Halaman Tidak Ditemukan";
    $konten="konten/404.php";
}
