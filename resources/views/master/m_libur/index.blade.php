@extends('layouts.app')

@section('page-css')
<link rel="stylesheet" href="{{ asset('css/sweetalert2.css') }}">
<link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
<style>
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
                      <div class="col-xs-12 col-md-2">
                        <div class="form-horizontal">
                          <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right"> Tahun</label>

                            <div class="col-sm-8">
                              <input type="text" name="tahun" maxlength="4" onkeypress="return onlyNumberKey(event)"
                                value="{{ date('Y') }}" class="form-control">
                            </div>
                          </div>

                        </div>
                      </div>
                      <div class="col-xs-12 col-md-2">
                        <div class="form-horizontal">
                          <div class="form-group">
                            <div class="col-sm-12">
                              <button type="button" id="btnFilter" class="btn btn-info btn-sm">
                                <i class="ace-icon fa fa-filter bigger-110"></i>Filter
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
            <button type="button" class="btn btn-sm btn-info" id="btnShowGenAPI">
              <i class="ace-icon fa fa-plus-circle bigger-110"></i>
              Input Using API
            </button>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 col-md-5">
          <div class="widget-box">
            <div class="widget-header">
              <h4 class="widget-title" id="titleAction">Add Data</h4>

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
                  <div class="form-horizontal">
                    <div class="form-group">
                      <label class="col-sm-3 control-label no-padding-right"> Tanggal</label>

                      <div class="col-sm-4">
                        <input type="text" name="tgllibur" class="form-control datepicker">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label no-padding-right"> Nama</label>

                      <div class="col-sm-8">
                        <input type="text" name="libur_name" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label no-padding-right"> Tipe</label>

                      <div class="col-sm-6">
                        <select name="type" class="form-control">
                          @foreach ($data['tipe_libur'] as $item)
                          <option value="{{ $item->code }}" {{ $item->code == '1' ?
                            'selected' :
                            '' }}>{{ $item->desc }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-3 control-label no-padding-right"> Mengurangi Cuti</label>

                      <div class="col-sm-2">
                        <div class="checkbox">
                          <label style="padding-left: 10px;">
                            <input name="isreduce_leave" class="ace ace-switch ace-switch-4 btn-rotate" type="checkbox"
                              value="1">

                            <span class="lbl"></span>
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <select name="id_cuti" class="form-control" disabled>
                          @foreach ($data['MCuti'] as $item)
                          <option value="{{ $item->id }}" {{ $item->id == '5' ? 'selected' : '' }}>{{ $item->cuti_name
                            }}
                          </option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    {{-- <div class="form-group">
                      <label class="col-sm-3 control-label no-padding-right"> Note</label>

                      <div class="col-sm-6">
                        <textarea name="note" class="form-control"></textarea>
                      </div>
                    </div> --}}

                  </div>
                </div>
                <div class="widget-toolbox padding-4 clearfix">
                  <div class="btn-group pull-left">
                    <button class="btn btn-sm btn-default" onclick="resetForm()">
                      <i class="ace-icon fa fa-times bigger-125"></i>
                      Cancel
                    </button>
                  </div>

                  <div class="btn-group pull-right">
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

        <div class="col-xs-12 col-md-7">
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
                      <table id="tb_data" class="table table-bordered table-hover" style="width:100%">
                        <thead>
                          <tr>
                            <th>Tanggal</th>
                            <th style="text-align: center">Nama</th>
                            <th style="text-align: center;">Tipe</th>
                            <th>Mengurangi Cuti</th>
                            <th>Action</th>
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
<div class="modal fade" id="modalGenAPI" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="bootbox-close-button close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Input from API</h4>
      </div>
      <form id="frmGenAPI">
        <div class="modal-body">
          <div class="row">
            <div class="col-xs-12 col-md-12">
              <div style="display: block;
              overflow-x: auto;
              overflow-y: auto;
              white-space: nowrap;
              height: 600px;">
                <div class="row">
                  <div class="col-xs-12 col-md-4">
                    <div class="form-horizontal">
                      <div class="form-group">
                        <label class="col-xs-2 col-sm-2 control-label no-padding-right"> Tahun</label>

                        <div class="col-xs-6 col-sm-6">
                          <input type="text" name="gen_tahun" maxlength="4" onkeypress="return onlyNumberKey(event)"
                            class="form-control">
                        </div>
                        <div class="col-xs-4 col-sm-4">
                          <button class="btn btn-sm btn-info" id="btnGenAPI">Generate</button>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
                <table id="tb_genAPI" class="table table-bordered" style="min-width: 700px">
                  <thead>
                    <tr>
                      <th style="text-align: center;width: 50px;">
                        {{-- <button class="btn btn-xs btn-info"><i class="fa fa-plus"></i></button> --}}
                      </th>
                      <th style="width: 80px">Tanggal</th>
                      <th style="width: 250px">Nama</th>
                      <th style="width: 100px">Tipe</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
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
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="{{ asset('js/sweetalert2.js') }}"></script>
<script>
  let action='save'
  let tb_data
  let id_data

  $(".datepicker").datepicker({
    changeMonth: true,
    changeYear: true,
    dateFormat: "yy-mm-dd",
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


  REFRESH_DATA()
  function REFRESH_DATA() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('#tb_data').DataTable().destroy();
    tb_data = $("#tb_data").DataTable({
      "ordering": true,
      "paging": false,
      // "searching": false,
      // fixedHeader: {
      //   header: true,
      // },
      scrollY:600,
      scrollX: true,
      "ajax": {
        "url": "{{ route('master.libur.getByYear') }}",
        "type": "POST",
        "data": {
          "tahun": $("[name='tahun']").val()
        },
        "beforeSend": function(request) {
          request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content') );
        },
      },
      "columnDefs": [
        {
          "targets": 0,
          "width": "100px",
        },
        {
          "targets": 1,
          "width": "250px",
        },
        {
          "targets": 2,
          "width": "150px",
        },
        {
          "targets": 4,
          "orderable": false,
          "width": "120px",
        },
      ],
      "columns": [
        { "data": "tgllibur", className: "text-center" },
        { "data": "libur_name" },
        { "data": "desc" },
        {
          "data": "isreduce_leave", 
          "render": function (data) {
            let row = ''
            if (data == 1) {
              row = '&#10004;'
            }

            return row
          },
          className: "text-center"
        },
        { "data": null,
          "render": function (data) {
            let row = "<button class='btn btn-xs btn-warning' title='Edit Data' onclick='editData(" + JSON.stringify(data) + ");'>Edit</button> "+
                      "<button class='btn btn-xs btn-danger' title='Delete Data' onclick='deleteData(\"" + data.id + "\");'>Delete</button>"
            return row
          },
          className: "text-center" 
        },
      ],
      
    })
  }

  $("#btnFilter").click(function(){
    REFRESH_DATA()
  })

  function onlyNumberKey(evt) {
    let ASCIICode = (evt.which) ? evt.which : evt.keyCode
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
        return false;
    return true;
  }

  $("[name='isreduce_leave']").change(function(){
    if ($(this).is(":checked") == true) {
      $("[name='id_cuti']").attr('disabled', false)
    }else{
      $("[name='id_cuti']").attr('disabled', true)
    }
  })

  function resetForm() {
    event.preventDefault()
    document.getElementById("frmData").reset();
    action='save'
    $("#titleAction").text('Add Data')
  }

  function ACTION_PROCESS(urlPost, formData, method) {
    $.ajax({
      url: urlPost,
      type: method,
      data: formData,
      dataType: "JSON",
      success: function (data) {

        Swal.fire({
          icon: data.status,
          text: data.message,

          timer: 5000
        });
        REFRESH_DATA()
        resetForm()
        action='save'
        $("#titleAction").text('Add Data')
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

  $("#frmData").on('submit', function () {
    event.preventDefault()

    let formData = $("#frmData").serialize()

    if ($("[name='isreduce_leave']").is(":checked") == false) {
      formData += '&isreduce_leave=0&id_cuti=0'
    }

    if (action == "save") {
      urlPost = "{{ route('master.libur.store') }}"
      method = "POST"
    }else{
      urlPost = "{{ route('master.libur.update') }}"
      formData += "&id="+id_data
      method = "POST"
    }

    ACTION_PROCESS(urlPost, formData, method)
  })

  function editData(data){
    event.preventDefault()
    action = "edit"

    $("#titleAction").text('Edit Data')
    console.log(data)
    id_data = data.id
    $("[name='tgllibur']").val(data.tgllibur)
    $("[name='libur_name']").val(data.libur_name)
    $("[name='type']").val(data.type)
    if(data.isreduce_leave == 0){
      $("[name='isreduce_leave']").prop('checked', false)
    }else{
      $("[name='isreduce_leave']").prop('checked', true)
    }
    // $("[name='id_cuti']").val(data.id_cuti)
    
  }

  function deleteData(id){
    if (!confirm('Hapus data ini?')) return
    urlPost = "{{ route('master.libur.destroy') }}"
    formData = "id="+id
    method = "POST"

    ACTION_PROCESS(urlPost, formData, method)
  }

  $("#btnShowGenAPI").click(function(){
    event.preventDefault()
    $("#modalGenAPI").modal('show')
  })

  $("#btnGenAPI").click(function(){
    event.preventDefault()
    if($("[name='gen_tahun']").val() == ""){
      alert('Input Tahun')
      $("[name='gen_tahun']").focus()
      return
    }
    
    $.ajax({
      url: "{{ route('master.libur.liburAPI') }}",
      type: "POST",
      data: {
        tahun: $("[name='gen_tahun']").val()
      },
      dataType: "JSON",
      success: function(result){
        // console.log(result)
        let arr = result['data']
        let row=''
        for (var item of arr.reverse()) {
          row += "<tr>"+
                  "<td style='text-align: center'><button class='btn btn-xs btn-danger'><i class='fa fa-minus'></i></button></td>"+
                  "<td><input type='text' name='tgllibur[]' class='form-control datepicker' value='"+item.tanggal+"'></td>"+
                  "<td><input type='text' name='libur_name[]' class='form-control'  value='"+item.nama+"'></td>"+
                  "<td><select name='type[]' class='form-control' >"+
                  @foreach ($data['tipe_libur'] as $item)
                  "<option value='{{ $item->code }}'>{{ $item->desc }}</option>"+
                  @endforeach
                  "</select></td></tr>"
        }
        $("#tb_genAPI tbody").html(row)
        $(".datepicker").datepicker({
          changeMonth: true,
          changeYear: true,
          dateFormat: "yy-mm-dd",
        })
      }
    })
  })
</script>
@endsection