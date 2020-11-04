<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E-commerce| Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/skins/_all-skins.min.css') }}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/morris.js/morris.css') }}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/jvectormap/jquery-jvectormap.css') }}">
  <!-- Date Picker -->
  <link rel="stylesheet"
    href="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

  <!-- jQuery 3 -->
  <script src="{{ asset('adminlte/bower_components/jquery/dist/jquery.min.js') }}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ asset('adminlte/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 3.3.7 -->
  <script src="{{ asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <!-- Morris.js charts -->
  <script src="{{ asset('adminlte/bower_components/raphael/raphael.min.js') }}"></script>
  <script src="{{ asset('adminlte/bower_components/morris.js/morris.min.js') }}"></script>
  <!-- Sparkline -->
  <script src="{{ asset('adminlte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
  <!-- jvectormap -->
  <script src="{{ asset('adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{ asset('adminlte/bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
  <!-- daterangepicker -->
  <script src="{{ asset('adminlte/bower_components/moment/min/moment.min.js') }}"></script>
  <script src="{{ asset('adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
  <!-- datepicker -->
  <script src="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}">
  </script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="{{ asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
  <!-- Slimscroll -->
  <script src="{{ asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
  <!-- FastClick -->
  <script src="{{ asset('adminlte/bower_components/fastclick/lib/fastclick.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{ asset('adminlte/dist/js/pages/dashboard.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('adminlte/dist/js/demo.j') }}"></script>


  <link rel="stylesheet"
    href="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
  <script src="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/bootstrap-datepicker.min.js') }}"></script>

  <script>
    $(function(){
      $('.datepicker').datepicker({
      autoclose:true,
      format:'yyyy-mm-dd'
      });
    });
  </script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>E</b>-C</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>E-</b>COMMERCE</span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->

            <!-- Notifications: style can be found in dropdown.less -->

            <!-- Tasks: style can be found in dropdown.less -->

            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="{{ asset('img/userlogo.png') }}" class="user-image" alt="User Image">
                @if(Auth::check())
                <span class="hidden-xs">{{Auth::user()->name}}</span>
                @endif
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="{{ asset('img/userlogo.png') }}" class="img-circle" alt="User Image">

                  <p>
                    @if(Auth::check())
                    {{Auth::user()->name}}
                    <small>{{Auth::user()->level}}</small>
                    @endif
                  </p>
                </li>
                <!-- Menu Body -->

                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">

                  </div>
                  <div class="pull-right">
                    <form method="post" action="{{route('logout')}}">
                      @csrf
                      <button type="submit" class="btn btn-default btn-flat">Sign out</button>
                    </form>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->

          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="{{ asset('img/userlogo.png') }}" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            @if(Auth::check())
            <p>{{Auth::user()->name}}</p>
            @endif
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <!-- search form -->

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        @include('subview.menu')
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          @yield('title')
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">@yield('title')</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        @yield('content')
        <!-- Small boxes (Stat box) -->

        <!-- /.row -->
        <!-- Main row -->

        <!-- /.row (main row) -->

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> 2.4.18
      </div>
      <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE</a>.</strong> All rights
      reserved.
    </footer>

    <!-- Control Sidebar -->

    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->

  </div>
  <!-- ./wrapper -->


</body>

</html>