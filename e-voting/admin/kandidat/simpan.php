<?php
define('BASEPATH', dirname(__FILE__));
if (!isset($_POST['add_kandidat'])) {

   header('location:../');

} else {

   $nama     = $_POST['nama'];
   $visi     = $_POST['visi'];
   $misi     = $_POST['misi'];
   $foto     = $_FILES['foto'];
   $thn      = date('Y');
   $dpn      = date('Y') + 1;
   $periode  = $thn.'/'.$dpn;

   if ($nama == '' || $visi == '' || $misi == '') {

      echo '<script type="text/javascript">alert("Semua form harus terisi");window.history.go(-1);</script>';

   } else {

      $ext  = array('image/jpg','image/jpeg','image/pjpeg','image/png','image/x-png');
      $tipe = $_FILES['foto']['type'];
      $size = $_FILES['foto']['size'];
      if (is_uploaded_file($foto['tmp_name'])) { //cek apakah ada file yang di upload

         if (!in_array(($tipe),$ext)){ //cek ekstensi file

            echo '<script type="text/javascript">alert("Format gambar tidak diperbolehkan!");window.history.go(-1)</script>';

         } else if($size > 2097152) {

            echo '<script type="text/javascript">alert("Ukuran gambar terlalu besar!");window.history.go(-1);</script>';

         } else {

            $extractFile = pathinfo($foto['name']);
            $dir         = "../../assets/img/kandidat/";


            $newName = microtime().'.'.$extractFile['extension'];

            //pindahkan file yang di upload ke directory tujuan bila berhasil jalankan perintah query untuk mennyimpan ke database
            if (move_uploaded_file($foto['tmp_name'],$dir.$newName)) {

               include('../../include/connection.php');

               $sql = $con->prepare("INSERT INTO t_kandidat(nama_calon, foto, visi, misi, periode) VALUES(?, ?, ?, ?, ?)") or die($con->error);
               $sql->bind_param('sssss', $nama, $newName, $visi, $misi, $periode);
               $sql->execute();

               header('location:../dashboard.php?page=kandidat');

            } else {

               echo '<script type="text/javascript">alert("Foto gagal diupload");window.history.go(-1);</script>';

            }

         }

      } else {

         echo '<script type="text/javascript">alert("Tidak ada foto yang dipilih");window.history.go(-1);</script>';

      }

   }

}
