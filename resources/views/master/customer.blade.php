@extends('template.index')

@section('content')
  <div class="row">
    <div style="float: left">
      <h3>Master Customer</h3>
    </div>
    <div style="float: right;">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".icst">
        <span class="fa fa-plus-square"></span>
      </button>
    </div>
    <div class="modal fade icst" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Tambah Customer</h4>
          </div>
          <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal ficst" id="ficst" name="ficst">
            <div class="modal-body">
              {{ csrf_field() }}
              <span id="ercst" style="color: red; font-size: 14px"></span><br/>
              <label for="kdcst">Kode</label>
              <input type="text" id="kdcst" class="form-control" name="kdcst" autocomplete="off">
              <label for="nmcst">Nama</label>
              <input type="text" id="nmcst" class="form-control" name="nmcst" autocomplete="off">
              <label for="tlcst">Telepon</label>
              <input type="text" id="tlcst" class="form-control" name="tlcst" autocomplete="off">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
              <a href="#" class="btn btn-primary smpncst" id="smpncst">Simpan</a>
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
              <th style="text-align: center; width: 20%">Telepon</th>
              <th style="text-align: center; width: 10%"></th>
            </tr>
          </thead>
          <tbody>
            @php $i=1 @endphp
            @foreach($cst as $c)
            <tr>
              <td style="text-align: center">{{ $i++ }}</td>
              <td>{{ $c->kode }}</td>
              <td>{{ $c->nama }}</td>
              <td>{{ $c->telp }}</td>
              <td style="text-align: center;">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target=".ucst{{ $c->id }}">
                  <span class="fa fa-edit"></span>
                </button>
                <a href="/mcst/dcst/{{ $c->id }}" class="btn btn-danger"><span class="fa fa-trash-o"></span></a>
              </td>
            </tr>
            <div class="modal fade ucst{{ $c->id }}" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                      <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Ubah Data Customer</h4>
                  </div>
                  <form action="/mcst/ucst/{{ $c->id }}" method="post" enctype="multipart/form-data" id="demo-form" data-parsley-validate>
                    <div class="modal-body">
                      {{ csrf_field() }}
                      {{ method_field('PUT') }}
                      <label for="ukdcst">Kode</label>
                      <input type="text" id="ukdcst" class="form-control" name="ukdcst" value="{{ $c->kode }}" autocomplete="off">
                      <label for="unmcst">Nama</label>
                      <input type="text" id="unmcst" class="form-control" name="unmcst" value="{{ $c->nama }}" autocomplete="off">
                      <label for="utlcst">Telepon</label>
                      <input type="text" id="utlcst" class="form-control" name="utlcst" value="{{ $c->telp }}" autocomplete="off">
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