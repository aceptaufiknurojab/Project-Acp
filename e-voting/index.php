<?php
define('BASEPATH', dirname(__FILE__));
session_start();

if (isset($_SESSION['siswa'])) {
   header('location:./vote.php');
}

if (isset($_POST['submit'])) {

   require('include/connection.php');

   $nis     = $_POST['nis'];
   $thn     = date('Y');
   $dpn     = date('Y') + 1;
   $periode = $thn . '/' . $dpn;

   $cek = $con->prepare("SELECT * FROM t_suara WHERE nis = ? && periode = ?") or die($con->error);
   $cek->bind_param('ss', $nis, $periode);
   $cek->execute();
   $cek->store_result();

   if ($cek->num_rows() > 0) {

      echo '<script type="text/javascript">alert("Anda sudah memberikan suara");</script>';
   } else {

      $sql = $con->prepare("SELECT * FROM t_user WHERE id_user = ? && pemilih = 'Y'") or die($con->error);
      $sql->bind_param('s', $nis);
      $sql->execute();
      $sql->store_result();

      if ($sql->num_rows() > 0) {
         $sql->bind_result($id, $user, $kelas, $jk, $pemilih);
         $sql->fetch();

         $_SESSION['siswa'] = $id;

         header('location:./vote.php');
      } else {

         echo '<script type="text/javascript">alert("Anda tidak berhak memberikan suara");</script>';
      }
   }
}


?>
<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8">
   <title>E - Voting</title>
   <link rel="stylesheet" href="./assets/css/foundation.min.css" />
   <link rel="stylesheet" href="./assets/css/custom.css" />
   <style type="text/css">
      #content-slider {
         position: relative;
         width: 400px;
         height: 300px;
         overflow: hidden;
      }

      #content-slider img {
         display: block;
         width: 400px;
         height: 300px;
      }

      .img-thanks {
         max-width: 200px;
         width: 100%;
         max-height: 250px;
      }
   </style>
</head>

<body>
   <div class="row">
      <div class="large-12 columns">
         <?php
         if (isset($_GET['page'])) {
            switch ($_GET['page']) {
               case 'thanks':
                  include('./thanks.php');
                  break;

               default:
                  include('./form.php');
                  break;
            }
         } else {
            include('./form.php');
         }
         ?>

         <footer><?php echo date('Y'); ?> &copy; DPM Fakultas Ekonomi Universitas Galuh</footer>
      </div>
   </div>
   <script type="text/javascript" src="./assets/js/jquery.js"></script>
   <script type="text/javascript" src="./assets/js/jquery-cycle.min.js"></script>
   <script type="text/javascript">
      $(document).ready(function() {
         $('#content-slider').cycle({
            fx: 'fade',
            speed: 1000,
            timeout: 500
         });
      });
   </script>
</body>

</html>