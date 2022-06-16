@extends('template.index')

@section('content')
  <div class="row">
    <h3>Daftar Transaksi Penjualan</h3>
  </div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_content">
        <table id="tblttlpnj" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th style="text-align: center; width: 5%">No.</th>
              <th style="text-align: center; width: 10%">No. Transaksi</th>
              <th style="text-align: center; width: 10%">Tanggal</th>
              <th style="text-align: center; width: 15%">Nama Customer</th>
              <th style="text-align: center; width: 10%">Jumlah Barang</th>
              <th style="text-align: center; width: 15%">Sub Total</th>
              <th style="text-align: center; width: 10%">Diskon</th>
              <th style="text-align: center; width: 10%">Ongkir</th>
              <th style="text-align: center; width: 15%">Total</th>
            </tr>
          </thead>
          <tbody>
            @php
              function rupiah($angka){
                $hasil_rupiah = number_format($angka,2,'.',',');
                return $hasil_rupiah;
              }
             $i=1 
             @endphp
            @foreach($pnj as $p)
            <?php
              if ($p->diskon==0.00) {
                $dis = '';
              }else{
                $dis = rupiah($p->diskon);
              }
              if ($p->ongkir==0.00) {
                $okr = '';
              }else{
                $okr = rupiah($p->ongkir);
              }
            ?>
            <tr>
              <td style="text-align: right;">{{ $i++ }}</td>
              <td>{{ $p->kode }}</td>
              <td>{{ date('d-m-Y', strtotime($p->tgl)) }}</td>
              <td>{{ $p->nama }}</td>
              <td style="text-align: right;">{{ \App\Models\DetailPenjualan::where(['sales_id' => $p->id])->count() }}</td>
              <td style="text-align: right">{{ rupiah($p->subtotal) }}</td>
              <td style="text-align: right">{{ $dis }}</td>
              <td style="text-align: right">{{ $okr }}</td>
              <td style="text-align: right">{{ rupiah($p->total_bayar) }}</td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th colspan="8" style="text-align:right">Grand Total</th>
              <th style="text-align: right"></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
@endsection