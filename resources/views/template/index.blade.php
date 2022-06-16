<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PT. Mitra Sinerji Teknoindo</title>
    <link href="{{url('gentelella-master/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('gentelella-master/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{url('gentelella-master/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <link href="{{url('gentelella-master/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
    <link href="{{url('gentelella-master/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('gentelella-master/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('gentelella-master/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('gentelella-master/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('gentelella-master/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('datepicker/datepicker3.css')}}" rel="stylesheet">
    <link href="{{url('gentelella-master/build/css/custom.min.css')}}" rel="stylesheet">
  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        @include('template.sidebar')
        @include('template.header')
        <div class="right_col" role="main">
          <div class="">
            @yield('content')
          </div>
        </div>
        @include('template.footer')
      </div>
    </div>
    <script src="{{url('gentelella-master/vendors/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{url('gentelella-master/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{url('gentelella-master/vendors/fastclick/lib/fastclick.js')}}"></script>
    <script src="{{url('gentelella-master/vendors/nprogress/nprogress.js')}}"></script>
    <script src="{{url('gentelella-master/vendors/iCheck/icheck.min.js')}}"></script>
    <script src="{{url('gentelella-master/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('gentelella-master/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{url('gentelella-master/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{url('gentelella-master/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
    <script src="{{url('gentelella-master/vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{url('gentelella-master/vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{url('gentelella-master/vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{url('gentelella-master/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{url('gentelella-master/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
    <script src="{{url('gentelella-master/vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('gentelella-master/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
    <script src="{{url('gentelella-master/vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
    <script src="{{url('gentelella-master/vendors/jszip/dist/jszip.min.js')}}"></script>
    <script src="{{url('gentelella-master/vendors/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{url('gentelella-master/vendors/pdfmake/build/vfs_fonts.js')}}"></script>
    <script src="{{url('datepicker/bootstrap-datepicker.js')}}"></script>
    <script src="{{url('typehead.js')}}"></script>
    <script type="text/javascript">
      var pnjcst = "{{url('/tpnj/lcst')}}";
        $('.pnjkdcst').typeahead({
            source: function (query, process){
                return $.get(pnjcst, {
                    query: query
                }, function (data){
                    return process(data);
                });
            }
        });
        $(".pnjkdcst").change(function() {
            $.ajax({
                url: '/tpnj/idcst/' + $(this).val(),
                type: 'get',
                data: {},
                dataType: 'json',
                success: function(data) {
                    if (data.success == true) {
                        $(".pnjnmcst").val(data.nmcst);
                        $(".pnjtlcst").val(data.tlcst);
                        $(".pnjidcst").val(data.idcst);
                        document.getElementById('pnjbrg').disabled = false;
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {}
            });
        });
        var pnjbrg = "{{url('/tpnj/lbrg')}}";
        $('.pnjbrg').typeahead({
            source: function (query, process){
                return $.get(pnjbrg, {
                    query: query
                }, function (data){
                    return process(data);
                });
            }
        });
        $(".pnjbrg").change(function() {
            var a = $(this).val().replace(/^(.{1}[^\s]*).*/, "$1");
            $.ajax({
                url: '/tpnj/ibrg/'+a,
                type: 'get',
                data: {},
                success: function(data) {
                    
                },
            });
        });
    </script>
    <script src="{{url('tes_transaksi.js')}}"></script>
    <script src="{{url('gentelella-master/build/js/custom.min.js')}}"></script>
  </body>
</html>