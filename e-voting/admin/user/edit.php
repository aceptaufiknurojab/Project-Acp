<?php
if(!isset($_SESSION['id_admin'])) {
   header('location: ../');
}

$id   = strip_tags(mysqli_real_escape_string($con, $_GET['id']));

$sql  = $con->prepare("SELECT * FROM t_user WHERE id_user = ?") or die($con->error);
$sql->bind_param('s', $id);
$sql->execute();
$sql->store_result();
$sql->bind_result($id_user, $fullname, $kls, $jk, $pemilih);
$sql->fetch();

?>
<h3>Update Data Siswa</h3>
<hr />
<div class="row">
   <div class="medium-6">
      <form action="./user/update.php" method="post">
         <div>
            <label>NIM</label>
            <input class="wide password input" type="text" name="nis" placeholder="NIS" type="number" readonly value="<?php echo $id_user; ?>"/>
         </div>
         <div>
            <label>Nama Mahasiswa</label>
            <input class="wide password input" name="nama" type="text" placeholder="Nama Siswa" value="<?php echo $fullname; ?>"/>
         </div>
         <div>
            <label>Program Studi</label>
            <select name="jk" required="kelas">
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
            <select name="kelas" required="semester">
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
         <input type="submit" name="update" value="Update User" class="button"/>
         <button onclick="window.history.go(-1)" class="button alert">Kembali</button>
      </form>
   </div>
</div>
