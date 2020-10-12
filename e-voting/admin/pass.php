<?php
if (!isset($_SESSION['id_admin'])) {
   header('location:./');
}

if (isset($_POST['update_pass'])) {

   $get = $con->prepare("SELECT password FROM t_admin WHERE id_admin = ?");
   $get->bind_param('i', $_SESSION['id_admin']);
   $get->execute();
   $get->store_result();
   if ($get->num_rows() > 0) {

      $get->bind_result($password);
      $get->fetch();

      $pass1 = mysqli_real_escape_string($con, $_POST['lama']);
      $pass2 = password_hash(mysqli_real_escape_string($con,$_POST['baru']), PASSWORD_BCRYPT, ['cost' => 10]);

      if(password_verify($pass1, $password)) {

         $get = $con->prepare("UPDATE t_admin SET password = ? WHERE id_admin = ?");
         $get->bind_param('si', $pass2, $_SESSION['id_admin']);
         $get->execute();

         echo '<script type="text/javascript">window.location.replace("?page=logout");</script>';

      } else {

         echo '<script type="text/javascript">alert("Akses Illegal");window.location.replace("?page=logout");</script>';

      }

   } else {

      echo '<script type="text/javascript">alert("Akses Illegal");window.location.replace("?page=logout");</script>';

   }

}
?>
<h3>Ganti Password</h3>
<hr />
<div class="row">
   <div class="medium-8 medium-offset-1 columns">
      <div class="callout" style="padding:30px 20px;">
         <h3 style="color:#666464;">Form Update Password</h3>
         <hr/>
         <br />
         <form action="" method="post">
            <div class="row">
               <div class="medium-3 columns">
                  <label>Password Lama</label>
               </div>
               <div class="medium-9 columns">
                  <input type="password" name="lama" placeholder="Password Lama" required="Password" />
               </div>
               <div class="medium-3 columns">
                  <label>Password Baru</label>
               </div>
               <div class="medium-9 columns">
                  <input type="password" name="baru" placeholder="Password Baru" required="Password" />
               </div>
               <div class="medium-9 medium-offset-1 columns">
                  <p class="help-text" style="color:#666464;">Anda harus login ulang saat password berhasil diupdate</p>
                  <input type="submit" name="update_pass" class="button" value="Update Password">
                  <button onclick="window.history.go(-1)" class="button alert">Kembali</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
