<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8">
   <title>Profil Calon ~ E - Voting</title>
   <link rel="stylesheet" href="./assets/css/foundation.min.css" />
   <style type="text/css">
      body {
         background-color: #011b3b;
      }

      .img {
         max-height: 300px;
         max-width: 250px;
         min-height: 250px;
      }
   </style>
</head>

<body>
   <div class="container">
      <div class="text-center" style="padding-top:20px; color:#eee;">
         <h2>Profil Calon Ketua</h2>
      </div>
      <hr />

      <?php
      define('BASEPATH', dirname(__FILE__));
      session_start();

      if (!isset($_SESSION['siswa'])) {
         header('location:./');
      }

      if (isset($_GET['id'])) {

         require('./include/connection.php');

         $sql = $con->prepare("SELECT k.id_kandidat AS id_kandidat, nama_calon, foto, visi, misi, COUNT(su.id_kandidat) AS suara, k.periode AS periode FROM t_kandidat k LEFT JOIN t_suara su ON(k.id_kandidat = su.id_kandidat) WHERE k.id_kandidat = ? GROUP BY k.id_kandidat") or die($con->error);
         $sql->bind_param('i', $_GET['id']);
         $sql->execute();
         $sql->store_result();
         $sql->bind_result($id, $nama, $foto, $visi, $misi, $suara, $periode);
         $sql->fetch();
         ?>
         <div class="row">
            <div class="medium-10 medium-offset-1 columns">
               <div class="row">
                  <div class="medium-4 columns">
                     <div class="callout text-center">
                        <img class="img" src="./assets/img/kandidat/<?php echo $foto; ?>">
                     </div>
                  </div>

                  <div class="medium-8 columns">
                     <h3 style="color:#eee">Informasi Calon</h3>
                     <table>
                        <tr>
                           <td>Nama Calon</td>
                           <td>: <?php echo $nama; ?></td>
                        </tr>
                        <tr>
                           <td>Visi</td>
                           <td>: <?php echo nl2br($visi); ?></td>
                        </tr>
                        <tr>
                           <td>Misi</td>
                           <td>: <?php echo nl2br($misi); ?></td>
                        </tr>
                        <tr>
                           <td>Total Perolehan Suara</td>
                           <td>: <?php echo $suara; ?> Suara</td>
                        </tr>
                        <tr>
                           <td>Periode Pencalonan</td>
                           <td>: <?php echo $periode; ?></td>
                        </tr>
                     </table>
                     <div>
                        <button onclick="window.history.go(-1)" class="button alert">Kembali</button>
                        <a href="./submit.php?id=<?php echo $id; ?>" class="button">Beri Suara</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>

      <?php

   } else {

      header('loaction: ./');
   }
   ?>
   </div>
</body>

</html>