<?php
if(!isset($_SESSION['id_admin'])) {
   header('location: ../');
}
?>
<div class="medium-9 columns">
   <h3>Daftar Kelas</h3>
</div>
<div class="medium-3 columns" style="padding-top:10px;">
   <a class="button" href="?page=kelas&action=tambah">Tambah Program Studi</a>
</div>
<hr />
<div class="row">
   <div class="large-9 columns">
      <table>
         <thead>
            <tr>
               <th width="80px" style="text-align:center;">Prodi</th>
               <th style="text-align:center;">Fakultas</th>
               <th width="150px" style="text-align:center;">Jumlah Mahasiswa</th>
               <th width="200px" style="text-align:center;">Opsi</th>
            </tr>
         </thead>
         <tbody>
            <?php
            require('../include/connection.php');
            $sql = mysqli_query($con, "SELECT a.*, (SELECT COUNT(id_kelas) FROM t_user WHERE jk = a.id_kelas) AS jumlah FROM t_kelas a ORDER BY a.id_kelas ASC");

            if (mysqli_num_rows($sql) > 0) {

               while($data = mysqli_fetch_array($sql)) {
                  ?>
                  <tr>
                     <td style="text-align:center;">
                        <?php echo $data['id_kelas']; ?>
                     </td>
                     <td style="text-align:center;">
                        <?php echo $data['nama_kelas']; ?>
                     </td>
                     <td style="text-align:center;">
                        <?php echo $data['jumlah']; ?> Mahasiswa
                     </td>
                     <td style="text-align:center;">
                        <a href="?page=kelas&action=edit&id=<?php echo $data['id_kelas']; ?>" class="button">
                           Edit
                        </a>
                        <a href="?page=kelas&action=hapus&id=<?php echo $data['id_kelas']; ?>" onclick="return confirm('Yakin ingin menghapus kelas ini ?');" class="button alert">
                           Hapus
                        </a>
                     </td>
                  </tr>
                  <?php
               }
            } else {

               echo "<tr>
                        <td colspan='4' style='text-align:center;'><h4>Belum ada data</h4></td>
                     </tr>";
            }
            ?>
         </tbody>
      </table>
   </div>
</div>
