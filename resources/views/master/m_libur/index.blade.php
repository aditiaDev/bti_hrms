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
          </div>
        </div>
      </div>
      <div class="row">

        <div class="col-xs-12 col-md-8">
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
                      <table id="tb_dtl" class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th style="text-align: center">Tanggal</th>
                            <th style="text-align: center">Nama</th>
                            <th>Tipe</th>
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
@endsection
@section('page-js')
<script src="{{ asset('js/datatables.min.js') }}"></script>
<script>
  let tb_data

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
      scrollY:600,
      scrollX: true,
      "ajax": {
        "url": "{{ route('master.libur.getByYear') }}",
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

      ],
      
    })
  }
</script>
@endsection