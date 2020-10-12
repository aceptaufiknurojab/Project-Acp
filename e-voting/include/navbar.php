<?php defined('BASEPATH') or die("No access direct allowed"); ?>
<div class="columns large-2 medium-3 small-12 no-print" id="nav">
   <a href="#" class="button" id="menu-toggle">Menu</a>
   <div class="menu">
      <img class="img" src="../assets/img/default.png">
      <ul>
         <li class="dropdown">
            <a href="#" class="dropdown-toggle"><?php echo strtoupper($_SESSION['user']); ?> <span class="float-right">&#9660;</span></a>
            <ul class="dropdown-menu">
               <li>
                  <a href="?page=edit_profil">Edit Profil</a>
               </li>
               <li>
                  <a href="?page=change_password">Ganti Password</a>
               </li>
               <li>
                  <a data-toggle="animatedModal10" href="#" >Logout</a>
               </li>
            </ul>
         </li>
         <li>
            <a href="./" >Dashboard</a>
         </li>
         <li>
            <a href="?page=user" >Manajemen User</a>
         </li>
         <li>
            <a href="?page=kandidat" >Manajemen Kandidat HIMMAN</a>
         </li>
         <li>
            <a href="?page=kelas" >Manajemen Prodi</a>
         </li>
         <li>
            <a href="?page=perolehan" >Perolehan</a>
         </li>
      </ul>
   </div>
</div>
