<?php
session_start();

if(isset($_SESSION['id_admin'])) {
   header('location: ./dashboard.php');
}

if(isset($_POST['submit'])) {
   define('BASEPATH', dirname(__FILE__));
   include('../include/connection.php');

   $user = $_POST['username'];
   $pass = mysqli_real_escape_string($con, $_POST['pass']);

   if ($user == null || $pass == null) {

      echo '<script type="text/javascript">alert("Username / Password tidak boleh kosong");</script>';

   } else {

      $log = $con->prepare("SELECT * FROM t_admin WHERE username = ?") or die($con->error);
      $log->bind_param('s', $user);
      $log->execute();
      $log->store_result();
      $jml = $log->num_rows();
      $log->bind_result($id, $username, $fullname, $password);
      $log->fetch();

      if ($jml > 0) {

         if (password_verify($pass, $password)) {

            $_SESSION['id_admin']   = $id;
            $_SESSION['user']       = $fullname;

            header('location:./dashboard.php');

         } else {

            echo '<script type="text/javascript">alert("Password Salah");</script>';
         }

      } else {

         echo '<script type="text/javascript">alert("Username tidak dikenali");</script>';

      }

   }
}
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Admin Login ~ E-Vote</title>
      <link rel="stylesheet" href="../assets/css/foundation.min.css">
      <style media="screen" type="text/css">
      body {
         background: #f9f9f9;
      }

      .callout {
         padding-top: 5%;
         border-color: #dbe2f1;
         box-shadow: 0 0 7px #d6e0f5;
         color: #777;
      }

      .heading {
         text-align: center;
         color: #777;
         margin-bottom: 3%;
         margin-top: 3%;
      }

      input[type="text"]:focus,
      input[type="password"]:focus {
         border-color: #a1bdf7;
         box-shadow: 0 0 8px #adc5f6;
      }

      label {
         font-size: 16px;
         color: #777;
         padding: 5px 0px;
      }

      hr {
         margin-bottom: 0;
         border-color: #dedede;
      }

      .button-right {
         padding-top: 10px;
         text-align: right;
      }

      .simple {
         font-size: 18px;
         padding: 15px 30px;
         border-radius: 3px;
      }
      </style>
   </head>
   <body>
      <div class="row">
         <h2 class="heading">Aplikasi E - Voting</h2>
         <div class="large-4 large-offset-4 coloumns">
            <form action="" method="post" class="callout">
               <h3>Please Sign In</h3>
               <hr />
               <br />
               <label>Username</label>
               <input type="text" name="username" placeholder="Username" required="Username">
               <label>Password</label>
               <input type="password" name="pass" placeholder="Password" required="Password">
               <div class="button-right">
                  <input type="submit" name="submit" class="simple button" value="Login">
               </div>
            </form>
         </div>
      </div>
      <div class="text-center" style="margin-top:60px; color: #777;">
         Copyright &copy; DPM Fakultas Ekonomi Universitas Galuh
      </div>
   </body>
</html>
