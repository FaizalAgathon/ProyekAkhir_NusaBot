@extends('layouts.auth')

@section('auth-body')
  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <form action="/{{ basename($_SERVER['REQUEST_URI']) }}" method="POST" class="row g-3 needs-validation" novalidate>
                @csrf
                <div class="card mb-3">

                  <div class="card-body">

                    <div class="pt-4 pb-2">
                      <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                      <p class="text-center small">Enter your username & password to login</p>
                    </div>

                    <div class="col-12 mb-3">
                      <label for="yourUsername" class="form-label" id="label">{{ $Identify }}</label>
                      <div class="input-group has-validation">
                        <input type="text" name="{{ $nameValidate ?? '' }}" class="form-control" id="identify" @error($nameValidate) is-invalid @enderror>
                        <div class="invalid-feedback">This field is Required.</div>
                      </div>
                    </div>

                    <div class="col-12 mb-3">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="id-password" @error('password') is-invalid @enderror>
                      <div class="invalid-feedback">This field is Required.</div>
                    </div>
                    
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                  </div>
                </div>
              </form>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  {{-- <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a> --}}

  <script>
    document.querySelector('#id-user').addEventListener("change", function() {
      if (this.value == "siswa") {
        // document.getElementById('identify').setAttribute('name', 'nis_s');
        document.getElementById('label').textContent = 'NIS';
      } else if (this.value == 'admin') {
        // document.getElementById('identify').setAttribute('name', 'email_a');
        document.getElementById('label').textContent = 'Email';
      } else if (this.value == 'pPerusahaan') {
        // document.getElementById('identify').setAttribute('name', 'email_pp');
        document.getElementById('label').textContent = 'Email';
      } else if (this.value == 'pSekolah') {
        // document.getElementById('identify').setAttribute('name', 'nip_ps');
        document.getElementById('label').textContent = 'NIP';
      }
    });
  </script>
@endsection
