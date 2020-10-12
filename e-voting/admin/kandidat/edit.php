<?php
if (!isset($_SESSION['id_admin']) || !isset($_GET['id'])) {
   header('location:../');
}

$id   = $_GET['id'];
$sql  = $con->prepare("SELECT id_kandidat, nama_calon, foto, visi, misi, periode FROM t_kandidat WHERE id_kandidat = ?") or die($con->error);
$sql->bind_param('i', $id);
$sql->execute();
$sql->store_result();
$sql->bind_result($id, $nama, $foto, $visi, $misi, $periode);
$sql->fetch();
?>
<h3>Edit Data Kandidat</h3>
<hr />
<div class="row">
   <div class="medium-4 columns">
      <div class="callout text-center">
         <img src="../assets/img/kandidat/<?php echo $foto; ?>" class="kandidat" />
      </div>
   </div>
   <div class="medium-8 columns">
      <div class="callout">
         <form action="./kandidat/update.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <input type="hidden" name="f" value="<?php echo $foto; ?>" />
            <div class="row">
               <div class="medium-3 columns">
                  <label>Nama Kandidat</label>
               </div>
               <div class="medium-9 columns">
                  <input type="text" name="nama" required="Nama" value="<?php echo $nama; ?>" />
               </div>
            </div>
            <div class="row">
               <div class="medium-3 columns">
                  <label>Foto Kandidat</label>
               </div>
               <div class="medium-6 medium-pull-3 columns">
                  <input type="file" name="foto" />
               </div>
            </div>
            <div class="row">
               <div class="medium-3 columns">
                  <label class="inline">Visi</label>
               </div>
               <div class="medium-9 columns">
                  <textarea name="visi" rows="3" required="Visi"><?php echo $visi; ?></textarea>
               </div>
            </div>
            <div class="row">
               <div class="medium-3 columns">
                  <label class="inline">Misi</label>
               </div>
               <div class="medium-9 columns">
                  <textarea name="misi" rows="3" required="Misi"><?php echo $misi; ?></textarea>
               </div>
            </div>
            <div class="row" style="padding-top:20px;">
               <div class="medium-6 medium-offset-3 columns">
                  <input type="submit" name="update" value="Update Kandidat" class="button" />
                  <button onclick="window.history.go(-1)" class="button alert">Kembali</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>