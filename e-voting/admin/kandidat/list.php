<?php
if (!isset($_SESSION['id_admin'])) {
   header('location: ../');
}
?>

<div class="row">
   <div class="medium-9 columns">
      <h3>Daftar Kandidat HIMMAN</h3>
   </div>
   <div class="medium-3 columns" style="padding-top:10px;">
      <a class="button" href="?page=kandidat&action=tambah">Tambah Kandidat</a>
   </div>
   <hr />
   <div class="row">
      <div class="medium-5 columns">
         <select id="periode">
            <option value="">-- Pilih Periode--</option>
            <?php
            for ($i = 16; $i < 30; $i++) {
               $k = $i + 1;
               echo '<option value="20' . $i . '/20' . $k . '">Periode 20' . $i . ' / 20' . $k . '</option>';
            }
            ?>
         </select>
      </div>
   </div>
   <div id="data">
   </div>
</div>