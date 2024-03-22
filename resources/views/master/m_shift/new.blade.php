@extends('layouts.app')

@section('page-css')
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

  input[type=checkbox].ace.ace-switch.ace-switch-4+.lbl::before,
  input[type=checkbox].ace.ace-switch.ace-switch-5+.lbl::before {
    content: "YA\a0\a0\a0\a0\a0\a0\a0\a0\a0\a0\a0TIDAK";
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
              <form id="frmData" action="{{ route('master.shift.store') }}" method="POST" target="_blank">
                @csrf
                <div class="widget-main">
                  <div class="row">
                    <div class="col-xs-12 col-md-6">
                      <div class="form-horizontal">
                        <div class="form-group">
                          <label class="col-sm-2 control-label no-padding-right"> Nama Shift</label>

                          <div class="col-sm-10">
                            <input type="text" name="shift_name" class="form-control" required>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                      <div class="form-horizontal">
                        <div class="form-group">
                          <label class="col-sm-2 control-label no-padding-right"> Libur Random</label>

                          <div class="col-sm-2">
                            <div class="checkbox">
                              <label style="padding-left: 10px;">
                                <input name="libur_random" class="ace ace-switch ace-switch-4 btn-rotate"
                                  type="checkbox" value="1">

                                <span class="lbl"></span>
                              </label>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-12 col-md-12">
                      <div style="overflow-x: auto;">
                        <table class="table table-hover" border="0" id="tb_data">
                          <tbody>
                            <tr>
                              <td class="text-right" style="min-width: 100px;">
                                <label style="padding-top: 10px;">Hari Kerja</label>
                              </td>
                              @php
                              $i=0;
                              @endphp
                              @foreach ($data['field'] as $item)
                              <td colspan="2">
                                <div class="checkbox">
                                  <label>
                                    <input name="hari[]" id="hari[{{ $i }}]" value="{{ $item->code }}"
                                      onchange="cekIsOT({{ $i }});chEdited({{ $i }});" type="checkbox" class="ace">
                                    <span class="lbl"> {{ $item->desc }}</span>
                                  </label>
                                  <input name="isOT_day[{{ $i }}]" type="hidden" class="ace" value="1">
                                </div>
                              </td>
                              @php
                              $i++;
                              @endphp
                              @endforeach

                            </tr>
                            <tr>
                              <td class="text-right"><label style="padding-top: 10px;">Masuk</label></td>
                              @foreach ($data['field'] as $item)
                              <td colspan="2">
                                <input type="text" name="masuk[]" readonly class="form-control" maxlength="5"
                                  value="00:00">
                              </td>
                              @endforeach
                            </tr>
                            <tr>
                              <td class="text-right"><label style="padding-top: 10px;">Pulang</label></td>
                              @php
                              $i=0;
                              @endphp
                              @foreach ($data['field'] as $item)
                              <td style="width: 70px;min-width: 70px;">
                                <input type="text" name="pulang[]" readonly class="form-control" maxlength="5"
                                  value="00:00">
                              </td>
                              <td style="min-width: 75px;">
                                <div class="checkbox">
                                  <label>
                                    <input id="nextday[{{ $i }}]" onchange="ceknd(this)" type="checkbox" value="1"
                                      class="ace">
                                    <span class="lbl"> ND</span>
                                  </label>
                                  <input name="nextday[{{ $i }}]" type="hidden" class="ace" value="0">
                                </div>
                              </td>
                              @php
                              $i++;
                              @endphp
                              @endforeach
                            </tr>


                            @for ($a = 1; $a <= 3; $a++) <tr>
                              <td class="text-right"><label style="padding-top: 10px;">Awal Break {{ $a }}</label></td>
                              @php
                              $i=0;
                              @endphp
                              @foreach ($data['field'] as $item)
                              <td style="width: 70px;min-width: 70px;">
                                <input type="text" name="break_in{{ $a }}[]" readonly class="form-control" maxlength="5"
                                  value="00:00">
                              </td>
                              <td style="min-width: 75px;">
                                <div class="checkbox">
                                  <label>
                                    <input id="break_in{{ $a }}_nd[{{ $i }}]" onchange="ceknd(this)" type="checkbox"
                                      value="1" class="ace">
                                    <span class="lbl"> ND</span>
                                  </label>
                                  <input name="break_in{{ $a }}_nd[{{ $i }}]" type="hidden" class="ace" value="0">
                                </div>
                              </td>
                              @php
                              $i++;
                              @endphp
                              @endforeach
                              </tr>
                              <tr>
                                <td class="text-right"><label style="padding-top: 10px;">Akhir Break {{ $a }}</label>
                                </td>
                                @php
                                $i=0;
                                @endphp
                                @foreach ($data['field'] as $item)
                                <td style="width: 70px;min-width: 70px;">
                                  <input type="text" name="break_out{{ $a }}[]" readonly class="form-control"
                                    maxlength="5" value="00:00">
                                </td>
                                <td style="min-width: 75px;">
                                  <div class="checkbox">
                                    <label>
                                      <input id="break_out{{ $a }}_nd[{{ $i }}]" onchange="ceknd(this)" value="1"
                                        type="checkbox" class="ace">
                                      <span class="lbl"> ND</span>
                                    </label>
                                    <input name="break_out{{ $a }}_nd[{{ $i }}]" type="hidden" class="ace" value="0">
                                  </div>
                                </td>
                                @php
                                $i++;
                                @endphp
                                @endforeach
                              </tr>
                              @endfor

                              <tr>
                                <td class="text-right">
                                  <label style="padding-top: 7px;">Jam Kerja</label>
                                </td>

                                @foreach ($data['field'] as $item)
                                <td colspan="2">
                                  <input type="text" name="workhour[]" class="form-control" maxlength="5" value="00:00"
                                    readonly>
                                </td>
                                @endforeach
                              </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="center">
                        <button type="button" class="btn btn-sm btn-success" id="btnWorkHours">Generate Work
                          Hours</button>
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
<script src="{{ asset('js/jquery.checkboxes.js') }}"></script>
<script>
  jQuery(function($) {
    $('#tb_data').checkboxes('range', true);
  });

  $("#btnWorkHours").click(function(){
    var waktuInputs = document.querySelectorAll('input[name="masuk[]"]');

    waktuInputs.forEach(function(input, index) {

      var waktuMasuk = parseWaktu($("[name='masuk[]']").eq(index).val());
      var waktuKeluar = parseWaktu($("[name='pulang[]']").eq(index).val());


      var break_in1 = parseWaktu($("[name='break_in1[]']").eq(index).val());
      var break_out1 = parseWaktu($("[name='break_out1[]']").eq(index).val());

      var break_in2 = parseWaktu($("[name='break_in2[]']").eq(index).val());
      var break_out2 = parseWaktu($("[name='break_out2[]']").eq(index).val());

      var break_in3 = parseWaktu($("[name='break_in3[]']").eq(index).val());
      var break_out3 = parseWaktu($("[name='break_out3[]']").eq(index).val());

      if(break_out1 < break_in1){
        break_out1.setDate(break_out1.getDate() + 1);
      }

      if(break_out2 < break_in2){
        break_out2.setDate(break_out2.getDate() + 1);
      }

      if(break_out3 < break_in3){
        break_out3.setDate(break_out3.getDate() + 1);
      }

      var jmlIstirahat = ( (break_out1 - break_in1) + (break_out2 - break_in2) + (break_out3 - break_in3) ) 

      var selisihJamBreak = Math.floor(jmlIstirahat / (1000 * 60 * 60));
      var selisihMenitBreak = Math.floor((jmlIstirahat % (1000 * 60 * 60)) / (1000 * 60));

      var BreakTime = ("0" + selisihJamBreak).slice(-2) + ":" + ("0" + selisihMenitBreak).slice(-2);
      var waktuIstirahat = parseWaktu(BreakTime);

      // Menambah 1 hari pada waktu keluar jika shift malam
      if (waktuKeluar < waktuMasuk) {
        waktuKeluar.setDate(waktuKeluar.getDate() + 1);
      }

      // Hitung selisih waktu istirahat dalam milidetik
      var selisihIstirahat = waktuIstirahat.getHours() * 60 + waktuIstirahat.getMinutes();

      // Hitung selisih waktu kerja dalam milidetik
      var selisihKerja = waktuKeluar - waktuMasuk - selisihIstirahat * 60 * 1000;

      // Konversi selisih waktu dari milidetik ke jam dan menit
      var selisihJam = Math.floor(selisihKerja / (1000 * 60 * 60));
      var selisihMenit = Math.floor((selisihKerja % (1000 * 60 * 60)) / (1000 * 60));

      // Format waktu
      var jamKerja = ("0" + selisihJam).slice(-2) + ":" + ("0" + selisihMenit).slice(-2);

      $("[name='workhour[]']").eq(index).val(jamKerja)
    });
  })

  function parseWaktu(waktuString) {
    var parts = waktuString.split(":");
    var jam = parseInt(parts[0], 10);
    var menit = parseInt(parts[1], 10);
    return new Date(2024, 2, 21, jam, menit); // Tanggal yang ditetapkan hanya sebagai contoh
  }

  function ceknd(param){
    let inputName = param.id
    var checkbox = document.getElementById(inputName);

    let value = 0
    if(checkbox.checked == true){
      value = 1
    }
    $("[name='"+inputName+"']").val(value)
  }

  function cekIsOT(param){
    let inputName = "hari["+param+"]"
    var checkbox = document.getElementById(inputName);

    let value = 1
    if(checkbox.checked == true){
      value = 0
    }
    $("[name='isOT_day["+param+"]']").val(value)
  }

  function chEdited(param){
    let inputName = "hari["+param+"]"
    var checkbox = document.getElementById(inputName);
    let value = true
    if(checkbox.checked == true){
      value = false
    }
    $("[name='masuk[]']").eq(param).attr('readonly', value)
    $("[name='pulang[]']").eq(param).attr('readonly', value)

    $("[name='break_in1[]']").eq(param).attr('readonly', value)
    $("[name='break_out1[]']").eq(param).attr('readonly', value)

    $("[name='break_in2[]']").eq(param).attr('readonly', value)
    $("[name='break_out2[]']").eq(param).attr('readonly', value)

    $("[name='break_in3[]']").eq(param).attr('readonly', value)
    $("[name='break_out3[]']").eq(param).attr('readonly', value)
  }
</script>
@endsection