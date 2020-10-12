<?php defined('BASEPATH') or die("No access direct allowed"); ?>
<script type="text/javascript" src="../assets/js/jquery.js"></script>
<script type="text/javascript" src="../assets/js/foundation.js"></script>
<script type="text/javascript" src="../assets/js/docs.js"></script>
<?php if (isset($_GET['page']) && $_GET['page'] == 'perolehan') { ?>
   <script type="text/javascript" src="../assets/js/chart-bundle.js"></script>
   <script type="text/javascript" src="../assets/js/utils.js"></script>
   <script type="text/javascript" src="../assets/js/FileSaver.min.js"></script>
   <script type="text/javascript" src="../assets/js/canvas-toBlob.js"></script>
<?php } ?>
<script type="text/javascript">
   // slideToggle()
   $(document).ready(function() {
      $(".dropdown-toggle").click(function() {
         $(this).parent().find(".dropdown-menu").slideToggle();
      });
      $("#menu-toggle").click(function() {
         $(this).parent().find(".menu").slideToggle();
      });
   });

   $("#save-img").click(function() {
      $('#canvas').get(0).toBlob(function(blob) {
         saveAs(blob, 'chart.png');
      });
   });
   <?php
   if (isset($_GET['page']) && $_GET['page'] == 'kandidat') { ?>

      function tampil() {
         $.ajax({
            url: 'ajax.php',
            method: "GET",
            success: function(data) {
               $('#data').html(data);
            }
         });
      }

      $(document).ready(function() {
         $('#periode').change(function() {
            var periode = $('#periode').val();

            $.ajax({
               url: "ajax.php",
               method: "POST",
               data: {
                  periode: periode
               },
               success: function(data) {
                  $('#data').html(data);
               }
            });
         });
      });

      window.onload = function() {
         tampil();
      };
   <?php
}
?>
   <?php
   if (isset($_GET['page']) && $_GET['page'] == 'perolehan') {
      $thn = date('Y');
      $dpn = date('Y') + 1;
      $periode = $thn . '/' . $dpn;
      $kan = $con->prepare("SELECT k.id_kandidat AS id_kandidat, nama_calon, foto, visi, misi, COUNT(su.id_kandidat) AS suara, k.periode AS periode FROM t_kandidat k LEFT JOIN t_suara su ON(k.id_kandidat = su.id_kandidat) WHERE k.periode = ? GROUP BY k.id_kandidat") or die($con->error);
      $kan->bind_param('s', $periode);
      $kan->execute();
      $kan->store_result();
      $numb = $kan->num_rows();
      $label = '';
      $data = '';
      for ($i = 1; $i <= $numb; $i++) {
         $kan->bind_result($id, $nama, $foto, $visi, $misi, $suara, $kandidat);
         $kan->fetch();
         $label .= "'" . $nama . "',";
         $data .= $suara . ',';
      }
      $labels = trim($label, ',');
      $datas  = trim($data, ',');
      ?>
      var chartData = {
         labels: [
            <?php
            echo $labels;
            ?>
         ],
         datasets: [{
            type: 'bar',
            label: 'Jumlah Suara',
            borderColor: window.chartColors.green,
            backgroundColor: [
               window.chartColors.blue,
               window.chartColors.red,
               window.chartColors.green,
            ],
            borderWidth: 2,
            fill: false,
            data: [
               <?php
               echo $datas;
               ?>
            ]
         }],
      };
      window.onload = function() {
         var ctx = document.getElementById("canvas").getContext("2d");
         window.myMixedChart = new Chart(ctx, {
            type: 'bar',
            data: chartData,
            options: {
               responsive: true,
               title: {
                  display: true,
                  text: 'Perolehan Suara',
                  fontSize: 40
               },
               legend: {
                  labels: {
                     fontSize: 20
                  }
               },
               scales: {
                  xAxes: [{
                     ticks: {
                        fontSize: 15
                     }
                  }],
                  yAxes: [{
                     ticks: {
                        fontSize: 15,
                        min: 0
                     }
                  }]
               }
            }
         });
      };
   <?php
}
?>
</script>