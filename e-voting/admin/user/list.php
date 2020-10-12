<?php
if(!isset($_SESSION['id_admin'])) {
   header('location: ../');
}
?>
<div class="row">
   <div class="medium-9 columns">
      <h3>Daftar Mahasiswa</h3>
   </div>
   <div class="medium-3 columns" style="padding-top:10px;">
      <a class="button" href="?page=user&action=tambah">Tambah Mahasiswa</a>
   </div>
   <hr />
   <br />
   <table>
         <thead>
            <tr>
               <th style="text-align:center;">No</th>
               <th style="text-align:center;">Nim</th>
               <th style="text-align:center;">Nama Mahasiswa</th>
               <th style="text-align:center">Semester</th>
               <th width="130px" style="text-align:center;">Program Studi</th>
               <th width="200px" style="text-align:center;">Opsi</th>
            </tr>
         </thead>
         <tbody>
            <?php
            require('../include/connection.php');

            if (isset($_GET['hlm'])) {
      			$hlm = $_GET['hlm'];
      			$no  = (5*$hlm) - 4;
      		} else {
      			$hlm = 1;
      			$no  = 1;
      		}
            $start  = ($hlm - 1) * 5;

            $sql = mysqli_query($con, "SELECT * FROM t_user WHERE id_user LIMIT $start,5");

            if (mysqli_num_rows($sql) > 0) {

               $i = 1;
               while($data = mysqli_fetch_array($sql)) {
                  ?>
                  <tr>
                     <td style="text-align:center;">
                        <?php echo $no++; ?>
                     </td>
                     <td style="padding-left:25px;">
                        <?php echo $data['id_user']; ?>
                     </td>
                     <td style="text-align:center;">
                        <?php echo $data['fullname']; ?>
                     </td>
                     <td style="text-align:center;">
                        <?php echo $data['id_kelas']; ?>
                     </td>
                     <td style="text-align:center;">
                        <?php echo $data['jk']; ?>
                     </td>
                     <td style="text-align:center;">
                        <a href="?page=user&action=edit&id=<?php echo $data['id_user']; ?>" class="button" style="margin-top:10px;">
                           Edit
                        </a>
                        <a href="?page=user&action=hapus&id=<?php echo $data['id_user']; ?>" onclick="return confirm('Yakin ingin menghapus user ini ?');" class="button warning" style="margin-top:10px;">
                           Hapus
                        </a>
                     </td>
                  </tr>
                  <?php
               }

            } else {

               echo "<tr>
                        <td colspan='5' style='text-align:center;'><h4>Belum ada data</h4></td>
                     </tr>";
            }
            ?>
         </tbody>
      </table>
      <?php
      echo '<ul class="pagination">';
         if($hlm > 1){ //start if
            $hlmn = $hlm - 1;
      ?>
            <li class="waves-effect">
               <a href="?page=user&hlm=<?php  echo $hlmn; ?>">
                  <i class='fa fa-caret-left'></i> Prev
               </a>
            </li>
      <?php
         }		//end if $hlm > 1


         $hitung = mysqli_num_rows(mysqli_query($con, "SELECT * FROM t_user"));

         $total  = ceil($hitung / 5);
         for ($i = 1; $i <= $total ; $i++) { //start for
      ?>
            <li <?php if ($hlm != $i) { echo 'class="waves-effect"'; } else { echo 'class="active"'; } ?>>
               <a href="?page=user&hlm=<?php  echo $i; ?>">
                  <?php  echo $i; ?>
               </a>
            </li>
         <?php
         } // end for

         if ($hlm < $total) { //start if $hlm < $total
            $next = $hlm + 1;
         ?>
            <li class="waves-effect">
               <a href="?page=user&hlm=<?php  echo $next; ?>">
                  Next <i class='fa fa-caret-right'></i>
               </a>
            </li>
         <?php
         }	//end if $hlm < $total

      echo '</ul>';	//end pagination
      ?>
</div>
