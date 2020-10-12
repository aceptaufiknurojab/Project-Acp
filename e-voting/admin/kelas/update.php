<?php
define('BASEPATH', dirname(__FILE__));

session_start();
if(!isset($_SESSION['id_admin'])) {

   header('location:../');

}

if (isset($_POST['update'])) {
   //include file koneksi
   include('../../include/connection.php');
   //tampung data dari form
   $id    = strip_tags(mysqli_real_escape_string($con, $_POST['id']));
   $kelas = strip_tags(mysqli_real_escape_string($con, $_POST['kelas']));

   if ($id == null || $kelas == null) {

      echo '<script type="text/javascript">alert("Form Harus terisi");window.history.go(-1);</script>';

   } else {

      $sql = $con->prepare("UPDATE t_kelas SET nama_kelas = ? WHERE id_kelas = ?");
      $sql->bind_param('ss', $kelas, $id);
      $sql->execute();

      header('location:../dashboard.php?page=kelas');

   }

} else {

   header('location:../dashboard.php');

}
