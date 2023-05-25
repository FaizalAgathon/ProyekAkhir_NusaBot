@extends('layouts.pSekolah.app')

@section('content-body')
  <div class="pagetitle">
    <h1>{{ Auth::guard('pSekolah')->user()->nama_ps }}</h1>
    <nav>
      <ol class="breadcrumb">
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
                <div class="col p-0 d-flex justify-content-center">
                  <a class="card" href="{{ route('pSekolah-daftarJurnal') }}">
                    <p>Jurnal</p>
                    <p class="small m-0">Daftar Jurnal Siswa</p>
                    <div class="go-corner" >
                      <div class="go-arrow">
                        →
                      </div>
                    </div>
                  </a>
                </div>
              </div>
              <div class="row ">
                <div class="col p-0 d-flex justify-content-center">
                  <a class="card" href="{{ route('pSekolah-profile') }}">
                    <p>Profil</p>
                    <p class="small m-0">Profil akun Pembimbing Sekolah</p>
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
