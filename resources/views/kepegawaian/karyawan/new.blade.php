@extends('layouts.app')

@section('page-css')
<link rel="stylesheet" href="{{ asset('css/sweetalert2.css') }}">
<link rel="stylesheet" href="{{ asset('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
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
      </ul>
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
              <form id="frmData">
                <div class="widget-main">

                  <div class="row">
                    <div class="col-xs-12 col-md-12">
                      <div style="overflow-x: auto;">
                        <table class="table" border="0">
                          <tbody>
                            <tr>
                              <td class="text-right"><label style="padding-top: 7px;">N.I.K</label></td>
                              <td style="min-width: 150px;width:300px;">
                                <div class="form-inline">
                                  <input type="text" name="nik" class="form-control" style="width: 150px;"
                                    oninput="this.value = this.value.toUpperCase()">
                                  <button type="button" id="genNIK" class="btn btn-sm btn-danger">
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
                                  oninput="this.value = this.value.toUpperCase()" required></td>
                            </tr>
                            <tr>
                              <td class="text-right"><label style="padding-top: 7px;">Dept</label></td>
                              <td>
                                <select name="id_departemen" class="form-control select2" style="max-width: 250px;"
                                  required>
                                  <option value="" selected disabled>Pilih Departemen</option>
                                  @foreach ($data['dept'] as $item)
                                  <option value="{{ $item->id }}">{{ $item->dept_name }}</option>
                                  @endforeach
                                </select>
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
                                <select name="id_divisi" class="form-control select2" style="max-width: 250px;"
                                  required>
                                  <option value="" selected disabled>Pilih Divisi</option>
                                </select>
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
                                <select name="id_jabatan" class="form-control select2" style="max-width: 250px;"
                                  required>
                                  <option value="" selected disabled>Pilih Jabatan</option>
                                  @foreach ($data['jabatan'] as $item)
                                  <option value="{{ $item->id }}">{{ $item->jabatan_name }}</option>
                                  @endforeach
                                </select>
                              </td>
                            </tr>
                            <tr>
                              <td class="text-right"><label style="padding-top: 7px;">Tgl Masuk</label></td>
                              <td>
                                <div class="input-group" style="width: 150px;">
                                  <input type="text" name="tglmasuk" class="form-control datepicker"
                                    value="{{ date('Y-m-d') }}" required>
                                  <span class="input-group-addon">
                                    <i class="ace-icon fa fa-calendar"></i>
                                  </span>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td class="text-right"><label style="padding-top: 7px;">No. Telp</label></td>
                              <td>
                                <div class="input-group">
                                  <span class="input-group-addon">
                                    <i class="ace-icon fa fa-phone"></i>
                                  </span>

                                  <input type="text" name="notelp" onkeypress="return onlyNumberKey(event)"
                                    class="form-control">
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td class="text-right"><label style="padding-top: 7px;">Email</label></td>
                              <td>
                                <div class="input-group">
                                  <span class="input-group-addon">
                                    <i class="ace-icon fa fa-envelope-o"></i>
                                  </span>

                                  <input type="email" name="email" class="form-control">
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td class="text-right"><label style="padding-top: 7px;">Lembur Kelas</label></td>
                              <td>
                                <select name="lembur_kelas" class="form-control" required>
                                  <option value="" selected disabled>Pilih Lembur Kelas dibayar</option>
                                  @foreach ($data['lembur_kelas'] as $item)
                                  <option value="{{ $item->code }}">{{ $item->code }} - {{ $item->desc }}</option>
                                  @endforeach
                                </select>
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
                                            @foreach ($data['tipeID'] as $item)
                                            <label>
                                              <input name="tipeID" type="radio" class="ace" {{ $item->code == '1' ?
                                              'checked' :
                                              '' }} value="{{ $item->code }}">
                                              <span class="lbl"> {{ $item->desc }}</span>
                                            </label>
                                            @endforeach
                                          </div>
                                        </td>
                                        <td class="text-right"><label style="padding-top: 7px;">N.P.W.P.</label></td>
                                        <td>
                                          <input type="text" name="npwp" class="form-control" style="width: 200px;">
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="text-right"><label style="padding-top: 7px;">No.</label></td>
                                        <td>
                                          <input type="text" name="noID" class="form-control" required
                                            style="width: 160px;" onkeypress="return onlyNumberKey(event)">
                                        </td>
                                        <td class="text-right"><label style="padding-top: 7px;">Status Pajak</label>
                                        </td>
                                        <td>
                                          <select name="status_pajak" class="form-control" style="max-width: 200px;">
                                            <option value="" selected disabled>Pilih Status Pajak</option>
                                            @foreach ($data['status_pajak'] as $item)
                                            <option value="{{ $item->code }}">{{ $item->code }} - {{ $item->desc }}
                                            </option>
                                            @endforeach
                                          </select>
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
                                          <select name="bank_company" class="form-control select2"
                                            style="max-width: 200px;">
                                            <option value="" selected disabled>Pilih Bank Company</option>
                                            @foreach ($data['bank'] as $item)
                                            <option value="{{ $item->code }}">{{ $item->desc }}
                                            </option>
                                            @endforeach
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="text-right"><label style="padding-top: 7px;">Tgl Lahir</label></td>
                                        <td>
                                          <div class="input-group" style="width: 150px;">
                                            <input type="text" name="tgllahir" class="form-control" required>
                                            <span class="input-group-addon">
                                              <i class="ace-icon fa fa-calendar"></i>
                                            </span>
                                          </div>
                                        </td>
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
                                              <input name="gender" checked type="radio" class="ace" value="1">
                                              <span class="lbl"> Laki-laki</span>
                                            </label>
                                            <label>
                                              <input name="gender" type="radio" class="ace" value="2">
                                              <span class="lbl"> Perempuan</span>
                                            </label>
                                          </div>
                                        </td>
                                        <td class="text-right"><label style="padding-top: 7px;">Pendidikan
                                            Terakhir</label>
                                        </td>
                                        <td>
                                          <select name="pendidikan" class="form-control" style="max-width: 200px;">
                                            <option value="" selected disabled>Pilih Pendidikan Terakhir</option>
                                            @foreach ($data['pendidikan'] as $item)
                                            <option value="{{ $item->code }}">{{ $item->desc }}
                                            </option>
                                            @endforeach
                                          </select>
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
                                        <td class="text-right"><label style="padding-top: 7px;">Alamat</label></td>
                                        <td colspan="2">
                                          <textarea name="alamat" rows="4" class="form-control"
                                            style="max-width: 380px;"></textarea>
                                        </td>
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
                                          <select name="agama" class="form-control" style="max-width: 200px;">
                                            @foreach ($data['agama'] as $item)
                                            <option value="{{ $item->code }}" {{ $item->code == 'ISLAM' ? 'selected' :
                                              '' }}>{{ $item->desc }}
                                            </option>
                                            @endforeach
                                          </select>
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

                </div>
                <div class="widget-toolbox padding-4 clearfix center">
                  <div class="btn-group ">
                    <button type="button" id="btnCancel" class="btn btn-sm btn-warning">
                      <i class="ace-icon fa fa-times bigger-125"></i>
                      Cancel
                    </button>
                  </div>

                  <div class="btn-group ">
                    <button type="submit" class="btn btn-sm btn-purple">
                      <i class="ace-icon fa fa-floppy-o bigger-125"></i>
                      Save
                    </button>
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

@endsection
@section('page-js')
<script src="{{ asset('js/select2.js') }}"></script>
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="{{ asset('js/nik_parse.js') }}"></script>
<script>
  let thisYear = new Date().getFullYear();
  let fiftyYearsAgo = thisYear - 50;

  $(".select2").select2()
  $(".datepicker").datepicker({
    changeMonth: true,
    changeYear: true,
    dateFormat: "yy-mm-dd",
  })

  $("[name='tgllahir']").datepicker({
    changeMonth: true,
    changeYear: true,
    dateFormat: "yy-mm-dd",
    yearRange: fiftyYearsAgo+":"+thisYear
  })

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $(document).ajaxStart(function(){
    $('#overlay').fadeIn(300);
  });

  $(document).ajaxStop(function(){
    $('#overlay').fadeOut(500);
  });
  
  $("[name='id_departemen']").change(function(){
    var id_dept = $(this).val(); 
    if(id_dept){
      $.ajax({
        type: "POST",
        url: "{{ route('master.getDivisiByDept') }}", 
        data:{
          id_dept
        },
        success:function(response){
          // let row = '<option value="">Pilih Divisi</option>'
          let row = ''
          $.map(response, function(val, i){
            row += '<option value="'+val.id+'">'+val.divisi_name+'</option>'
          })
          $("[name='id_divisi']").html(row); 
        }
      });
    }else{
      $("[name='id_divisi']").html('<option value="">Pilih Divisi</option>'); 
    }
  })

  $("[name='noID']").change(function(){
    if($("[name='tipeID']:checked").val() != 1) return

    let nik = $(this).val()
    nikParse(nik, function (result) {
      if(result.status != 'success') return

      let alamat = '\nKECAMATAN '+result.data.kecamatan+', '+result.data.kotakab+', PROVINSI '+result.data.provinsi
      let tgllahir = changeDateFormat(result.data.lahir)
      let tempat_lahir = result.data.kotakab.replace("KAB. ", "")
      tempat_lahir = tempat_lahir.replace("KOTA", "")
      let gender = 1
      if(result.data.kelamin != "LAKI-LAKI"){
        gender = 2
      }

      $("[name='gender']").val([gender])
      $("[name='tgllahir']").val(tgllahir)
      $("[name='tempat_lahir']").val(tempat_lahir)
      $("[name='alamat']").val(alamat)
    })
  })

  $("#genNIK").click(function(){
    let dept = $("[name='id_departemen']").val()
    if(dept == "" || dept == null){
      alert("Pilih Departemen")
      return
    }

    $.ajax({
      url: "{{ route('karyawan.generateNIK') }}",
      type: "POST",
      data: {
        dept
      },
      success: function(result){
        $("[name='nik']").val(result)
      }
    })
  })

  $("#btnCancel").click(function(){
    if (!confirm('Apakah anda yakin ingin membatalkan ini?')) return

    window.location.replace("{{ route('karyawan') }}")
  })

  function onlyNumberKey(evt) {
    let ASCIICode = (evt.which) ? evt.which : evt.keyCode
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
        return false;
    return true;
  }

  function changeDateFormat(inputDate) {
    var parts = inputDate.split('/');
    var formattedDate = parts[2] + '-' + parts[1] + '-' + parts[0];
    
    return formattedDate;
  }
</script>
@endsection