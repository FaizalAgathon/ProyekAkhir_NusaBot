@extends('layouts.admin.app')

@section('admin-body')
  <div class="pagetitle">
    <h1>Pembimbing Sekolah</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Pembimbing Sekolah</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add">
    + Add
  </button>

  {{-- SECTION MODAL TAMBAH --}}

  <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pembimbing Sekolah</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ url('/psekolah') }}" method="post"> @csrf
          <div class="modal-body">
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon1">NIP : </span>
              <input type="text" class="form-control" name="nip">
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
            <button type="submit" class="btn btn-success"> + Add </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  {{-- !SECTION MODAL TAMBAH --}}

  <table id="datatable" class="table table-striped" style="width:100%">
    <thead>
      <tr>
        <th>#</th>
        <th>NIP</th>
        <th>Nama</th>
        <th>JK</th>
        <th>Jurusan</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1; ?>
      @foreach ($dataPS as $item)
        <tr>
          <td>{{ $i++ }}</td>
          <td>{{ $item->nip_ps }}</td>
          <td>{{ $item->nama_ps }}</td>
          <td>{{ $item->jk_ps }}</td>
          <td>{{ $item->nama_j }}</td>
          <td>
            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
              data-bs-target="#edit{{ $item->nip_ps }}">
              Edit
            </button>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
              data-bs-target="#del{{ $item->nip_ps }}">
              Delete
            </button>
          </td>
        </tr>

        {{-- SECTION MODAL EDIT --}}

        <div class="modal fade" id="edit{{ $item->nip_ps }}" tabindex="-1" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Pembimbing Sekolah</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="/psekolah/{{ $item->nip_ps }}" method="post"> @csrf @method('PUT')
                <div class="modal-body">
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">NIP : </span>
                    <input type="text" class="form-control" name="nip" value="{{ $item->nip_ps }}">
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Nama : </span>
                    <input type="text" class="form-control" name="nama" value="{{ $item->nama_ps }}">
                  </div>
                  <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect02">JK : </label>
                    <select class="form-select" id="inputGroupSelect02" name="jk">
                      <option {{ $item->jk_ps == 'L' ? 'selected' : '' }} value="L">L</option>
                      <option {{ $item->jk_ps == 'P' ? 'selected' : '' }} value="P">P</option>
                    </select>
                  </div>
                  <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Jurusan : </label>
                    <select class="form-select" id="inputGroupSelect01" name="jurusan">
                      <option selected>Choose...</option>
                      @foreach ($dataJurusan as $item)
                        <option value="{{ $item->id_j }}">{{ $item->nama_j }}</option>
                      @endforeach
                    </select>
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

        <div class="modal fade" id="del{{ $item->nip_ps }}" tabindex="-1" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Pembimbing Sekolah</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="/psekolah/{{ $item->nip_ps }}" method="post"> @csrf @method('DELETE')
                <div class="modal-body">
                  {{ $item->nama_p }} <br>
                  {{ $item->alamat_p }}
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
@endsection

@section('admin-notification')
  {{-- toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-bottom-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "600",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
  } --}}
  @if (Session::has('add'))
    toastr.success("Successfully Added Data")
  @endif
  @if (Session::has('edit'))
    toastr.success("Successfully Edited Data")
  @endif
  @if (Session::has('del'))
    toastr.success("Successfully Deleted Data")
  @endif
@endsection
