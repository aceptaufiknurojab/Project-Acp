<?php
session_start();
if (!isset($_SESSION['id_admin'])) {
   header('location: ./');
}
define('BASEPATH', dirname(__FILE__));

include('../include/connection.php');
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Dashboard ~ E Voting</title>
      <link rel="stylesheet" href="../assets/css/foundation.min.css" />
      <link rel="stylesheet" href="../assets/css/dashboard.css" />
   </head>
   <body>
      <div class="container">
         <div class="row">
            <?php
            include('../include/navbar.php');
            ?>

            <div id="main" class="large-10 medium-9 columns">
               <!-- Modal -->
               <div class="reveal" id="animatedModal10" data-reveal data-close-on-click="true" data-animation-in="fade-in" data-animation-out="fade-out">
                  <h4 style="margin-bottom:1px">Warning</h4>
                  <hr />
                  <p style="font-size:18px">Apakah anda yakin ingin keluar dari aplikasi ?</p>
                  <div class="text-right">
                     <a href="?page=logout" class="button alert">Logout</a>
                  </div>
                  <button class="close-button" data-close aria-label="Close reveal" type="button">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>

               <?php
               if(isset($_GET['page'])) {
                  switch ($_GET['page']) {
                     case 'user':
                        include('./user/index.php');
                        break;
                     case 'kelas':
                        include('./kelas/index.php');
                        break;
                     case 'kandidat':
                        include('./kandidat/index.php');
                        break;
                     case 'user':
                        include('./user/index.php');
                        break;
                     case 'perolehan':
                        include('./perolehan.php');
                        break;
                     case 'edit_profil':
                        include('./edit.php');
                        break;
                     case 'change_password':
                        include('./pass.php');
                        break;
                     case 'logout':
                        unset($_SESSION['id_admin']);
                        unset($_SESSION['user']);

                        header('location:./');
                        break;
                     default:
                        include('./welcome.php');
                        break;
                  }
               } else {
                  include('./welcome.php');
               }
               ?>
               <div class="text-center no-print" style="margin-top:60px;">
                  Copyright &copy; DPM Fakultas Ekonomi Universitas Galuh
               </div>
            </div>
         </div>
      </div>
      <?php include('../include/footer.php'); ?>
   </body>
</html>
