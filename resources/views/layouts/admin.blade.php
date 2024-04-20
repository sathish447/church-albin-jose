@php use Illuminate\Support\Facades\Auth; @endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @yield('page_title', conf('name'))
    </title>
    <link rel="icon" href="{{ btheme() }}/favicon.png?{{ ver() }}" type="image/png" sizes="220x220">
    <link rel="stylesheet" href="{{ btheme() }}/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ btheme() }}/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="{{ btheme() }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="{{ btheme() }}/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="{{ btheme() }}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="{{ btheme() }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ btheme() }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ btheme() }}/plugins/datatables-rowreorder/css/rowReorder.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ btheme() }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="{{ btheme() }}/css/custom.css">

    @yield('head-script')
    @stack('head-script')
    @yield('style')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <?php
      if (!isset($active_sub)) $active_sub = '*********';
      if (!isset($active)) $active = '*********';
    ?>

      <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="" src="{{ btheme() }}/images/logo.png?{{ ver() }}" alt="{{ conf('name') }}" width="200">
    </div>

    @include('layouts.navbar')

    @include('layouts.sidebar')


    <div class="content-wrapper">
        <!-- breadcrums -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">
                            @yield('page_title')
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @yield('breadcrumb')
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
    </div>
       @include('layouts.footer')
</div>

@if ($errors->any())
    <div style="display:none" id="error_list">{!! implode('<br/>', $errors->all()) !!}</div>
@endif

<div class="loading" id="loaderModal" style="display: none;">
    <div class="spinner">
        <div class="double-bounce1"></div>
        <div class="double-bounce2"></div>
    </div>
</div>

  <!-- Scripts -->
  @include('layouts.scripts')

  @yield('scripts')
  @stack('scripts')