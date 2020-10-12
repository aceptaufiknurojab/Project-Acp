<?php
define("BASEPATH", dirname(__FILE__));
session_start();

if (!isset($_SESSION['id_admin'])) {
   header('location:./');
}

include('../include/connection.php');

if (isset($_POST['periode'])) {
   $periode = $_POST['periode'];
} else {
   $now     = date('Y');
   $dpn     = date('Y') + 1;
   $periode = $now . '/' . $dpn;
}

$get = $con->prepare("SELECT k.id_kandidat AS id_kandidat, nama_calon, foto, visi, misi, COUNT(su.id_kandidat) AS suara, k.periode AS periode FROM t_kandidat k LEFT JOIN t_suara su ON(k.id_kandidat = su.id_kandidat) WHERE k.periode = ? GROUP BY k.id_kandidat");
$get->bind_param('s', $periode);
$get->execute();
$get->store_result();
$htg = $get->num_rows();

if ($htg > 0) {
   ?>
   <div class="row">
      <?php
      for ($i = 0; $i < $htg; $i++) {
         $get->bind_result($id, $nama, $foto, $visi, $misi, $suara, $per);
         $get->fetch();
         ?>
         <div class="medium-4 columns">
            <div class="callout">
               <div class="text-center">
                  <img class="kandidat" src="../assets/img/kandidat/<?php echo $foto; ?>">
                  <div class="suara">
                     <span class="badge"><?php echo $suara; ?> Suara</span>
                  </div>
               </div>
               <div class="name">
                  <?php echo $nama; ?>
               </div>
               <div class="text-center">
                  <a href="?page=kandidat&action=edit&id=<?php echo $id; ?>" class="button">Edit</a>
                  <a href="?page=kandidat&action=view&id=<?php echo $id; ?>" class="button success">View</a>
                  <a href="?page=kandidat&action=hapus&id=<?php echo $id; ?>" class="button alert" onclick="return confirm('Yakin ingin menghapus kandidat ini ?')">Hapus</a>
               </div>
            </div>
         </div>
      <?php
   }
   ?>
   </div>
<?php
} else {

   echo '<div class="medium-8 medium-offset-2" style="padding-top:60px;">
            <div class="warning callout" style="padding: 30px 20px; text-align: center; color:#545252;">
               <h4>Tidak ada kandidat</h4>
            </div>
         </div>';
}
?>