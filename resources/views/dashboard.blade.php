@extends('template.index')

@section('content')
  <div class="row">
    <h3>Dashboard</h3>
  </div>
  <div class="row">
    @php 
      $bln = date('m');
      if($bln=='01'){
        $bulan = 'Januari';
      }elseif ($bln=='02'){
        $bulan = 'Februari';
      }elseif ($bln=='03'){
        $bulan = 'Maret';
      }elseif ($bln=='04'){
        $bulan = 'April';
      }elseif ($bln=='05'){
        $bulan = 'Mei';
      }elseif ($bln=='06'){
        $bulan = 'Juni';
      }elseif ($bln=='07'){
        $bulan = 'Juli';
      }elseif ($bln=='08'){
        $bulan = 'Agustus';
      }elseif ($bln=='09'){
        $bulan = 'September';
      }elseif ($bln=='10'){
        $bulan = 'Oktober';
      }elseif ($bln=='11'){
        $bulan = 'November';
      }elseif ($bln=='12'){
        $bulan = 'Desember';
      }
    @endphp
    <h3>Periode Bulan {{$bulan}} {{date('Y')}}</h3>
  </div>
  <div class="row top_tiles">
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-mail-forward"></i></div>
        <div class="count">{{$cpnj}}</div>
        <h3>Total Penjualan</h3>
      </div>
    </div>
  </div>
@endsection