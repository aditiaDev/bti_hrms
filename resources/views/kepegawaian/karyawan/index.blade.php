@extends('layouts.app')

@section('page-css')
{{--
<link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.dataTables.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('css/sweetalert2.css') }}">
<link rel="stylesheet" href="{{ asset('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
<style>
  .text-middle {
    vertical-align: middle !important;
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
          <div id="accordion" class="accordion-style1 panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion"
                    href="#collapseOne">
                    <i class="ace-icon fa fa-angle-down bigger-110" data-icon-hide="ace-icon fa fa-angle-down"
                      data-icon-show="ace-icon fa fa-angle-right"></i>
                    &nbsp;Show/Hide Filter
                  </a>
                </h4>
              </div>

              <div class="panel-collapse collapse" id="collapseOne">
                <div class="panel-body">
                  <form id="frmFilter">
                    <div class="row">
                      <div class="col-xs-12 col-md-3">
                        <div class="form-horizontal">
                          <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right"> Departemen</label>

                            <div class="col-sm-8">
                              <select name="dept" class="form-control select2" style="width: 100%">
                                <option value="">Tampilkan Semua</option>
                                @foreach ($data['dept'] as $item)
                                <option value="{{ $item->id }}">{{ $item->dept_name }}
                                </option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right"> Divisi</label>

                            <div class="col-sm-8">
                              <select name="divisi" class="form-control select2" style="width: 100%">
                                <option value="">Tampilkan Semua</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right"> Jabatan</label>

                            <div class="col-sm-8">
                              <select name="jabatan" class="form-control select2" style="width: 100%">
                                <option value="">Tampilkan Semua</option>
                                @foreach ($data['jabatan'] as $item)
                                <option value="{{ $item->id }}">{{ $item->jabatan_name }}
                                </option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-12 col-md-4">
                        <div class="form-horizontal">
                          <div class="form-group">
                            <label class="col-sm-5 control-label no-padding-right"> Status Kepegawaian</label>

                            <div class="col-sm-7">
                              <select name="status_kepegawaian" class="form-control">
                                <option value="">Tampilkan Semua</option>
                                @foreach ($data['status_kepegawaian'] as $item)
                                <option value="{{ $item->code }}">{{ $item->desc }}
                                </option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-5 control-label no-padding-right"> Status Pekerja</label>

                            <div class="col-sm-7">
                              <select name="status_pegawai" class="form-control">
                                <option value="">Tampilkan Semua</option>
                                @foreach ($data['status_pegawai'] as $item)
                                <option value="{{ $item->code }}">{{ $item->desc }}
                                </option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-12 col-md-3">
                        <div class="form-group">
                          <label>
                            <input name="isactive" type="radio" class="ace" checked value="1">
                            <span class="lbl"> Active</span>
                          </label>
                          <label style="margin-left: 10px;">
                            <input name="isactive" type="radio" class="ace" value="0">
                            <span class="lbl"> Not Active</span>
                          </label>
                          <label style="margin-left: 10px;">
                            <input name="isactive" type="radio" class="ace" value="">
                            <span class="lbl"> Semua</span>
                          </label>
                        </div>
                      </div>
                      <div class="col-xs-12 col-md-2">
                        <div class="form-horizontal">
                          <div class="form-group">
                            <div class="col-sm-12">
                              <button type="button" id="btnFilter" class="btn btn-info btn-sm">
                                <i class="ace-icon fa fa-filter bigger-110"></i>Filter
                              </button>
                              <button type="button" id="btnClearFilter" class="btn btn-default btn-sm">
                                <i class="ace-icon fa fa-times bigger-110"></i>Clear Filter
                              </button>
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

      <div class="row">
        <div class="col-xs-12 col-md-12">
          <div style="margin-bottom:10px;">
            <a class="btn btn-sm btn-info" href="{{ route('karyawan.new') }}" id="btnNew"><i
                class="ace-icon fa fa-plus-circle bigger-110"></i>
              New</a>
            <button class="btn btn-sm btn-grey" id="btnEmpTransfer"><i class="ace-icon fa fa-exchange bigger-110"></i>
              Employee Transfer</button>
            <button class="btn btn-sm btn-pink" id="btnPrintID"><i class="ace-icon fa fa-print bigger-110"></i> Print ID
              Card</button>
          </div>
        </div>
      </div>

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

                <div class="row">
                  <div class="col-xs-12 col-md-12">
                    <div style="overflow-x: auto;">
                      <table id="tb_data" class="table table-bordered table-hover" style="width: 100%">
                        <thead>
                          <tr>
                            <th></th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Departemen</th>
                            <th>Divisi</th>
                            <th>Jabatan</th>
                            <th>No. WhatsApp</th>
                            <th>Status</th>
                            <th style="min-width: 150px">Action</th>
                          </tr>
                        </thead>
                        <tbody></tbody>
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
  </div>
</div>

<!-- staticBackdrop Modal -->
<div class="modal fade" id="modalEmpTransfer" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="bootbox-close-button close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Employee Transfer</h4>
      </div>
      <form id="frmEmpTransfer">
        <div class="modal-body">
          <div class="row">
            <div class="col-xs-12 col-md-12">
              <div class="form-horizontal">
                <div class="form-group">
                  <label class="col-sm-4 control-label no-padding-right"> NIK Baru</label>

                  <div class="col-sm-4">
                    <input type="text" name="nik_baru" class="form-control" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label no-padding-right"> Tgl Mutasi</label>

                  <div class="col-sm-4">
                    <input type="text" name="tglmutasi" class="form-control datepicker" value="{{ date('Y-m-d') }}"
                      required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label no-padding-right"> Dept Baru</label>

                  <div class="col-sm-6">
                    <select name="dept_baru" class="form-control select2" style="width: 100%" required>
                      <option value="" disabled>Pilih Departemen</option>
                      @foreach ($data['dept'] as $item)
                      <option value="{{ $item->id }}">{{ $item->dept_name }}
                      </option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label no-padding-right"> Divisi Baru</label>

                  <div class="col-sm-6">
                    <select name="divisi_baru" class="form-control select2" style="width: 100%" required>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label no-padding-right"> Jabatan Baru</label>

                  <div class="col-sm-6">
                    <select name="jabatan_baru" class="form-control select2" style="width: 100%" required>
                      <option value="">Tampilkan Semua</option>
                      @foreach ($data['jabatan'] as $item)
                      <option value="{{ $item->id }}">{{ $item->jabatan_name }}
                      </option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label no-padding-right"> Status Kepegawaian Baru</label>

                  <div class="col-sm-8">
                    <div class="radio">
                      @foreach ($data['status_kepegawaian'] as $item)
                      <label>
                        <input name="status_kepegawaian_baru" type="radio" class="ace" value="{{ $item->code }}">
                        <span class="lbl"> {{ $item->desc }}</span>
                      </label>
                      @endforeach
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label no-padding-right"> Status Pekerja Baru</label>

                  <div class="col-sm-8">
                    <div class="radio">
                      @foreach ($data['status_pegawai'] as $item)
                      <label>
                        <input name="status_pegawai_baru" type="radio" class="ace" value="{{ $item->code }}">
                        <span class="lbl"> {{ $item->desc }}</span>
                      </label>
                      @endforeach
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label no-padding-right"> Tipe Mutasi</label>

                  <div class="col-sm-8">
                    <div class="radio">
                      @foreach ($data['emp_trans_type'] as $item)
                      <label>
                        <input name="type" type="radio" class="ace" {{ $item->code == '0' ?
                        'checked' :
                        '' }} value="{{ $item->code }}">
                        <span class="lbl"> {{ $item->desc }}</span>
                      </label>
                      @endforeach
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label no-padding-right"> Note</label>

                  <div class="col-sm-6">
                    <textarea name="note" rows="3" class="form-control"></textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('page-js')
<script src="{{ asset('js/datatables.min.js') }}"></script>
{{-- <script src="{{ asset('js/dataTables.responsive.js') }}"></script> --}}
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="{{ asset('js/sweetalert2.js') }}"></script>
<script src="{{ asset('js/select2.js') }}"></script>
<script src="{{ asset('js/jquery.checkboxes.js') }}"></script>
<script>
  var action
  var tb_data
  let id_data

  $(".select2").select2()

  $(".datepicker").datepicker({
    changeMonth: true,
    changeYear: true,
    dateFormat: "yy-mm-dd",
  })

  jQuery(function($) {
    $('#tb_data').checkboxes('max', 1);
  });

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

  function REFRESH_DATA() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    let frmFilter = $("#frmFilter").serializeArray()

    $('#tb_data').DataTable().destroy();
    tb_data = $("#tb_data").DataTable({
      "ordering": true,
      "paging": false,
      fixedHeader: {
            header: true,
            // headerOffset: 45,
            },
            scrollY:600,
            scrollX: true,
      "ajax": {
        "url": "{{ route('karyawan.getall') }}",
        "type": "POST",
        "data": function(d){
          // d._token = $('meta[name="csrf-token"]').attr('content'),
          d.form = frmFilter
        },
        "beforeSend": function(request) {
          request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content') );
        },
        // "headers": {
        //   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        // },
      },
      "columnDefs": [
        {
          "targets": 0,
          "orderable": false
        },
        {
          "targets": 6,
          "orderable": false
        },
        {
          "targets": 7,
          "orderable": false
        },
        {
          "targets": 8,
          "orderable": false
        },
      ],
      "columns": [
        { 
          "data": "id",
          className: "text-center text-middle",
          "render": function(data){
            return '<input type="checkbox" name="selectID[]" class="chkID" value="'+data+'" >'
          }
        },
        { "data": "nama" },
        {"data": "nik", className: "text-center"},
        { "data": "dept_name" },
        { "data": "divisi_name" },
        { "data": "jabatan_name" },
        { "data": "notelp" },
        {
          "data": "isactive",
          "render": function (data) {
            let status = '<span class="label label-sm label-danger arrowed-in">Not Active</span>'
            if (data == 1) {
              status = '<span class="label label-sm label-success arrowed-in">Active</span>'
            }

            return status
          },
          "className": "text-center"
        },

        {
          "data": null,
          "render": function (data) {
            let row = "<button class='btn btn-xs btn-warning' title='Edit Data' onclick='editData(\"" + data.id + "\");'>Edit</button> "
            if(data.isactive == 1){
              row += "<button class='btn btn-xs btn-danger' title='Deactivate Data' onclick='changeStatus(0, \"" + data.id + "\");'>Deactivate</button>"
            }else{
              row += "<button class='btn btn-xs btn-info' title='Activate Data' onclick='changeStatus(1, \"" + data.id + "\");'>Activate</button>"
            }
            return row
          },
          className: "text-center"
        }

      ],
    })
  }

  REFRESH_DATA()

  function changeStatus(act, id){
    if (!confirm('Proses data ini?')) return
      urlPost = "{{ route('karyawan.changeStatus') }}";
      formData = "act="+act+"&id="+id
      method = "POST"
      ACTION_PROCESS(urlPost, formData, method)
  }

  function ACTION_PROCESS(urlPost, formData, method) {
    $.ajax({
      url: urlPost,
      type: method,
      data: formData,
      dataType: "JSON",
      success: function (data) {
        // console.log(data)
        Swal.fire({
          icon: data.status,
          text: data.message,
          // showConfirmButton: false,
          timer: 5000
        });
        REFRESH_DATA()
      },
      error: function (datas) {
        console.log(datas)
        let data = datas.responseJSON
        // alert('Error Save Data')
        Swal.fire({
          icon: data.status,
          html: data.message,
        });
      }
    })
  }

  $("[name='dept']").change(function(){
    var id_dept = $(this).val(); 
    if(id_dept){
      $.ajax({
        type: "POST",
        url: "{{ route('master.getDivisiByDept') }}", 
        data:{
          id_dept
        },
        success:function(response){
          let row = '<option value="" >Tampilkan Semua</option>'
          $.map(response, function(val, i){
            row += '<option value="'+val.id+'">'+val.divisi_name+'</option>'
          })
          $("[name='divisi']").html(row); 
        }
      });
    }else{
      $("[name='divisi']").html('<option value="">Pilih Divisi</option>'); 
    }
  })

  $("#btnFilter").click(function(){
    REFRESH_DATA()
  })

  $("#btnClearFilter").click(function(){
    $('.select2').val(null).trigger('change');
    $("#frmFilter")[0].reset()
  })

  function editData(id){
    window.location.href = "{{ route('karyawan') }}" + '/' + id + '/edit'
  }

  $("#btnEmpTransfer").click(function(){
    let rowcollection =  tb_data.$(".chkID:checked", {"page": "all"});
    
    if(rowcollection.length < 1){
      alert("Pilih Karyawan yg akan di Transfer")
      return
    }

    let arrData = [];
    rowcollection.each(function(index,elem){
      arrData.push($(elem).val());
    });

    let jsonData = JSON.stringify(arrData);

    id_data = jsonData

    $.ajax({
      url: "{{ route('karyawan.getById') }}",
      type: "POST",
      dataType: "JSON",
      data: {
        id_emp: jsonData
      },
      success: function(result){

        $.map(result['data'], function(val, i){

          $("[name='nik_baru']").val(val.nik)
          $("[name='dept_baru']").val(val.id_departemen).trigger('change')
          $("[name='jabatan_baru']").val(val.id_jabatan).trigger('change')
          $("input[name=status_kepegawaian_baru][value='"+val.status_kepegawaian+"']").prop('checked', true);
          $("input[name=status_pegawai_baru][value='"+val.status_pegawai+"']").prop('checked', true);
          
          setTimeout(() => {
            $("[name='divisi_baru']").val(val.id_divisi).trigger('change')
          }, 500);

        })
      },
    })


    $("#modalEmpTransfer").modal('show')
  })

  $("[name='dept_baru']").change(function(){
    var id_dept = $(this).val(); 
    $("[name='divisi_baru']").val(null).trigger('change')
    if(id_dept){
      $.ajax({
        type: "POST",
        url: "{{ route('master.getDivisiByDept') }}", 
        data:{
          id_dept
        },
        success:function(response){
          let row = '<option value="" selected disabled>Pilih Divisi</option>'
          $.map(response, function(val, i){
            row += '<option value="'+val.id+'">'+val.divisi_name+'</option>'
          })
          $("[name='divisi_baru']").html(row); 
        }
      });
    }else{
      $("[name='divisi_baru']").html('<option value="">Pilih Divisi</option>'); 
    }
  })

  $("#frmEmpTransfer").on('submit', function () {
    event.preventDefault()
    let formData = $(this).serialize()
    formData += "&id="+id_data
    let urlPost = "{{ route('karyawan.transferEmp') }}"
    let method = "POST"

    ACTION_PROCESS(urlPost, formData, method)
    resetFormTransferEmp()
    $("#modalEmpTransfer").modal('hide')
  })

  function resetFormTransferEmp(){
    $('.select2').val(null).trigger('change');
    $("#frmEmpTransfer")[0].reset()
  }
  
</script>

@endsection