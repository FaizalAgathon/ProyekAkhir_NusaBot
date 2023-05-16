@extends('layouts.pPerusahaan.app')

@section('content-pageTitle')
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('pPerusahaan-index') }}">Dashboard</a></li>
      <li class="breadcrumb-item active">Profile</li>
    </ol>
  </nav>
@endsection

@section('content-body')
  <section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
            <h2>{{ Auth::guard('pPerusahaan')->user()->nama_pp }}</h2>
            <h3>Pembimbing Perusahaan</h3>
          </div>
        </div>

      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
              </li>

            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">

                <h5 class="card-title">Profile Details</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Name</div>
                  <div class="col-lg-9 col-md-8">{{ Auth::guard('pPerusahaan')->user()->nama_pp }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email</div>
                  <div class="col-lg-9 col-md-8">{{ Auth::guard('pPerusahaan')->user()->email_pp }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">JK</div>
                  <div class="col-lg-9 col-md-8">{{ Auth::guard('pPerusahaan')->user()->jk_pp }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Perusahaan</div>
                  <div class="col-lg-9 col-md-8">{{ $data->perusahaan->nama_p }}</div>
                </div>

              </div>

            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>
    </div>
  </section>
@endsection
