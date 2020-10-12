<?php
session_start();
define('BASEPATH', dirname(__FILE__));

if (!isset($_SESSION['id_admin']) || !isset($_POST['update'])) {
   header('location:../');
}

$id   = $_POST['id'];
$nama = $_POST['nama'];
$foto = $_FILES['foto'];
$visi = $_POST['visi'];
$misi = $_POST['misi'];
$f    = $_POST['f'];
if ($nama == '' || $visi == '' || $misi == '') {

   echo '<script type="text/javascript">alert("Semua form harus terisi");window.history.go(-1);</script>';

} else {

   include('../../include/connection.php');

   if (is_uploaded_file($foto['tmp_name'])) {

      $ext  = array('image/jpg','image/jpeg','image/pjpeg','image/png','image/x-png');
      $tipe = $_FILES['foto']['type'];
      $size = $_FILES['foto']['size'];

      if (!in_array(($tipe),$ext)){ //cek ekstensi file

         echo '<script type="text/javascript">alert("Format gambar tidak diperbolehkan!");window.history.go(-1)</script>';

      } else if($size > 2097152) {

         echo '<script type="text/javascript">alert("Ukuran gambar terlalu besar!");window.history.go(-1);</script>';

      } else {

         $extractFile = pathinfo($foto['name']);
         $dir         = "../../assets/img/kandidat/";
         $sameName    = 0;
         $handle      = opendir($dir);

         //looping isi directory tujuan
         while(false != ($files = readdir($handle))){
            //apabila ditemukan nama file yang sama
            if (strpos($files,$extractFile['filename']) !== false) {
               $sameName++; //tambah nilai variabel $sameName
            }
         }

         $newName = empty($sameName) ? $foto['name'] : $extractFile['filename'].'('.$sameName.').'.$extractFile['extension'];

         //pindahkan file yang di upload ke directory tujuan bila berhasil jalankan perintah query untuk mennyimpan ke database
         if (move_uploaded_file($foto['tmp_name'],$dir.$newName)) {

            unlink('../../assets/img/kandidat/'.$f);

            $sql = $con->prepare("UPDATE t_kandidat SET nama_calon = ? , foto = ?, visi = ?, misi = ? WHERE id_kandidat = ?") or die($con->error);
            $sql->bind_param('sssss', $nama, $newName, $visi, $misi, $id);
            $sql->execute();

            header('location:../dashboard.php?page=kandidat');

         } else {

            echo '<script type="text/javascript">alert("Foto gagal diupload");window.history.go(-1);</script>';

         }

      }

   } else {

      $sql = $con->prepare("UPDATE t_kandidat SET nama_calon = ?, visi = ?, misi = ? WHERE id_kandidat = ?") or die($con->error);
      $sql->bind_param('ssss', $nama, $visi, $misi, $id);
      $sql->execute();

      header('location:../dashboard.php?page=kandidat');

   }
}
