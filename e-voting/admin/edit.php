<?php
// if (!isset($_SESSION['id_admin'])) {
//    header('location:./');
// }

if (isset($_POST['update_profil'])) {

   $nama     = $_POST['username'];
   $fullname = $_POST['fullname'];
   $pass     = $_POST['pass'];

   if($nama == '' || $fullname == '' || $pass == '') {

      echo '<script type="text/javascript">alert("Semua form harus diisi");</script>';

   } else {

      $get = $con->prepare("SELECT * FROM t_admin WHERE id_admin = ?") or die($con->error);
      $get->bind_param('i', $_SESSION['id_admin']);
      $get->execute();
      $get->store_result();

      if($get->num_rows() > 0) {

         $get->bind_result($id, $nama1, $full, $password);
         $get->fetch();

         //validasi password
         if(password_verify($pass, $password)) {

            $sql = $con->prepare("UPDATE t_admin SET username = ?, fullname = ? WHERE id_admin = ?") or die($con->error);
            $sql->bind_param('ssi',$nama, $fullname, $id);
            $sql->execute();

            $_SESSION['user'] = $fullname;

            header('location: ./');

         } else {

            echo '<script type="text/javascript">alert("Akses Illegal !!");window.location.replace("?page=logout");</script>';

         }

      }

   }

}

$sql = $con->prepare("SELECT * FROM t_admin WHERE id_admin = ?");
$sql->bind_param('i', $_SESSION['id_admin']);
$sql->execute();
$sql->store_result();
$sql->bind_result($id, $username, $fullname, $pass);
$sql->fetch();
?>
<h3>Edit Profil</h3>
<hr />
<div class="row">
   <div class="medium-8 medium-offset-1 columns">
      <div class="callout" style="padding:30px 20px;">
         <h3 style="color:#666464;">Form Edit Profil</h3>
         <hr/>
         <br />
         <form action="" method="post">
            <div class="row">
               <div class="medium-3 columns">
                  <label>Username</label>
               </div>
               <div class="medium-9 columns">
                  <input type="text" name="username" value="<?php echo $username; ?>" required="Username" placeholder="Username">
               </div>
               <div class="medium-3 columns">
                  <label>Fullname</label>
               </div>
               <div class="medium-9 columns">
                  <input type="text" name="fullname" value="<?php echo $fullname; ?>" required="Fullname" placeholder="Fullname">
               </div>
               <div class="medium-3 columns">
                  <label>Password</label>
               </div>
               <div class="medium-9 columns">
                  <input type="password" name="pass" required="Password" placeholder="Password">
                  <p class="help-text">Masukkan password anda</p>
               </div>
               <div class="medium-9 medium-offset-1 columns">
                  <input type="submit" name="update_profil" class="button" value="Update Profil">
                  <button onclick="window.history.go(-1)" class="button alert">Kembali</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
