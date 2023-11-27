<?php
session_start();

//koneksi database
$conn = mysqli_connect("localhost","root","","invetarisbarang");

//menambah barang
if(isset($_POST['addbarang'])){
    $namabarang = $_POST['namabarang'];
    $satuannya = $_POST['satuannya'];
    $supnya = $_POST['supnya'];
    $total = $_POST['total'];
    $harga = $_POST['harga'];

    $addtobarang = mysqli_query ($conn, "insert into barang (namabarang, idsatuan, idsup, total, harga) values('$namabarang','$satuannya','$supnya','$total','$harga')");
    if ($addtobarang){
        header('location:index.php');
    } else {
        echo 'gagal';
        header('location.index.php');
    }

}

//menambah supplier
if(isset($_POST['addsupplier'])){
    $namasup = $_POST['namasup'];
    $asalsup = $_POST['asalsup'];
    

    $addtosup = mysqli_query ($conn, "insert into supplier (namasup, asalsup) values('$namasup','$asalsup')");
    if ($addtosup){
        header('location:sup.php');
    } else {
        echo 'gagal';
        header('location.index.php');
    }

}

//menambah satuan
if(isset($_POST['addsatuan'])){
    $namasatuan = $_POST['namasatuan'];

    $addtosatuan = mysqli_query ($conn, "insert into satuan (namasatuan) values('$namasatuan')");
    if ($addtosatuan){
        header('location:satuan.php');
    } else {
        echo 'gagal';
        header('location.index.php');
    }

}

//menambah barang masuk
if(isset($_POST['barangmasuk'])){
    $barangnya = $_POST['barangnya'];
    $satuannya = $_POST['satuannya'];
    $supnya = $_POST['supnya'];
    $stock = $_POST['stock'];
    $ket = $_POST['ket'];

    $cekstock = mysqli_query($conn, "select * from barang where idbarang = '$barangnya'");
    $ambildata = mysqli_fetch_array($cekstock);

    $stockskrng = $ambildata['total'];
    $tmbhstock = $stockskrng+$stock;

    $addtomasuk = mysqli_query ($conn, "insert into bar_masuk (idbarang, idsatuan, idsup, stock, ket) values('$barangnya','$satuannya','$supnya','$stock','$ket')");
    $updatemasuk = mysqli_query ($conn, "update barang set total= '$tmbhstock' where idbarang='$barangnya'");
    if ($addtomasuk){
        header('location:barang_masuk.php');
    } else {
        echo 'gagal';
        header('location.index.php');
    }

}

//menambah barang masuk
if(isset($_POST['barangkeluar'])){
    $barangnya = $_POST['barangnya'];
    $satuannya = $_POST['satuannya'];
    $stock = $_POST['stock'];
    $ket = $_POST['ket'];

    $cekstock = mysqli_query($conn, "select * from barang where idbarang = '$barangnya'");
    $ambildata = mysqli_fetch_array($cekstock);

    $stockskrng = $ambildata['total'];
    $tmbhstock = $stockskrng-$stock;

    $addtokeluar = mysqli_query ($conn, "insert into bar_keluar (idbarang, idsatuan, stock, ket) values('$barangnya','$satuannya','$stock','$ket')");
    $updatekeluar = mysqli_query ($conn, "update barang set total= '$tmbhstock' where idbarang='$barangnya'");
    if ($addtokeluar){
        header('location:barang_keluar.php');
    } else {
        echo 'gagal';
        header('location.index.php');
    }

}




?>