<div id="sidebar" class="sidebar responsive ace-save-state sidebar-fixed sidebar-scroll">
  <script type="text/javascript">
    try{ace.settings.loadState('sidebar')}catch(e){}
  </script>

  <div class="sidebar-shortcuts" id="sidebar-shortcuts">
    <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
      <button class="btn btn-success">
        <i class="ace-icon fa fa-signal"></i>
      </button>

      <button class="btn btn-info">
        <i class="ace-icon fa fa-pencil"></i>
      </button>

      <button class="btn btn-warning">
        <i class="ace-icon fa fa-users"></i>
      </button>

      <button class="btn btn-danger">
        <i class="ace-icon fa fa-cogs"></i>
      </button>
    </div>

    <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
      <span class="btn btn-success"></span>

      <span class="btn btn-info"></span>

      <span class="btn btn-warning"></span>

      <span class="btn btn-danger"></span>
    </div>
  </div><!-- /.sidebar-shortcuts -->

  <ul class="nav nav-list">
    <li class="">
      <a href="index.html">
        <i class="menu-icon fa fa-tachometer"></i>
        <span class="menu-text"> Dashboard </span>
      </a>

      <b class="arrow"></b>
    </li>

    <li class="active open">
      <a href="#" class="dropdown-toggle">
        <i class="menu-icon fa fa-users"></i>

        <span class="menu-text">
          Kepegawaian
        </span>

        <b class="arrow fa fa-angle-down"></b>
      </a>

      <b class="arrow"></b>

      <ul class="submenu">
        <li class="">
          <a href="{{ route('karyawan') }}">
            <i class="menu-icon fa fa-caret-right"></i>
            Data Karyawan
          </a>

          <b class="arrow"></b>
        </li>
      </ul>
    </li>

    <li class="active open">
      <a href="#" class="dropdown-toggle">
        <i class="menu-icon fa fa-tasks"></i>

        <span class="menu-text">
          Data Master
        </span>

        <b class="arrow fa fa-angle-down"></b>
      </a>

      <b class="arrow"></b>

      <ul class="submenu">
        <li class="">
          <a href="{{ route('master.shift') }}">
            <i class="menu-icon fa fa-caret-right"></i>
            Master Shift
          </a>

          <b class="arrow"></b>
        </li>
        <li class="">
          <a href="{{ route('master.libur') }}">
            <i class="menu-icon fa fa-caret-right"></i>
            Libur & Cuti Bersama
          </a>

          <b class="arrow"></b>
        </li>
      </ul>
    </li>

    <li class="active open">
      <a href="#" class="dropdown-toggle">
        <i class="menu-icon fa fa-clock-o"></i>

        <span class="menu-text">
          Attendance
        </span>

        <b class="arrow fa fa-angle-down"></b>
      </a>

      <b class="arrow"></b>

      <ul class="submenu">
        <li class="">
          <a href="#">
            <i class="menu-icon fa fa-caret-right"></i>
            Penentuan Shift
          </a>

          <b class="arrow"></b>
        </li>

      </ul>
    </li>

    <li class="active open">
      <a href="#" class="dropdown-toggle">
        <i class="menu-icon fa fa-cogs"></i>

        <span class="menu-text">
          Konfigurasi
        </span>

        <b class="arrow fa fa-angle-down"></b>
      </a>

      <b class="arrow"></b>

      <ul class="submenu">
        <li class="">
          <a href="{{ route('role') }}">
            <i class="menu-icon fa fa-caret-right"></i>
            User Role
          </a>

          <b class="arrow"></b>
        </li>
      </ul>
    </li>
  </ul><!-- /.nav-list -->

  <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
    <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state"
      data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
  </div>
</div>