<?php defined('BASEPATH') or die("No Access Allowed");?>

<h2 class="index-header">Selamat Datang di Aplikasi E - Voting<br />Dewan Perwakilan Mahasiswa Fakultas Ekonomi<br />Unigal</h2>
<div class="row">
   <div class="large-4 large-offset-1 medium-4 columns">
      <div id="content-slider">
         <img src="./assets/img/unigal.png" class="img" alt="Slideshow 1" >
         <img src="./assets/img/dpm.jpg" class="img" alt="Slideshow 2" >
         <img src="./assets/img/voting.png" class="img" alt="Slideshow 3" >
      </div>
   </div>
   <div class="large-6 medium-6 columns form">
      <span class="info-login">Silahkan Login untuk dapat melakukan pemilihan</span>
      <br />
      <br />
      <form action="" method="post">
         <label>Masukkan Nim Anda</label>
         <br />
         <input type="text" placeholder="NIM"required="NIS" name="nis"/>
         <br />
         <div class="row">
            <div class="text-right" style="padding-right:15px;">
               <input type="submit" name="submit" class="button alert large" value="Login">
            </div>
         </div>
      </form>
   </div>
</div>
