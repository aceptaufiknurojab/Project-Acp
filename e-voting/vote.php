<?php
define("BASEPATH", dirname(__FILE__));
session_start();
if (!isset($_SESSION['siswa'])) {
   header('location:./index.php');
}

?>
<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8">
   <title>E - Voting</title>
   <link rel="stylesheet" href="./assets/css/foundation.min.css" />
   <link rel="stylesheet" href="./assets/css/animate.css" />
   <style media="screen">
      body {
         background-color: #011b3b;
         color: #fff;
      }

      .img {
         min-height: 250px;
         max-height: 250px;
         max-width: 250px;
      }

      .button.success {
         background-color: #059f3e;
         color: #ebebeb;
      }

      .button.success:hover,
      .button.success:focus {
         background-color: #22bb5b;
         color: #fefefe;
      }
   </style>
</head>

<body>
   <div class="container">
      <?php
      require('./include/connection.php');

      $thn     = date('Y');
      $dpn     = date('Y') + 1;
      $periode = $thn . '/' . $dpn;

      $sql = $con->prepare("SELECT k.id_kandidat AS id_kandidat, nama_calon, foto, visi, misi, COUNT(su.id_kandidat) AS suara, k.periode AS periode FROM t_kandidat k LEFT JOIN t_suara su ON(k.id_kandidat = su.id_kandidat) WHERE k.periode = ? GROUP BY k.id_kandidat") or die($con->error);
      $sql->bind_param('s', $periode);
      $sql->execute();
      $sql->store_result();
      if ($sql->num_rows() > 0) {
         $numb = $sql->num_rows();
         echo '<div class="text-center" style="padding-top:20px;">
                     <h2>Daftar Calon Ketua HIMMAN Periode 2020/2021</h2>
                  </div>
                  <hr />';

         echo '<div class="row">';

         echo '<div class="medium-10 medium-offset-1 columns">';

         for ($i = 1; $i <= $numb; $i++) {
            $sql->bind_result($id, $nama, $foto, $visi, $misi, $suara, $periode);
            $sql->fetch();
            ?>
            <div class="medium-4 columns">
               <section class="wow fadeInDown" data-wow-delay="<?php echo $i; ?>s">
                  <div class="callout text-center">
                     <img src="./assets/img/kandidat/<?php echo $foto; ?>" class="img">
                     <p style="font-size:20px;"><?php echo $nama; ?></p>
                     <div>
                        <a href="./detail.php?id=<?php echo $id; ?>" class="button alert">Lihat Visi Misi</a>
                        <a href="./submit.php?id=<?php echo $id; ?>" class="button">Beri Suara</a>
                     </div>
                  </div>
               </section>
            </div>

         <?php
      }

      echo '</div>';
   } else {

      echo '<div class="callout warning">
                     <h2>Belum Ada Calon Ketua</h2>
                  </div>';
   }

   echo '</div>';
   ?>
   </div>

   <script type="text/javascript" src="./assets/js/jquery.js"></script>
   <script type="text/javascript" src="./assets/js/wow.js"></script>
   <script type="text/javascript">
      wow = new WOW({
         animateClass: 'animated',
         offset: 100,
         callback: function(box) {
            console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
         }
      });
      wow.init();
   </script>
</body>

</html>