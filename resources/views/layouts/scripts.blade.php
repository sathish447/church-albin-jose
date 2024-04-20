<!-- jQuery -->
<script src="{{ btheme() }}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ btheme() }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables & Plugins -->
<script src="{{ btheme() }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ btheme() }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ btheme() }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ btheme() }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ btheme() }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ btheme() }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ btheme() }}/plugins/jszip/jszip.min.js"></script>
<script src="{{ btheme() }}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{ btheme() }}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{ btheme() }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ btheme() }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ btheme() }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ btheme() }}/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ btheme() }}/dist/js/demo.js"></script>
<!-- Page specific script -->

<script type="text/javascript">
    $(document).ready(function () {
        @if (Session::has('error'))
        notification("error", "{!! Session::get('error') !!}");
        @endif

        @if ($errors->any())
        notification("error", $("#error_list").html());
        @endif

        @if (Session::has('success'))
        notification("success", "{!! Session::get('success') !!}");
        @endif

        // customFormValidation('form');
        $.extend(true, $.fn.dataTable.defaults, {
            stateSave: true,
            // responsive: true,
        });
        $('.table').parent().addClass("table-responsive");
    });
</script>
