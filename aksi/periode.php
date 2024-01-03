<?php
session_start();
include "../koneksi.php";
include "../function.php";

if($_POST){
    if($_POST['aksi']=='tambah'){
        $periode=$_POST['periode'];
        $tanggal_awal=$_POST['tanggal_awal'];
        $tanggal_ahkir=$_POST['tanggal_ahkir'];

        $sql="INSERT INTO periode (id_periode,periode,tanggal_awal,tanggal_ahkir,dibuat_pada,diubah_pada,dihapus_pada) VALUES(DEFAULT,'$periode','$tanggal_awal','$tanggal_ahkir',DEFAULT,DEFAULT,DEFAULT)";

        mysqli_query($koneksi,$sql);
        notifikasi($koneksi);
        
//         function notifikasi($koneksi)
// {
//     $sukses=mysqli_affected_rows($koneksi);
//     if($sukses>=1){
//         $_SESSION['status_proses']='berhasil';
//     } else {
//         $_SESSION['status_proses']='gagal';
//     }
// }
    
// echo $_SESSION['status_proses'];
        header('location:../index.php?p=periode');

    }

    else if($_POST['aksi']=='ubah'){
        $id_periode=$_POST['id_periode']; 
        $periode=$_POST['periode'];
        $tanggal_awal=$_POST['tanggal_awal'];
        $tanggal_ahkir=$_POST['tanggal_ahkir'];

        $sql="UPDATE periode SET periode='$periode',tanggal_awal='$tanggal_awal',tanggal_ahkir='$tanggal_ahkir' WHERE id_periode=$id_periode";
        //echo $sql; //cek perintah
        mysqli_query($koneksi,$sql);
        notifikasi($koneksi);

        header('location:../index.php?p=periode');
    }
}


if($_GET){
    if($_GET['aksi']=='hapus'){
        $id_periode=$_GET['id_periode'];
        //$sql="DELETE FROM periode WHERE id_periode=$id_periode"; //hard delete hapus permanen
        $sql="UPDATE periode SET dihapus_pada=now() WHERE id_periode=$id_periode"; //soft delete
        mysqli_query($koneksi,$sql);
        notifikasi($koneksi);
        header('location:../index.php?p=periode');
    }
    else if ($_GET['aksi']=='restore'){
        $id_periode=$_GET['id_periode'];
        $sql="UPDATE periode SET dihapus_pada = NULL WHERE id_periode=$id_periode";
        mysqli_query($koneksi,$sql);
        notifikasi($koneksi);
        header('location:../index.php?p=periode');
    }
    else if ($_GET['aksi']=='hapus-permanen'){
        $id_periode=$_GET['id_periode'];
        $sql="DELETE FROM periode WHERE id_periode=$id_periode"; //hard delete hapus permanen
        mysqli_query($koneksi,$sql);
        notifikasi($koneksi);
        header('location:../index.php?p=periode');
    }
}
?>