<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Arbutus+Slab&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ url('fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ url('css/owl.carousel.min.css') }}">

    <link rel="stylesheet" href="{{ url('css/animate.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
    
    <!-- Style -->
    <link rel="stylesheet" href="{{ url('css/style2.css') }}">
    {{-- <link rel="stylesheet" href="{{ url('dropdown-13/css/style.css') }}"> --}}

    <title>Carousel #10</title>
  </head>
  <body>
  

  <div class="content">

    <div class="site-blocks-cover">
      <div class="img-wrap">
        <div class="owl-carousel slide-one-item hero-slider">
          <div class="slide">
            <img src="{{ url('images/hero_1.jpg') }}" alt="">  
          </div>
          <div class="slide">
            <img src="{{ url('images/hero_2.jpg') }}" alt="">  
          </div>
          <div class="slide">
            <img src="{{ url('images/hero_3.jpg') }}" alt="">  
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-6 ml-auto align-self-center">
            <div class="intro">
              <div class="heading">
                <h1 class="text-white font-weight-bold">Jurnal PKL</h1>
              </div>
              <div class="text sub-text">
                <p>Silahkan Pilih anda login sebagai apa!</p>
                <div class="dropdown custom-dropdown">
                  <a href="#" data-toggle="dropdown" class="dropdown-link" aria-haspopup="true" aria-expanded="false">
                    <span class="btn btn-outline-primary btn-md btn-pill">Login Sebagai</span>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a href="/login?user=siswa" class="dropdown-item"><span class="icon-person mr-3"></span>Siswa</a>
                    <a href="/login?user=admin" class="dropdown-item"><span class="icon-person mr-3"></span>Admin</a>
                    <a href="/login?user=pSekolah" class="dropdown-item"><span class="icon-person mr-3"></span>Pembimbing Sekolah</a>
                    <a href="/login?user=pPerusahaan" class="dropdown-item"><span class="icon-person mr-3"></span>Pembimbing Perusahaan</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- END .site-blocks-cover -->
  </div>
    
    

    <script src="{{ url('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ url('js/popper.min.js') }}"></script>
    <script src="{{ url('js/bootstrap.min.js') }}"></script>
    <script src="{{ url('js/owl.carousel.min.js') }}"></script>
    <script src="{{ url('js/main2.js') }}"></script>
  </body>
</html>