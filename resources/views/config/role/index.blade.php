@extends('layouts.app')

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
          <a href="#">Configuration</a>
        </li>
        <li class="active">{{ $data['title'] }}</li>
      </ul><!-- /.breadcrumb -->
    </div>

    <div class="page-content">
      <div class="row">
        <div class="col-xs-8 col-md-4">
          <div class="widget-box">
            <div class="widget-header">
              <h4 class="widget-title">Add Data</h4>

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
                  <div>
                    <label>Role Name</label>
                    <input type="text" name="role_name" class="form-control" required>
                  </div>
                  <div>
                    <label>Status Activation</label>

                    <select name="isactive" class="form-control" required>
                      <option value="1">Aktive</option>
                      <option value="0">Not Active</option>
                    </select>
                  </div>
                </div>
                <div class="widget-toolbox padding-4 clearfix">
                  <div class="btn-group pull-left">
                    <button class="btn btn-sm btn-info" onclick="resetForm()">
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
                  <div class="col-xs-12">
                    <div style="overflow-x: auto;">
                      <table id="tb_data" class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Role Name</th>
                            <th>Status Activation</th>
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
<script src="{{ asset('js/dataTables.responsive.js') }}"></script>
<script src="{{ asset('js/sweetalert2.js') }}"></script>
<script>
  let action='save'
  let tb_data
  let id_data
  REFRESH_DATA()
  function REFRESH_DATA() {
    $('#tb_data').DataTable().destroy();
    tb_data = $("#tb_data").DataTable({
      "ordering": false,
      "paging": false,
      "responsive": true,
      "ajax": {
        "url": "{{ route('role.getall') }}",
        "type": "POST",
      },
      "columnDefs": [
        { width: '60px', targets: 0 },
        { width: '200px', targets: 1 },
        { width: '150px', targets: 3 },
      ],
      "autoWidth": false,
      "columns": [
        {
          "data": "id", className: "text-center"
        },
        { "data": "role_name" },
        {
          "data": "isactive",
          "render": function (data) {
            let status = 'Not Active'
            if (data == 1) {
              status = 'Active'
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

  function resetForm() {
    event.preventDefault()
    document.getElementById("frmData").reset();
  }

  $.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

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

    let frmData = $("#frmData").serialize()
    if (action == "save") {
      urlPost = "{{ route('role.store') }}"
      formData = frmData
      method = "POST"
    }else{
      urlPost = "{{ route('role.update') }}"
      formData = frmData+"&id="+id_data
      method = "POST"
    }

    ACTION_PROCESS(urlPost, formData, method)
  })
</script>

@endsection