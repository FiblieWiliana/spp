<?php

$server='localhost';
$user='root';
$passw='';
$db='db_spp';

$koneksi=mysqli_connect($server,$user,$passw,$db); //koneksi secara prosedural
$mysqli= new mysqli($server,$user,$passw,$db);
$mysqli->select_db($db);
$mysqli->query("SET NAMES 'utf8'");
$database=$db;


if($koneksi){
   // echo "koneksi sukses";
} else {
    echo "Koneksi Gagal";
    echo "<br>".mysqli_connect_error();
} ?>