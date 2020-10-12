<?php
if (!isset($_SESSION['id_admin'])) {
   header('location: ../');
}

$id = strip_tags(mysqli_real_escape_string($con, $_GET['id']));
$sql = $con->prepare("SELECT k.id_kandidat AS id_kandidat, nama_calon, foto, visi, misi, COUNT(su.id_kandidat) AS suara, k.periode AS periode FROM t_kandidat k LEFT JOIN t_suara su ON(k.id_kandidat = su.id_kandidat) WHERE k.id_kandidat = ? GROUP BY k.id_kandidat") or die($con->error);
$sql->bind_param('i', $id);
$sql->execute();
$sql->store_result();
$sql->bind_result($id, $nama, $foto, $visi, $misi, $suara, $periode);
$sql->fetch();
?>
<h3>Detail Kandidat</h3>
<hr />
<div class="row">
   <div class="medium-3 columns">
      <div class="callout text-center">
         <img src="../assets/img/kandidat/<?php echo $foto; ?>" alt="">
      </div>
   </div>
   <div class="medium-9 columns" style="padding-top:20px;">
      <table>
         <tbody>
            <tr>
               <td style="padding: 10px;">Nama Kandidat</td>
               <td style="padding: 10px;">:</td>
               <td> <?php echo $nama; ?></td>
            </tr>
            <tr>
               <td style="padding: 10px;">Visi</td>
               <td style="padding: 10px;">:</td>
               <td><?php echo $visi; ?></td>
            </tr>
            <tr>
               <td style="padding: 10px;">Misi</td>
               <td style="padding: 10px;">:</td>
               <td><?php echo $misi; ?></td>
            </tr>
            <tr>
               <td style="padding: 10px;">Jumlah Suara</td>
               <td style="padding: 10px;">:</td>
               <td><?php echo $suara; ?></td>
            </tr>
            <tr>
               <td style="padding: 10px;">Periode</td>
               <td style="padding: 10px;">:</td>
               <td><?php echo $periode; ?></td>
            </tr>
         </tbody>
      </table>
      <a href="?page=kandidat" class="button alert">Kembali</a>
      <a href="?page=kandidat&action=edit&id=<?php echo $id; ?>" class="button">Edit</a>
   </div>
</div>