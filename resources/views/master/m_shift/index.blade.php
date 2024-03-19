@extends('layouts.app')

@section('page-css')
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
          <div style="margin-bottom:10px;">
            <a class="btn btn-sm btn-info" href="#" id="btnNew">
              <i class="ace-icon fa fa-plus-circle bigger-110"></i>
              New
            </a>
            <button class="btn btn-sm btn-warning" id="btnEdit">
              <i class="ace-icon fa fa-pencil-square-o bigger-110"></i>
              Edit
            </button>
            <button class="btn btn-sm btn-danger" id="btnDelete">
              <i class="ace-icon fa fa-trash bigger-110"></i>
              Delete
            </button>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 col-md-4">
          <div class="widget-box">
            <div class="widget-header">
              <h4 class="widget-title" id="titleAction">{{ $data['title'] }}</h4>

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
                <div style="overflow-x: auto;">
                  <table id="tb_hdr" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width: 70%">Nama Shift</th>
                        <th>Libur Random</th>
                      </tr>
                    </thead>
                    <tbody></tbody>
                  </table>
                </div>
              </div>
            </div>

          </div>
        </div>

        <div class="col-xs-12 col-md-8">
          <div class="widget-box">
            <div class="widget-header">
              <h4 class="widget-title">Detail Shift</h4>

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
                      <table id="tb_dtl" class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th style="text-align: center">Hari</th>
                            <th>Masuk</th>
                            <th>Pulang</th>
                            <th>Break 1 Awal</th>
                            <th>Break 1 Akhir</th>
                            <th>Break 2 Awal</th>
                            <th>Break 2 Akhir</th>
                            <th>Break 3 Awal</th>
                            <th>Break 3 Akhir</th>
                            <th>NextDay</th>
                            <th>Work Hours</th>
                            <th>Overtime</th>
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
<script>
  let tb_hdr
  let tb_dtl

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

    $('#tb_hdr').DataTable().destroy();
    tb_hdr = $("#tb_hdr").DataTable({
      "ordering": true,
      "paging": false,
      fixedHeader: {
        header: true,
      },
      scrollY:400,
      scrollX: true,
      "ajax": {
        "url": "{{ route('master.shift.gethdrall') }}",
        "type": "POST",
        "beforeSend": function(request) {
          request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content') );
        },
      },
      "columnDefs": [
        {
          "targets": 1,
          "orderable": false
        },
      ],
      "columns": [
        { "data": "shift_name" },
        {
          "data": "libur_random", 
          "render": function (data) {
            let row = ''
            if (data == 1) {
              row = '&#10004;'
            }

            return row
          },
          className: "text-center"
        },

      ],
      
    })
  }

  $('body').on( 'click', '#tb_hdr tbody tr', function (e) {
    var Rowdata = tb_hdr.row( this ).data();
    // console.log(Rowdata)
    ISI_SHIFT_DTL(Rowdata.id)

    let classList = e.currentTarget.classList;
    if (classList.contains('selected')) {
        classList.remove('selected');
    }
    else {
      tb_hdr.rows('.selected').nodes().each((row) => row.classList.remove('selected'));
        classList.add('selected');
    }
  });

  function ISI_SHIFT_DTL(id_shift){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('#tb_dtl').DataTable().destroy();
    tb_dtl = $("#tb_dtl").DataTable({
      "ordering": false,
      "paging": false,
      "searching": false,
      "info": false,
      // fixedHeader: {
      //   header: true,
      // },
      // scrollY:400,
      // scrollX: true,
      "ajax": {
        "url": "{{ route('master.shift.getdtlbyid') }}",
        "type": "POST",
        "data": {
          "id_shift": id_shift
        },
        "beforeSend": function(request) {
          request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content') );
        },
      },
      "columns": [
        { "data": "day_name" },
        { "data": "shift_in", className: "text-center" },
        { "data": "shift_out", className: "text-center" },

        { "data": "break_in1", className: "text-center" },
        { "data": "break_out1", className: "text-center" },

        { "data": "break_in2", className: "text-center" },
        { "data": "break_out2", className: "text-center" },

        { "data": "break_in3", className: "text-center" },
        { "data": "break_out3", className: "text-center" },
        {
          "data": "nextday", 
          "render": function (data) {
            let row = ''
            if (data == 1) {
              row = '&#10004;'
            }

            return row
          },
          className: "text-center"
        },
        { "data": "workhour", className: "text-center" },
        {
          "data": "isOT_day", 
          "render": function (data) {
            let row = ''
            if (data == 1) {
              row = '&#10004;'
            }

            return row
          },
          className: "text-center"
        },
      ],
      
    })
  }
</script>
@endsection