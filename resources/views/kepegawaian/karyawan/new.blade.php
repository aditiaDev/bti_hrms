@extends('layouts.app')

@section('page-css')
{{--
<link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.dataTables.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('css/sweetalert2.css') }}">
<style>
  .table>tbody>tr>td,
  .table>tbody>tr>th,
  .table>tfoot>tr>td,
  .table>tfoot>tr>th,
  .table>thead>tr>td,
  .table>thead>tr>th {
    padding: 4px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 0px;
  }

  .checkbox,
  .radio {
    position: relative;
    display: block;
    margin-top: 5px;
    margin-bottom: 5px;
  }
</style>
@endsection

@section('page-content')
<div class="main-content">
  <div class="main-content-inner">
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
      <ul class="breadcrumb">
        <li>
          <i class="ace-icon fa fa-home home-icon"></i>
          <a href="{{ route('home') }}">Home</a>
        </li>

        <li>
          <a href="#">{{ $data['parent-menu'] }}</a>
        </li>
        <li class="active">{{ $data['child-menu'] }}</li>
      </ul><!-- /.breadcrumb -->
    </div>

    <div class="page-content">
      <div class="row">
        <div class="col-xs-12 col-md-12">
          <div class="widget-box">
            <div class="widget-header">
              <h4 class="widget-title">{{ $data['title'] }}</h4>

              <div class="widget-toolbar">
                <a href="#" data-action="collapse">
                  <i class="ace-icon fa fa-chevron-up"></i>
                </a>

                <a href="#" data-action="close">
                  <i class="ace-icon fa fa-times"></i>
                </a>
              </div>
            </div>

            <div class="widget-body">
              <div class="widget-main">
                <form id="frmData">
                  <div class="row">
                    <div class="col-xs-12 col-md-12">
                      <div style="overflow-x: auto;">
                        <table class="table" border="0">
                          <tbody>
                            <tr>
                              <td class="text-right"><label style="padding-top: 7px;">N.I.K</label></td>
                              <td style="min-width: 150px;width:300px;">
                                <div class="form-inline">
                                  <input type="text" name="nik" class="form-control" style="width: 150px;">
                                  <button class="btn btn-sm btn-danger">
                                    <i class="ace-icon fa fa-credit-card bigger-110"></i>
                                    Generate NIK
                                  </button>
                                </div>
                              </td>
                              <td style="min-width: 120px;"></td>
                            </tr>
                            <tr>
                              <td class="text-right"><label style="padding-top: 7px;">Nama</label></td>
                              <td><input type="text" name="nama" class="form-control" style="max-width: 300px;"
                                  oninput="this.value = this.value.toUpperCase()"></td>
                            </tr>
                            <tr>
                              <td class="text-right"><label style="padding-top: 7px;">Dept</label></td>
                              <td>
                                <select name="dept" class="form-control" style="max-width: 250px;"></select>
                              </td>
                              <td>
                                <div class="radio">
                                  <label>
                                    <input name="status_kepegawaian" type="radio" class="ace">
                                    <span class="lbl"> PKWTT</span>
                                  </label>
                                  <label>
                                    <input name="status_kepegawaian" checked type="radio" class="ace">
                                    <span class="lbl"> PKWT</span>
                                  </label>
                                  <label>
                                    <input name="status_kepegawaian" type="radio" class="ace">
                                    <span class="lbl"> HL</span>
                                  </label>
                                  <label>
                                    <input name="status_kepegawaian" type="radio" class="ace">
                                    <span class="lbl"> Permanen</span>
                                  </label>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td class="text-right"><label style="padding-top: 7px;">Divisi</label></td>
                              <td>
                                <select name="divisi" class="form-control" style="max-width: 250px;"></select>
                              </td>
                              <td>
                                <div class="radio">
                                  <label>
                                    <input name="status_pegawai" checked type="radio" class="ace">
                                    <span class="lbl"> Direct</span>
                                  </label>
                                  <label>
                                    <input name="status_pegawai" type="radio" class="ace">
                                    <span class="lbl"> Indirect</span>
                                  </label>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td class="text-right"><label style="padding-top: 7px;">Jabatan</label></td>
                              <td>
                                <select name="jabatan" class="form-control" style="max-width: 250px;"></select>
                              </td>
                            </tr>
                            <tr>
                              <td class="text-right"><label style="padding-top: 7px;">Tgl Masuk</label></td>
                              <td><input type="text" name="tglmasuk" class="form-control" style="width: 150px;"></td>
                            </tr>
                            <tr>
                              <td class="text-right"><label style="padding-top: 7px;">Alamat</label></td>
                              <td colspan="2">
                                <textarea name="alamat" rows="4" class="form-control"
                                  style="max-width: 380px;"></textarea>
                              </td>
                            </tr>
                            <tr>
                              <td class="text-right"><label style="padding-top: 7px;">No. Telp</label></td>
                              <td><input type="text" name="notelp" class="form-control"></td>
                            </tr>
                            <tr>
                              <td class="text-right"><label style="padding-top: 7px;">Email</label></td>
                              <td><input type="email" name="email" class="form-control"></td>
                            </tr>
                            <tr>
                              <td class="text-right"><label style="padding-top: 7px;">Lembur Kelas</label></td>
                              <td>
                                <select name="lembur_kelas" class="form-control"></select>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-12 col-md-12">

                      <div class="tabbable">
                        <ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4">
                          <li class="active">
                            <a data-toggle="tab" href="#biodata">Biodata</a>
                          </li>
                        </ul>

                        <div class="tab-content" style="border-width: 1px;">
                          <div id="biodata" class="tab-pane in active">
                            <div class="row">
                              <div class="col-xs-12 col-md-12">
                                <div style="overflow-x: auto;">
                                  <table class="table" border="0">
                                    <tbody>
                                      <tr>
                                        <td class="text-right"><label style="padding-top: 7px;">Jenis ID</label></td>
                                        <td style="width: 230px;">
                                          <div class="radio">
                                            <label>
                                              <input name="tipeID" checked type="radio" class="ace">
                                              <span class="lbl"> KTP</span>
                                            </label>
                                            <label>
                                              <input name="tipeID" type="radio" class="ace">
                                              <span class="lbl"> PASPOR</span>
                                            </label>
                                            <label>
                                              <input name="tipeID" type="radio" class="ace">
                                              <span class="lbl"> SIM</span>
                                            </label>
                                          </div>
                                        </td>
                                        <td class="text-right"><label style="padding-top: 7px;">N.P.W.P.</label></td>
                                        <td>
                                          <input type="text" name="npwp" class="form-control" style="width: 200px;">
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="text-right"><label style="padding-top: 7px;">No.</label></td>
                                        <td><input type="text" name="noID" class="form-control" required
                                            style="width: 160px;"></td>
                                        <td class="text-right"><label style="padding-top: 7px;">Status Pajak</label>
                                        </td>
                                        <td>
                                          <select name="status_pajak" class="form-control"
                                            style="max-width: 200px;"></select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="text-right"><label style="padding-top: 7px;">Tempat Lahir</label>
                                        </td>
                                        <td><input type="text" name="tempat_lahir" class="form-control"
                                            style="max-width: 200px;"></td>
                                        <td class="text-right"><label style="padding-top: 7px;">Bank</label>
                                        </td>
                                        <td>
                                          <select name="bank_company" class="form-control"
                                            style="max-width: 200px;"></select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="text-right"><label style="padding-top: 7px;">Tgl Lahir</label></td>
                                        <td><input type="text" name="tgllahir" class="form-control" required
                                            style="max-width: 130px;"></td>
                                        <td class="text-right"><label style="padding-top: 7px;">No. Rekening</label>
                                        </td>
                                        <td><input type="text" name="no_rekening" class="form-control"
                                            style="max-width: 200px;"></td>
                                      </tr>
                                      <tr>
                                        <td class="text-right"><label style="padding-top: 7px;">Gender</label></td>
                                        <td>
                                          <div class="radio">
                                            <label>
                                              <input name="gender" checked type="radio" class="ace">
                                              <span class="lbl"> Laki-laki</span>
                                            </label>
                                            <label>
                                              <input name="gender" type="radio" class="ace">
                                              <span class="lbl"> Perempuan</span>
                                            </label>
                                          </div>
                                        </td>
                                        <td class="text-right"><label style="padding-top: 7px;">Pendidikan
                                            Terakhir</label>
                                        </td>
                                        <td>
                                          <select name="pendidikan" class="form-control"
                                            style="max-width: 200px;"></select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="text-right"><label style="padding-top: 7px;">Status</label></td>
                                        <td>
                                          <div class="radio">
                                            <label>
                                              <input name="marital" type="radio" class="ace">
                                              <span class="lbl"> Menikah</span>
                                            </label>
                                            <label>
                                              <input name="marital" checked type="radio" class="ace">
                                              <span class="lbl"> Tidak Menikah</span>
                                            </label>
                                          </div>
                                        </td>
                                        <td class="text-right"><label style="padding-top: 7px;">Jurusan</label>
                                        </td>
                                        <td><input type="text" name="jurusan" class="form-control"
                                            style="max-width: 200px;"></td>
                                      </tr>
                                      <tr>
                                        <td class="text-right"><label style="padding-top: 7px;">Kebangsaan</label>
                                        </td>
                                        <td><input type="text" name="kebangsaan" class="form-control" value="INDONESIA"
                                            style="max-width: 200px;"></td>
                                      </tr>
                                      <tr>
                                        <td class="text-right"><label style="padding-top: 7px;">Agama</label>
                                        </td>
                                        <td>
                                          <select name="agama" class="form-control" style="max-width: 200px;"></select>
                                        </td>
                                      </tr>

                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
@section('page-js')

@endsection