

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-sm-none d-md-block">
      
    </div>
    <!-- Default to the left -->
    <strong>CopyRight &copy; 2022 <a href="http://github.com/hesammousavi/"> Aref Solaimany</a>.</strong>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="../dist/js/demo.js"></script>
<!-- iCheck -->
<script src="../plugins/iCheck/icheck.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../plugins/ckeditor/ckeditor.js"></script>

<!-- Ticket Page Script -->
<script>
  $(function () {
    //Add text editor
      ClassicEditor
          .create(document.querySelector('#compose-textarea'))
          .then(function (editor) {
              // The editor instance
          })
          .catch(function (error) {
              console.error(error)
          })

//    $('#compose-textarea').wysihtml5()
  })
</script>
<!-- PAGE PLUGINS -->
<!-- SparkLine -->
<script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jVectorMap -->
<script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.2 -->
<script src="../plugins/chartjs-old/Chart.min.js"></script>
<?php  include 'chartDebt.php'; ?>
<!-- PAGE SCRIPTS -->
<!--script src="../dist/js/pages/dashboard2.js"></script-->
</body>
<?php
mysqli_close($conn);

?>
</html>
