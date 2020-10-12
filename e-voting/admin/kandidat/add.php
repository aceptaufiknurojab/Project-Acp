<?php
if (!isset($_SESSION['id_admin'])) {
   header('location: ../');
}
?>
<h3>Tambah Kandidat</h3>
<hr />
<div class="row">
   <div class="medium-8 columns">
      <form action="./kandidat/simpan.php" method="post" enctype="multipart/form-data">
         <div class="row">
            <div class="medium-3 columns">
               <label>Nama Kandidat</label>
            </div>
            <div class="medium-9 columns">
               <input type="text" name="nama" required="Nama" />
            </div>
         </div>
         <div class="row">
            <div class="medium-3 columns">
               <label>Foto Kandidat</label>
            </div>
            <div class="medium-6 medium-pull-3 columns">
               <input type="file" name="foto" required="Foto" />
            </div>
         </div>
         <div class="row">
            <div class="medium-3 columns">
               <label class="inline">Visi</label>
            </div>
            <div class="medium-9 columns">
               <textarea name="visi" rows="3" required="Visi"></textarea>
            </div>
         </div>
         <div class="row">
            <div class="medium-3 columns">
               <label class="inline">Misi</label>
            </div>
            <div class="medium-9 columns">
               <textarea name="misi" rows="3" required="Misi"></textarea>
            </div>
         </div>
         <div class="row" style="padding-top:20px;">
            <div class="medium-6 medium-offset-3 columns">
               <input type="submit" name="add_kandidat" value="Tambah Kandidat" class="button" />
               <button onclick="window.history.go(-1)" class="button alert">Kembali</button>
            </div>
         </div>
      </form>
   </div>
</div>