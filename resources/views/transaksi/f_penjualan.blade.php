@extends('template.index')

@section('content')
  <div class="row">
    <h3>Transaksi Penjualan</h3>
  </div>
  <div class="row">
    <div class="col-md-3">
      <?php
        $thn = date('Y');
        $bln = date('m');
        $ltrs = strlen($ctpnj);
        if ($ltrs==1) {
          $jmltrs = $thn.$bln.'-000'.$ctpnj;
        }elseif ($ltrs==2) {
          $jmltrs = $thn.$bln.'-00'.$ctpnj;
        }elseif ($ltrs==3) {
          $jmltrs = $thn.$bln.'-0'.$ctpnj;
        }elseif ($ltrs==4) {
          $jmltrs = $thn.$bln.'-'.$ctpnj;
        }
      ?>
      <input type="text" class="form-control has-feedback-left kdpnj" value="{{ $jmltrs }}" readonly>
      <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
    </div>
  </div>
  <br/>
  <div class="row">
    <div class="col-md-3">
      <input type="text" class="form-control has-feedback-left tanggal tglpnj" id="tglpnj" placeholder="{{date('d-m-Y')}}" required autocomplete="off">
      <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
    </div>
  </div>
  <br/>
  <div class="row">
    <div class="col-md-3">
      <input type="text" class="form-control has-feedback-left pnjkdcst" placeholder="Pilih Customer">
      <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span><input type="hidden" class="pnjidcst" id="pnjidcst">
    </div>
  </div>
  <br/>
  <div class="row">
    <div class="col-md-3">
      <input type="text" class="form-control has-feedback-left pnjnmcst" readonly placeholder="Nama Customer">
      <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
    </div>
  </div>
  <br/>
  <div class="row">
    <div class="col-md-3">
      <input type="text" class="form-control has-feedback-left pnjtlcst" readonly placeholder="No. Telepon Customer">
      <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
    </div>
  </div>
  <br/>
  <div class="row">
    <div class="col-md-4">
      <input type="text" class="form-control has-feedback-left pnjbrg" id="pnjbrg" placeholder="Pilih Barang" autocomplete="off" disabled>
      <span class="fa fa-shopping-cart form-control-feedback left" aria-hidden="true"></span>
    </div>
  </div>
  <br/>
  <div class="row">
    <span class="ertpnj" style="color: red; font-size: 14px"></span><br/>
  </div>
  <br/>
  <div class="row">
  <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal pnjkform" id="pnjkform" name="pnjkform">
    {{ csrf_field() }}
    <table class="table table-bordered" id="tblpnj" style="width: 100%">
      <thead>
        <tr>
          <th style="width: 3%; text-align: center" rowspan="2"></th>
          <th style="width: 3%; text-align: center" rowspan="2">No.</th>
          <th style="width: 7%; text-align: center" rowspan="2">Kode Barang</th>
          <th style="width: 23%; text-align: center" rowspan="2">Nama Barang</th>
          <th style="width: 10%; text-align: center" rowspan="2">Qty</th>
          <th style="width: 11%; text-align: center" rowspan="2">Harga Bandrol</th>
          <th style="text-align: center" colspan="2">Diskon</th>
          <th style="width: 11%; text-align: center" rowspan="2">Harga Diskon</th>
          <th style="width: 11%; text-align: center" rowspan="2">Total</th>
        </tr>
        <tr>
          <th style="text-align: center; width: 10%">(%)</th>
          <th style="text-align: center; width: 11%">(Rp)</th>
        </tr>
      </thead>
      <tbody id="tdtpnj">

      </tbody>
    </table>
    </form>
  </div>
  <div class="modal fade hrgmdlpnj" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          </div>
            <div class="modal-body">

            </div>
        </div>
      </div>
    </div>
  <div class="row">
    <div class="col-md-9">
      
    </div>
    <div class="col-md-1" style="text-align: left">
      <div><b>Sub Total</b></div>
    </div>
    <div class="col-md-2" style="text-align: right;">
      <div>
        <input type="text" class="form-control stpnj" autocomplete="off" readonly style="text-align: right;">
        <input type="hidden" class="hstpnj"></input>
      </div>
    </div>
  </div>
  <br/>
  <div class="row">
    <div class="col-md-9">
      
    </div>
    <div class="col-md-1" style="text-align: left">
      <div><b>Diskon</b></div>
    </div>
    <div class="col-md-2" style="text-align: right;">
      <div><input type="text" class="form-control dispnj" autocomplete="off" onkeyup="getdisPnj(this)" style="text-align: right;"></div>
    </div>
  </div>
  <br/>
  <div class="row">
    <div class="col-md-9">
      
    </div>
    <div class="col-md-1" style="text-align: left">
      <div><b>Ongkir</b></div>
    </div>
    <div class="col-md-2" style="text-align: right;">
      <div><input type="text" class="form-control okrpnj" autocomplete="off" onkeyup="getokrPnj(this)" style="text-align: right;"></div>
    </div>
  </div>
  <br/>
  <div class="row">
    <div class="col-md-9">
      
    </div>
    <div class="col-md-1" style="text-align: left">
      <div><b>Total Bayar</b></div>
    </div>
    <div class="col-md-2" style="text-align: right;">
      <div><input type="text" class="form-control ttlbyrpnj" autocomplete="off" readonly style="text-align: right;"></div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-1">
      <div><a href="#" class="btn btn-primary btnsmpnpnj" id="btnsmpnpnj">SIMPAN</a></div>
    </div>
  </div>
@endsection
