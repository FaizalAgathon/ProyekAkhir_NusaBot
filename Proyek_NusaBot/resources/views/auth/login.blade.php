@extends('layouts.auth')

@section('auth-body')
  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              {{-- <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">NiceAdmin</span>
                </a>
              </div><!-- End Logo --> --}}

              <form action="/login" method="POST" class="row g-3 needs-validation" novalidate>
                @csrf
                <div class="card mb-3">

                  <div class="card-body">

                    <div class="pt-4 pb-2">
                      <h5 class="card-title text-center pb-0 fs-4">Login Sebagai : </h5>
                    </div>

                    <div class="col-12">
                      <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="user" id="id-user">
                        <option selected value="siswa">Siswa</option>
                        <option value="admin">Admin</option>
                        <option value="pSekolah">Pembimbing Sekolah</option>
                        <option value="pPerusahaan">Pembimbing Perusahaan</option>
                      </select>
                    </div>

                  </div>
                </div>
                <div class="card mb-3">

                  <div class="card-body">

                    <div class="pt-4 pb-2">
                      <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                      <p class="text-center small">Enter your username & password to login</p>
                    </div>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label" id="label">NIS</label>
                      <div class="input-group has-validation">
                        <input type="text" name="identify" class="form-control" id="identify" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="id-password" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    {{-- <div class="col-12">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                          <label class="form-check-label" for="rememberMe">Remember me</label>
                        </div>
                      </div> --}}
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                    {{-- <div class="col-12">
                        <p class="small mb-0">Don't have account? <a href="pages-register.html">Create an account</a></p>
                      </div> --}}

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
