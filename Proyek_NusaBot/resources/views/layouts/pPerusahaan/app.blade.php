<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ url('img/favicon.png') }}" rel="icon">
  <link href="{{ url('img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ url('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ url('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ url('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ url('vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ url('vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ url('vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ url('vendor/simple-datatables/style.css') }}" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet" />

  {{-- <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css"> --}}

  <!-- Template Main CSS File -->
  <link href="{{ url('css/style.css') }}" rel="stylesheet">
  <link href="{{ url('css/main.css') }}" rel="stylesheet">

  @yield('content-style')

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{ route('pPerusahaan-index') }}" class="logo d-flex align-items-center">
        <img src="{{ url('img/logo.png') }}" alt="">
        <span class="d-none d-lg-block">{{ implode(' ', explode('_', config('app.name'))) }}</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            {{-- <img src="{{ url('img/profile-img.jpg') }}" alt="Profile" class="rounded-circle"> --}}
            <span
              class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::guard('pPerusahaan')->user()->nama_pp }}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{ Auth::guard('pPerusahaan')->user()->nama_pp }}</h6>
              <span>Pembimbing Perusahaan</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('pPerusahaan-profile') }}">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ url('/logout') }}">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link {{ basename($_SERVER['REQUEST_URI']) != 'p-perusahaan' ? 'collapsed' : '' }}"
          href="{{ route('pPerusahaan-index') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link {{ $jurnalActive ?? 'collapsed' }}" data-bs-target="#components-nav"
          data-bs-toggle="collapse" href="#">
          <i class="bi bi-person"></i><span>Jurnal Siswa</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>

        <ul id="components-nav" class="nav-content collapse {{ $jurnalActive ?? '' }}" data-bs-parent="#sidebar-nav">
          @foreach ($listSiswa as $item)
            <li>
              <a href="{{ url('p-perusahaan/jurnal/') . '/' . $item->id_plotting }}"
                class="{{ $item->id_plotting == basename($_SERVER['REQUEST_URI']) ? 'active' : '' }}">
                <i class="bi bi-circle"></i>
                <span>
                  <u>
                    {{ $item->siswa->nis_siswa }} <br>
                  </u>
                  {{ $item->siswa->nama_s }}
                </span>
              </a>
            </li>
          @endforeach
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-heading">Account</li>

      <li class="nav-item">
        <a class="nav-link {{ $profile ?? 'collapsed' }}" href="{{ route('pPerusahaan-profile') }}">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('/logout') }}">
          <i class="bi bi-person"></i>
          <span>Logout</span>
        </a>
      </li><!-- End Profile Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">

      @yield('content-pageTitle')

    </div><!-- End Page Title -->

    @yield('content-body')

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ url('vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ url('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ url('vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{ url('vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ url('vendor/quill/quill.min.js') }}"></script>
  <script src="{{ url('vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ url('vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ url('vendor/php-email-form/validate.js') }}"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  @yield('content-script')

  <!-- Template Main JS File -->
  <script src="{{ url('js/main.js') }}"></script>

  <script>
    $(document).ready(function() {
      $('#datatable').DataTable();
    });
  </script>

</body>

</html>
