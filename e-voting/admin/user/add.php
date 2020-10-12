<?php
if(!isset($_SESSION['id_admin'])) {
   header('location: ../');
}

if(isset($_POST['add_user'])) {

   $nis  = $_POST['nis'];
   $nama = $_POST['nama'];
   $jk   = $_POST['jk'];
   $kls  = $_POST['kelas'];
   //cek nis
   $get_id = $con->prepare("SELECT * FROM t_user WHERE id_user = ?");
   $get_id->bind_param('s', $nis);
   $get_id->execute();
   $get_id->store_result();
   $numb = $get_id->num_rows();
   //validasi
   if($nis == null || $nama == null || $jk == null || $kls == null) {

      echo '<script type="text/javascript">alert("Semua form harus terisi");</script>';

   } else {

      $sql = $con->prepare("INSERT INTO t_user(id_user, fullname, id_kelas, jk) VALUES(?, ?, ?, ?)");
      $sql->bind_param('ssss', $nis, $nama, $jk, $kls);
      $sql->execute();

      header('location: ?page=user');

   }

}
?>
<h3>Tambah Data Siswa</h3>
<hr />
<div class="row">
   <div class="medium-6">
      <form action="" method="post">
         <div>
            <label>NIM</label>
            <input class="wide text input" type="text" name="nis" placeholder="NIM" type="number"/>
         </div>
         <div>
            <label>Nama Mahasiswa</label>
            <input class="wide password input" name="nama" type="text" placeholder="Nama Siswa"/>
         </div>
         <div>
            <label>Program Studi</label>
            <select name="kelas" required="kelas">
               <option value="#">-- Pilih Prodi --</option>
               <?php
                  $kelas = mysqli_query($con, "SELECT * FROM t_kelas");
                  while ($key = mysqli_fetch_array($kelas)) {
                  ?>
                     <option value="<?php echo $key['id_kelas']; ?>">
                        <?php echo $key['id_kelas']; ?>
                     </option>
                     <?php
                  }
               ?>
            </select>
            <label>Semeter</label>
            <select name="jk" required="semester">
               <option value="1">1</option>
               <option value="2">2</option>
               <option value="3">3</option>
               <option value="4">4</option>
               <option value="5">5</option>
               <option value="6">6</option>
               <option value="7">7</option>
               <option value="8">8</option>
               <option value="9">9</option>
            </select>
         </div>
         <input type="submit" name="add_user" value="Tambah User" class="button"/>
         <button onclick="window.history.go(-1)" class="button alert">Kembali</button>
      </form>
   </div>
</div>
