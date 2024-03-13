@extends('layouts.app')

@section('page-css')
{{--
<link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.dataTables.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('css/sweetalert2.css') }}">
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
                  <div class="row">
                    <div class="col-xs-12 col-md-4">
                      <div class="form-horizontal">
                        <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right"> Departemen</label>

                          <div class="col-sm-8">
                            <select name="dept" class="form-control"></select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right"> Divisi</label>

                          <div class="col-sm-8">
                            <select name="divisi" class="form-control"></select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label no-padding-right"> Jabatan</label>

                          <div class="col-sm-8">
                            <select name="jabatan" class="form-control"></select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-12 col-md-4">
                      <div class="form-horizontal">
                        <div class="form-group">
                          <label class="col-sm-5 control-label no-padding-right"> Status Kepegawaian</label>

                          <div class="col-sm-7">
                            <select name="status_kepegawaian" class="form-control"></select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-5 control-label no-padding-right"> Status Pekerja</label>

                          <div class="col-sm-7">
                            <select name="status_pekerja" class="form-control"></select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-12 col-md-4">
                      <div class="form-horizontal">
                        <div class="form-group">
                          <div class="col-sm-12">
                            <button type="button" class="btn btn-info btn-sm">
                              <i class="ace-icon fa fa-filter bigger-110"></i>Filter
                            </button>
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

      <div class="row">
        <div class="col-xs-12 col-md-12">
          <div style="margin-bottom:10px;">
            <button class="btn btn-sm btn-info" id="btnNew"><i class="ace-icon fa fa-plus-circle bigger-110"></i>
              New</button>
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
                      <table id="tb_data" class="table table-bordered table-hover">
                        <thead>
                          <tr>
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
@endsection
@section('page-js')
<script src="{{ asset('js/datatables.min.js') }}"></script>
{{-- <script src="{{ asset('js/dataTables.responsive.js') }}"></script> --}}
<script src="{{ asset('js/sweetalert2.js') }}"></script>
<script>
  var action
  var tb_data
  let id_data

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  function REFRESH_DATA() {
    $('#tb_data').DataTable().destroy();
    tb_data = $("#tb_data").DataTable({
      "ordering": false,
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
        "data": function (d) {
          d._token = $('meta[name="csrf-token"]').attr('content')
        }
      },
      // "columnDefs": [
      //   { width: '60px', targets: 0 },
      //   { width: '200px', targets: 1 },
      //   { width: '150px', targets: 3 },
      // ],
      "columns": [
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
            let row = "<button class='btn btn-xs btn-warning' title='Edit Data' onclick='editData(" + JSON.stringify(data) + ");'>Edit</button> "
            if(data.isactive == 1){
              row += "<button class='btn btn-xs btn-danger' title='Deactivate Data' onclick='actActivate(0, \"" + data.id + "\");'>Deactivate</button>"
            }else{
              row += "<button class='btn btn-xs btn-info' title='Activate Data' onclick='actActivate(1, \"" + data.id + "\");'>Activate</button>"
            }
            return row
          },
          className: "text-center"
        }

      ],
    })
  }

  REFRESH_DATA()


</script>

@endsection