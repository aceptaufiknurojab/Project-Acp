<?php
session_start();
if (!isset($_SESSION['siswa']) || !isset($_GET['id'])) {
   header('location:./');
}

define('BASEPATH', dirname(__FILE__));

require('./include/connection.php');

$thn     = date('Y');
$dpn     = date('Y') + 1;
$periode = $thn . '/' . $dpn;
$suara   = $_GET['id'];

//simpan data suara
$save = $con->prepare("INSERT INTO t_suara(nis, id_kandidat, periode) VALUES(?,?,?)") or die($con->error);
$save->bind_param('sis', $_SESSION['siswa'], $suara, $periode);
$save->execute();

unset($_SESSION['siswa']);

header('location:./index.php?page=thanks');
