@extends('layouts.admin.app')

@section('content-body')
  <div class="pagetitle">
    <h1>Siswa</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Siswa</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="card-list p-4">

    <div class="button-group mb-3">

      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add">
        + Add
      </button>

      <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#pdf">
        Export PDF
      </button>

      {{-- SECTION MODAL TAMBAH --}}
      <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Siswa</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('/admin/siswa') }}" method="post"> @csrf
              <div class="modal-body">
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1">NIS : </span>
                  <input type="text" class="form-control" name="nis">
                </div>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1">Nama : </span>
                  <input type="text" class="form-control" name="nama">
                </div>
                <div class="input-group mb-3">
                  <label class="input-group-text" for="inputGroupSelect02">JK : </label>
                  <select class="form-select" id="inputGroupSelect02" name="jk">
                    <option selected value="L">L</option>
                    <option value="P">P</option>
                  </select>
                </div>
                <div class="input-group mb-3">
                  <label class="input-group-text" for="inputGroupSelect01">Angkatan : </label>
                  <select class="form-select" id="inputGroupSelect01" name="angkatan">
                    <option selected>Choose...</option>
                    @foreach ($dataKelas as $item)
                      {{-- @dd($item) --}}
                      <option value="{{ $item->id_kelas }}">{{ $item->angkatan_k }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="input-group mb-3">
                  <label class="input-group-text" for="inputGroupSelect01">Jurusan : </label>
                  <select class="form-select" id="inputGroupSelect01" name="jurusan">
                    <option selected>Choose...</option>
                    @foreach ($dataJurusan as $item)
                      {{-- @dd($item) --}}
                      <option value="{{ $item->id_jurusan }}">{{ $item->nama_j }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success"> + Add </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      {{-- !SECTION MODAL TAMBAH --}}

      {{-- SECTION MODAL EXPORT PDF --}}
      <div class="modal fade" id="pdf" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Kelas Siswa</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('/admin/siswa/pdf') }}" method="post"> @csrf
              <div class="modal-body">
                <div class="input-group mb-3">
                  <label class="input-group-text" for="inputGroupSelect01">Angkatan : </label>
                  <select class="form-select" id="inputGroupSelect01" name="angkatan">
                    <option selected>Choose...</option>
                    @foreach ($dataKelas as $item)
                      <option value="{{ $item->id_kelas }}">{{ $item->angkatan_k }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="input-group mb-3">
                  <label class="input-group-text" for="inputGroupSelect01">Jurusan : </label>
                  <select class="form-select" id="inputGroupSelect01" name="jurusan">
                    <option selected>Choose...</option>
                    @foreach ($dataJurusan as $item)
                      <option value="{{ $item->id_jurusan }}">{{ $item->nama_j }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info"> Export </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      {{-- !SECTION MODAL EXPORT PDF --}}

    </div>

    <table id="datatable" class="table table-striped" style="width:100%">
      <thead>
        <tr>
          <th>#</th>
          <th>NIS</th>
          <th>Pass</th>
          <th>Nama</th>
          <th>JK</th>
          <th>Angkatan</th>
          <th>Jurusan</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @php($i = 1)
        {{-- @dd($data) --}}
        @foreach ($data as $item => $content)
          <tr @if (session()->get('add') == $content->created_at) style="animation: highlight_add 3s ease-in-out;" @endif
            @if (session()->get('edit') == $content->updated_at) style="animation: highlight_edit 3s ease-in-out;" @endif>
            <td>{{ $i++ }}</td>
            <td>{{ $content->nis_siswa }}</td>
            <td>{{ $content->pass_unhash }}</td>
            <td>{{ $content->nama_s }}</td>
            <td>{{ $content->jk_s }}</td>
            {{--  --}}
            <td>{{ $content->kelas->angkatan_k }}</td>
            <td>{{ $content->jurusan->nama_j }}</td>
            <td>
              <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                data-bs-target="#edit{{ $content->id_siswa }}">
                Edit
              </button>
              <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                data-bs-target="#del{{ $content->id_siswa }}">
                Delete
              </button>
            </td>
          </tr>

          {{-- SECTION MODAL EDIT --}}

          <div class="modal fade" id="edit{{ $content->id_siswa }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Siswa</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ $_SERVER['REQUEST_URI'] . '/' . $content->id_siswa }}" method="post"> @csrf
                  @method('PUT')
                  <div class="modal-body">
                    <div class="row">
                      <div class="col">
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1">NIS : </span>
                          <input type="text" class="form-control" name="nis"
                            value="{{ $content->nis_siswa }}">
                        </div>
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1">Nama : </span>
                          <input type="text" class="form-control" name="nama" value="{{ $content->nama_s }}">
                        </div>
                        <div class="input-group mb-3">
                          <label class="input-group-text" for="inputGroupSelect02">JK : </label>
                          <select class="form-select" id="inputGroupSelect02" name="jk">
                            <option {{ $content->jk_s == 'L' ? 'selected' : '' }} value="L">L</option>
                            <option {{ $content->jk_s == 'P' ? 'selected' : '' }} value="P">P</option>
                          </select>
                        </div>
                        <div class="input-group mb-3">
                          <label class="input-group-text" for="inputGroupSelect01">Angkatan : </label>
                          <select class="form-select" id="inputGroupSelect01" name="angkatan">
                            @foreach ($dataKelas as $kelas)
                              <option value="{{ $content->id_kelas }}"
                                {{ $content->id_kelas == $kelas->id_kelas ? 'selected' : '' }}>
                                {{ $kelas->angkatan_k }}
                              </option>
                            @endforeach
                          </select>
                        </div>
                        <div class="input-group mb-3">
                          <label class="input-group-text" for="inputGroupSelect01">Jurusan : </label>
                          <select class="form-select" id="inputGroupSelect01" name="jurusan">
                            @foreach ($dataJurusan as $jurusan)
                              <option value="{{ $content->id_jurusan }}"
                                {{ $content->id_jurusan == $jurusan->id_jurusan ? 'selected' : '' }}>
                                {{ $jurusan->nama_j }}
                              </option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col d-flex flex-column align-items-center">
                        <img src="{{ url("img/{$content->gambar_s}") }}" alt="Gambar Siswa" width="155"
                          class="rounded mb-3">
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Update</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          {{-- !SECTION MODAL EDIT --}}

          {{-- SECTION MODAL HAPUS --}}

          <div class="modal fade" id="del{{ $content->id_siswa }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Siswa</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ $_SERVER['REQUEST_URI'] . '/' . $content->id_siswa }}" method="post"> @csrf
                  @method('DELETE')
                  <div class="modal-body">
                    {{ $content->nama_s }} <br>
                    {{ $content->kelas->angkatan_k . $content->jurusan->nama_j }}
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          {{-- !SECTION MODAL EDIT --}}
        @endforeach
      </tbody>
    </table>

  </div>
@endsection

@section('admin-script')
  <script>
    toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": true,
      "progressBar": true,
      "positionClass": "toast-bottom-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
  </script>
  @if (Session::has('add'))
    <script>
      toastr.success("Berhasil Menambah Data", "Success")
    </script>
  @endif
  @if (Session::has('edit'))
    <script>
      toastr.success("Berhasil Mengedit Data", "Success")
    </script>
  @endif
  @if (Session::has('del'))
    <script>
      toastr.success("Berhasil Menghapus Data", "Success")
    </script>
  @endif
@endsection
