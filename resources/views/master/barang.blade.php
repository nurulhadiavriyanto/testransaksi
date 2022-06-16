@extends('template.index')

@section('content')
  <div class="row">
    <div style="float: left">
      <h3>Master Barang</h3>
    </div>
    <div style="float: right;">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".ibrg">
        <span class="fa fa-plus-square"></span>
      </button>
    </div>
    <div class="modal fade ibrg" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Tambah Barang</h4>
          </div>
          <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal fibrg" id="fibrg" name="fibrg">
            <div class="modal-body">
              {{ csrf_field() }}
              <span id="erbrg" style="color: red; font-size: 14px"></span><br/>
              <label for="kdbrg">Kode</label>
              <input type="text" id="kdbrg" class="form-control" name="kdbrg" autocomplete="off">
              <label for="nmbrg">Nama</label>
              <input type="text" id="nmbrg" class="form-control" name="nmbrg" autocomplete="off">
              <label for="hrbrg">Harga</label>
              <input type="text" id="hrbrg" class="form-control hrbrg" name="hrbrg" autocomplete="off" onkeyup="getHrgBrg(this)">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
              <a href="#" class="btn btn-primary smpnbrg" id="smpnbrg">Simpan</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_content">
        <table id="datatable" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th style="text-align: center; width: 10%">No.</th>
              <th style="text-align: center; width: 20%">Kode</th>
              <th style="text-align: center; width: 40%">Nama</th>
              <th style="text-align: center; width: 20%">Harga</th>
              <th style="text-align: center; width: 10%"></th>
            </tr>
          </thead>
          <tbody>
            <?php
              function rupiah($angka){
                $hasil_rupiah = number_format($angka,2,'.',',');
                return $hasil_rupiah;
              }
              function rupiah2($angka2){
                $hasil_rupiah2 = number_format($angka2,0,'.','.');
                return $hasil_rupiah2;
              }
            ?>
            @php $i=1 @endphp
            @foreach($brg as $b)
            <tr>
              <td style="text-align: center">{{ $i++ }}</td>
              <td>{{ $b->kode }}</td>
              <td>{{ $b->nama }}</td>
              <td style="text-align: right">{{ rupiah($b->harga) }}</td>
              <td style="text-align: center;">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target=".ubrg{{ $b->id }}">
                  <span class="fa fa-edit"></span>
                </button>
                <a href="/mbrg/dbrg/{{ $b->id }}" class="btn btn-danger"><span class="fa fa-trash-o"></span></a>
              </td>
            </tr>
            <div class="modal fade ubrg{{ $b->id }}" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                      <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Ubah Data Barang</h4>
                  </div>
                  <form action="/mbrg/ubrg/{{ $b->id }}" method="post" enctype="multipart/form-data" id="demo-form" data-parsley-validate>
                    <div class="modal-body">
                      {{ csrf_field() }}
                      {{ method_field('PUT') }}
                      <label for="ukdbrg">Kode</label>
                      <input type="text" id="ukdbrg" class="form-control" name="ukdbrg" value="{{ $b->kode }}" autocomplete="off">
                      <label for="unmbrg">Nama</label>
                      <input type="text" id="unmbrg" class="form-control" name="unmbrg" value="{{ $b->nama }}" autocomplete="off">
                      <label for="uhrbrg">Harga</label>
                      <input type="text" id="uhrbrg" class="form-control uhrbrg" name="uhrbrg" value="{{ rupiah2($b->harga) }}" onkeyup="getUHrgBrg(this)" autocomplete="off">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection