@extends('layouts.siswa.app')

@section('content-body')
  <div class="pagetitle">
    <h1>{{ Auth::guard('siswa')->user()->nama_s }}</h1>
    <nav>
      <ol class="breadcrumb">
        {{-- <li class="breadcrumb-item"><a href="index.html">Home</a></li> --}}
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!--====== CARD PART START ======-->
      <section class="card-area pb-5">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-7 col-sm-9">
              <div class="single-card card-style-one">
                <div class="card-image">
                  <img src="https://cdn.ayroui.com/1.0/images/card/card-1.jpg" alt="Image" />
                </div>
                <div class="card-content">
                  <h4 class="card-title">
                    <a href="javascript:void(0)">Item title is here</a>
                  </h4>
                  <p class="text">
                    Short description for the ones who look for something new
                  </p>
                </div>
              </div>
              <!-- single-card -->
            </div>
            <!-- col -->
            <div class="col-lg-4 col-md-7 col-sm-9">
              <div class="single-card card-style-one">
                <div class="card-image">
                  <img src="https://cdn.ayroui.com/1.0/images/card/card-2.jpg" alt="Image" />
                </div>
                <div class="card-content">
                  <h4 class="card-title">
                    <a href="javascript:void(0)">Item title is here</a>
                  </h4>
                  <p class="text">
                    Short description for the ones who look for something new
                  </p>
                </div>
              </div>
              <!-- single-card -->
            </div>
            <!-- col -->
            <div class="col-lg-4 col-md-7 col-sm-9">
              <div class="single-card card-style-one">
                <div class="card-image">
                  <img src="https://cdn.ayroui.com/1.0/images/card/card-3.jpg" alt="Image" />
                </div>
                <div class="card-content">
                  <h4 class="card-title">
                    <a href="javascript:void(0)">Item title is here</a>
                  </h4>
                  <p class="text">
                    Short description for the ones who look for something new
                  </p>
                </div>
              </div>
              <!-- single-card -->
            </div>
            <!-- col -->
          </div>
          <!-- row -->
        </div>
        <!-- container -->
      </section>
      <!--====== CARD PART ENDS ======-->

    </div>
  </section>
@endsection
