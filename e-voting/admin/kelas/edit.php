<?php
if(!isset($_SESSION['id_admin']) && !isset($_GET['id'])) {
   header('location: ../');
}
$id = strip_tags(mysqli_real_escape_string($con, $_GET['id']));

$sql = $con->prepare("SELECT * FROM t_kelas WHERE id_kelas = ?");
$sql->bind_param('s', $id);
$sql->execute();
$sql->store_result();
$num = $sql->num_rows();
$sql->bind_result($idk, $kelas);
$sql->fetch();

if ($num > 0) {
?>
<h3>Update Kelas</h3>
<hr />
<div class="row">
   <div class="medium-6 columns">
      <form action="./kelas/update.php" method="post">
         <label>Id Kelas</label>
         <input class="wide text input" type="text" name="id" readonly value="<?php echo $idk; ?>" />
         <label>Nama Kelas</label>
         <input class="wide password input" name="kelas" type="text" placeholder="Nama Kelas" value="<?php echo $kelas; ?>"/>
         <input type="submit" name="update" value="Update" class="button"/>
         <button type="button" onclick="window.history.go(-1)" class="button alert">
            Kembali
         </button>
      </form>
   </div>
</div>


<?php
} else {
   header('location:?page=kelas');
}
?>
