
<footer class="main-footer">
    <strong>Copyright &copy; <?php echo date("Y"); ?> <a href="https://digitalbdt.org/">Digitalbdt.org</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
     Developed by <b><a href="#">SARAIT</a></b>
    </div>
	
  </footer>


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ URL::to('backuser/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ URL::to('backuser/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<!-- Bootstrap 4 -->
<script src="{{ URL::to('backuser/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ URL::to('backuser/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ URL::to('backuser/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ URL::to('backuser/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ URL::to('backuser/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ URL::to('backuser/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ URL::to('backuser/plugins/moment/moment.min.js') }}"></script>
<script src="{{ URL::to('backuser/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ URL::to('backuser/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ URL::to('backuser/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ URL::to('backuser/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ URL::to('backuser/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ URL::to('backuser/dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ URL::to('backuser/dist/js/pages/dashboard.js') }}"></script>
<script src="{{ URL::to('backuser/plugins/toastr/toastr.min.js') }}"></script>

{{-- <script src="{{ mix('js/app.js') }}" defer></script> --}}
<!-- DataTables  & Plugins -->
<script src="{{ URL::to('backuser/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::to('backuser/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ URL::to('backuser/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::to('backuser/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ URL::to('backuser/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::to('backuser/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ URL::to('backuser/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ URL::to('backuser/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ URL::to('backuser/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ URL::to('backuser/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::to('backuser/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::to('backuser/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- DataTables  & Plugins -->
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>

<script>
    function showTime(){
        var date = new Date();
        var h = date.getHours(); // 0 - 23
        var m = date.getMinutes(); // 0 - 59
        var s = date.getSeconds(); // 0 - 59
        var session = "AM";

        if(h == 0){
            h = 12;
        }

        if(h > 12){
            h = h - 12;
            session = "PM";
        }

        h = (h < 10) ? "0" + h : h;
        m = (m < 10) ? "0" + m : m;
        s = (s < 10) ? "0" + s : s;

        var time = h + ":" + m + ":" + s + " " + session;
        document.getElementById("MyClockDisplay").innerText = time;
        document.getElementById("MyClockDisplay").textContent = time;

        setTimeout(showTime, 1000);

    }

    showTime();
    </script>
<script src="https://widget.nomics.com/embed.js"></script>
</body>

</html>
