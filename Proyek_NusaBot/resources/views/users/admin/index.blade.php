@extends('layouts.admin.app')

@section('content-body')
  <div class="pagetitle">
    <h1>{{ Auth::guard('admin')->user()->email_a }}</h1>
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
            <div class="card-list py-5">
              <div class="row ">
                <div class="col p-0 d-flex justify-content-center justify-content-xl-end">
                  <a class="card" href="{{ route('admin-readAngkatan') }}">
                    <p>Angkatan</p>
                    <p class="small m-0">Daftar angkatan Siswa</p>
                    <div class="go-corner" >
                      <div class="go-arrow">
                        →
                      </div>
                    </div>
                  </a>
                </div>
                <div class="col-3 p-0 d-flex justify-content-center">
                  <a class="card" href="{{ route('admin-readSiswa') }}">
                    <p>Siswa</p>
                    <p class="small m-0">Daftar akun Siswa</p>
                    <div class="go-corner" >
                      <div class="go-arrow">
                        →
                      </div>
                    </div>
                  </a>
                </div>
                <div class="col p-0 d-flex justify-content-center justify-content-xl-start">
                  <a class="card" href="{{ route('admin-readJurusan') }}">
                    <p>Jurusan</p>
                    <p class="small m-0">Daftar jurusan Siswa</p>
                    <div class="go-corner" >
                      <div class="go-arrow">
                        →
                      </div>
                    </div>
                  </a>
                </div>
              </div>
              <div class="row ">
                <div class="col p-0 d-flex justify-content-center justify-content-xxl-end">
                  <a class="card" href="{{ route('admin-readPerusahaan') }}">
                    <p>Perusahaan</p>
                    <p class="small m-0">Daftar perusahaan</p>
                    <div class="go-corner" >
                      <div class="go-arrow">
                        →
                      </div>
                    </div>
                  </a>
                </div>
                <div class="col-3 p-0 d-flex justify-content-center">
                  <a class="card" href="{{ route('admin-readPPerusahaan') }}">
                    <p>P. Perusahaan</p>
                    <p class="small m-0">Daftar Pembimbing Perusahaan</p>
                    <div class="go-corner" >
                      <div class="go-arrow">
                        →
                      </div>
                    </div>
                  </a>
                </div>
                <div class="col p-0 d-flex justify-content-center justify-content-xxl-start">
                  <a class="card" href="{{ route('admin-readPSekolah') }}">
                    <p>P. Sekolah</p>
                    <p class="small m-0">Daftar Pembimbing Sekolah</p>
                    <div class="go-corner" >
                      <div class="go-arrow">
                        →
                      </div>
                    </div>
                  </a>
                </div>
              </div>
              <div class="row ">
                <div class="col p-0 d-flex justify-content-center justify-content-xxl-end">
                  <a class="card" href="{{ route('admin-readPlotting') }}">
                    <p>Penempatan</p>
                    <p class="small m-0">Daftar penempatan</p>
                    <div class="go-corner" >
                      <div class="go-arrow">
                        →
                      </div>
                    </div>
                  </a>
                </div>
                <div class="col p-0 d-flex justify-content-center justify-content-xxl-start">
                  <a class="card" href="{{ route('admin-readAdmin') }}">
                    <p>Admin</p>
                    <p class="small m-0">Daftar akun Admin</p>
                    <div class="go-corner" >
                      <div class="go-arrow">
                        →
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <!-- row -->
        </div>
        <!-- container -->
      </section>
      <!--====== CARD PART ENDS ======-->

    </div>
  </section>
@endsection
