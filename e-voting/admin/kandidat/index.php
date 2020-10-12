<?php
if (!isset($_SESSION['id_admin'])) {
   header('location: ../');
}

if (isset($_GET['action'])) {

   switch ($_GET['action']) {
      case 'tambah':
         include('./kandidat/add.php');
         break;

      case 'edit':
         include('./kandidat/edit.php');
         break;

      case 'view':
         include('./kandidat/view.php');
         break;

      case 'hapus':

         if (isset($_GET['id'])) {

            $id   = $_GET['id'];

            $sql   = $con->prepare("SELECT foto FROM t_kandidat WHERE id_kandidat = ?");
            $sql->bind_param('s', $id);
            $sql->execute();
            $sql->store_result();
            $sql->bind_result($f);
            $sql->fetch();
            unlink('../assets/img/kandidat/' . $f);

            $sql   = $con->prepare("DELETE FROM t_kandidat WHERE id_kandidat = ?");
            $sql->bind_param('s', $id);
            $sql->execute();

            header('location: ?page=kandidat');
         } else {

            header('location: ./');
         }

         break;
      default:
         include('./kandidat/list.php');
         break;
   }
} else {

   include('./kandidat/list.php');
}
