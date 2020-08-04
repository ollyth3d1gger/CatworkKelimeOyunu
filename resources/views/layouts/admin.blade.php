<!DOCTYPE html>
<html>
@php
$setting = App\Setting::first();
@endphp
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" type="image/ico" href="{{asset('/images/logo/'. $setting->favicon)}}">
  <!--[if IE]>
  <link rel="shortcut icon" href="/favicon.ico" type="image/vnd.microsoft.icon">
  <![endif]-->
  <title>{{$setting->welcome_txt}} Admin Panel</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('css/ionicons.min.css')}}">
  <!-- Admin Theme style -->
  <link rel="stylesheet" href="{{asset('css/AdminLTE.css')}}">
  <link rel="stylesheet" href="{{asset('css/skin-black.css')}}">
   <link rel="stylesheet" href="{{asset('css/fontawesome-iconpicker.min.css')}}">
  <!-- Select 2 -->
  <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
  <!-- DataTable -->
  <link rel="stylesheet" href="{{asset('css/datatables.min.css')}}">

  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
  <script
          src="https://code.jquery.com/jquery-2.2.4.min.js"
          integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
          crossorigin="anonymous"></script>


  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="hold-transition skin-black sidebar-mini">
@if ($auth)
<div class="wrapper">
  <!-- Main Header -->
  <header class="main-header">
    <!-- Logo -->
    <a href="{{url('/')}}" class="logo" title="{{$setting->welcome_txt}}">
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
        @if ($setting)
        <img src="{{asset('/images/logo/'.$setting->logo)}}" class="ad-logo img-responsive" alt="{{$setting->welcome_txt}}">
        @endif
      </span>
    </a>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <a href="{{url('/')}}" class="btn visit-btn" target="_blank" title="Visit Site">Siteyi Görüntüle <i class="fa fa-arrow-circle-o-right"></i></a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">{{$auth->name}}</span>
              <i class="fa fa-user hidden-lg hidden-md hidden-sm"></i>
            </a>
            <ul class="dropdown-menu">
              <!-- Menu Body -->
              <li><a href="{{url('/admin/profile')}}" title="Profile">Profile</a></li>
              <li>
                <a href="{{ route('logout') }}" title="Logout"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left info">
          <h4>{{$auth->name}}</h4>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Ana Bölümler</li>
        @if ($auth->role == 'A')
          <!-- Optionally, you can add icons to the links -->
          <li class="{{$dash}}"><a href="{{url('/admin')}}" title="Dashboard"><i class="fa fa-dashboard"></i> <span>Yönetim Paneli</span></a></li>
          <li class="{{$users}}"><a href="{{url('/admin/users')}}" title="Students"><i class="fa fa-users"></i> <span>Yarışmacılar</span></a></li>
          <li class="{{$quiz}}"><a href="{{url('admin/topics')}}" title="Quiz"><i class="fa fa-gears"></i> <span>Quiz</span></a></li>
          <li class="{{$questions}}"><a href="{{url('admin/questions')}}" title="Questions"><i class="fa fa-question-circle-o"></i> <span>Sorular</span></a></li>
          <li class="{{$all_re}}"><a href="{{url('/admin/all_reports')}}" title="Student Report"><i class="fa fa-file-text-o"></i> <span>Klasik Sorular Değerlendirme</span></a></li>
          <li class="{{$top_re}}"><a href="{{url('/admin/top_report')}}" title="Top Student Report"><i class="fa fa-user"></i> <span>Sıralama</span></a></li>

          
           
          <li class="{{$sett}}"><a href="{{url('/admin/settings')}}" title="Settings"><i class="fa fa-gear"></i> <span>Ayarlar</span></a></li>
          

          <li class="treeview {{ Nav::isRoute('pages.index') }} {{ Nav::isRoute('pages.add') }} {{ Nav::isRoute('pages.edit') }} {{ Nav::isRoute('faq.index') }} {{ Nav::isRoute('faq.add') }} {{ Nav::isRoute('faq.edit') }} {{ Nav::isRoute('copyright.index') }} {{ Nav::isRoute('set.facebook') }} {{ Nav::isRoute('customstyle') }} {{ Nav::isRoute('mail.getset') }} {{ Nav::isRoute('socialicons.index')}}">
            <a href="#">
              <i class="fa fa-user"></i> <span>Daha Fazla Seçenek</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{ Nav::isRoute('pages.index') }} {{ Nav::isRoute('pages.add') }} {{ Nav::isRoute('pages.edit') }}"><a href="{{route('pages.index')}}"><i class="fa fa-circle-o"></i>Sayfalar</a>
               </li>

               <li class="{{ Nav::isRoute('faq.index') }} {{ Nav::isRoute('faq.add') }} {{ Nav::isRoute('faq.edit') }}"><a href="{{route('faq.index')}}"><i class="fa fa-circle-o"></i>FAQ</a>
               </li>
                <li class="{{ Nav::isRoute('copyright.index') }}"><a href="{{route('copyright.index')}}"><i class="fa fa-circle-o"></i>Copyright</a>
               </li>

                <li class="{{ Nav::isRoute('set.facebook') }}"><a href="{{route('set.facebook')}}"><i class="fa fa-circle-o"></i>Sosyal Medya Giriş Ayarları</a>
               </li>

               <li class="{{ Nav::isRoute('socialicons.index')}}"><a href="{{route('socialicons.index')}}"><i class="fa fa-circle-o"></i>Sosyal Icon</a>
               </li>
                <li class="{{ Nav::isRoute('mail.getset') }}"><a href="{{route('mail.getset')}}"><i class="fa fa-circle-o"></i>Mail Ayarları</a>
               </li>
               </li>
                <li class="{{ Nav::isRoute('customstyle') }}"><a href="{{route('customstyle')}}"><i class="fa fa-circle-o"></i>Özel Stil Ayarları</a>
               </li>

            </ul>


          </li>



        @elseif ($auth->role == 'S')
          <li><a href="{{url('/admin/my_reports')}}" title="My Reports"><i class="fa fa-file-text-o"></i> <span>Sonuçlarım</span></a></li>

          <li><a href="{{url('/admin/profile')}}" title="My Profile"><i class="fa fa-file-text-o"></i> <span>Profilim</span></a></li>

           {{-- <li><a href="{{url('/admin/payment')}}" title="Payment History"><i class="fa fa-money"></i> <span>Payment History</span></a></li> --}}
        @endif
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @if (Session::has('added'))
      <div class="alert alert-success sessionmodal">
        {{session('added')}}
      </div>
    @elseif (Session::has('updated'))
      <div class="alert alert-info sessionmodal">
        {{session('updated')}}
      </div>
    @elseif (Session::has('deleted'))
      <div class="alert alert-danger sessionmodal">
        {{session('deleted')}}
      </div>
    @endif
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{$page_header}}
        {{-- <small>Optional description</small> --}}
      </h1>
    </section>
    <!-- Main content -->
    <section class="content container-fluid">
      @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Main Footer -->
  <footer class="main-footer">   
      @php
      $copyright = \DB::table('copyrighttexts')->first()->name;
      @endphp 
    <!-- Default to the left -->
    <strong>
        
        {{ $copyright }}

    </strong>
  </footer>
</div>
@endif
<!-- ./wrapper -->
<!-- REQUIRED JS SCRIPTS -->
<!-- jQuery 3 -->

<script src="{{asset('js/jquery.min.js')}}"></script>

<!-- Bootstrap 3.3.7 -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!-- DataTable -->
<script src="{{asset('js/datatables.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('js/select2.full.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('js/adminlte.min.js')}}"></script>

<script src="{{asset('js/fontawesome-iconpicker.min.js')}}"></script>


<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>



<script>
  $(function () {
    $( document ).ready(function() {
       $('.sessionmodal').addClass("active");
       setTimeout(function() {
           $('.sessionmodal').removeClass("active");
      }, 4500);
    });

    $('#example1').DataTable({
      "sDom": "<'row'><'row'<'col-md-4'l><'col-md-4'B><'col-md-4'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
      buttons: [
            {
               extend: 'print',
               exportOptions: {
                   columns: ':visible'
               }
            },
            'csvHtml5',
            'excelHtml5',
            'colvis',
          ]
    });

    $('#questions_table').DataTable({
      "sDom": "<'row'><'row'<'col-md-4'l><'col-md-4'B><'col-md-4'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
      buttons: [
        {
           extend: 'print',
           exportOptions: {
               columns: ':visible'
           }
        },
        'csvHtml5',
        'excelHtml5',
        'colvis',
      ],
      columnDefs: [
        { targets: [7,8,9,10], visible: false},
      ]
    });

    $('#search').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : false,
      'autoWidth'   : true,
      "sDom": "<'row'><'row'<'col-md-4'B><'col-md-8'f>r>t<'row'>",
      buttons: [
            {
               extend: 'print',
               exportOptions: {
                   columns: ':visible'
               }
            },
            'excelHtml5',
            'csvHtml5',
            'colvis',
          ]
    });

    $('#topTable').DataTable({
      "order": [[ 5, "desc" ]],
      "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
      "sDom": "<'row'><'row'<'col-md-4'l><'col-md-4'B><'col-md-4'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
      buttons: [
            {
               extend: 'print',
               exportOptions: {
                   columns: ':visible'
               }
            },
            'excelHtml5',
            'csvHtml5',
            'colvis',
          ]
    });
    //Initialize Select2 Elements
    $('.select2').select2()
    $('.currency-icon-picker').iconpicker({
      title: 'Currency Symbols',
      icons: ['fa fa-dollar', 'fa fa-euro', 'fa fa-gbp', 'fa fa-ils', 'fa fa-inr', 'fa fa-krw', 'fa fa-money', 'fa fa-rouble', 'fa fa-try'],
      selectedCustomClass: 'label label-primary',
      mustAccept: true,
      placement: 'topRight',
      showFooter: false,
      hideOnSelect: true
    });
  });


                                  
</script>


 @if($setting->right_setting == 1)
  <script type="text/javascript" language="javascript">
   // Right click disable
    $(function() {
    $(this).bind("contextmenu", function(inspect) {
    inspect.preventDefault();
    });
    });
      // End Right click disable
  </script>
@endif

@if($setting->element_setting == 1)
<script type="text/javascript" language="javascript">
//all controller is disable
      $(function() {
      var isCtrl = false;
      document.onkeyup=function(e){
      if(e.which == 17) isCtrl=false;
}

      document.onkeydown=function(e){
       if(e.which == 17) isCtrl=true;
      if(e.which == 85 && isCtrl == true) {
     return false;
    }
 };
      $(document).keydown(function (event) {
       if (event.keyCode == 123) { // Prevent F12
       return false;
  }
      else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I
     return false;
   }
 });
});
     // end all controller is disable
 </script>


@endif





@yield('scripts')
</body>
</html>
