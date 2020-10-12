<?php
if (!isset($_SESSION['id_admin'])) {
   header('location: ../');
}

if (isset($_GET['action'])) {

   switch ($_GET['action']) {
      case 'tambah':
         include('./kelas/add.php');
         break;

      case 'edit':
         include('./kelas/edit.php');
         break;

      case 'hapus':

         if (isset($_GET['id'])) {

            $id_kelas   = strip_tags(mysqli_real_escape_string($con, $_GET['id']));

            $sql        = $con->prepare("DELETE FROM t_kelas WHERE id_kelas = ?");
            $sql->bind_param('s', $id_kelas);
            $sql->execute();

            header('location: ?page=kelas');

         } else {

            header('location: ./');

         }

         break;
      default:
         include('./kelas/list.php');
         break;
   }

} else {

   include('./kelas/list.php');

}
?>
