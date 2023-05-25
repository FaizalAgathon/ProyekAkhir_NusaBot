@extends('layouts.admin.app')

@section('content-body')
  <div class="pagetitle">
    <h1>Pembimbing Sekolah</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Pembimbing Sekolah</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="card-list p-4">
    <div class="button-group mb-3">
      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add">
        + Add
      </button>
      <a href="{{ route('admin-psekolah-pdf') }}" target="_blank">
        <button type="button" class="btn btn-info">
          Export PDF
        </button>
      </a>
    </div>

    {{-- SECTION MODAL TAMBAH --}}
    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pembimbing Sekolah</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="{{ route('admin-storePSekolah') }}" method="post"> @csrf
            <div class="modal-body">
              <div class="input-group mb-3 has-validation">
                <span class="input-group-text" id="basic-addon1">NIP : </span>
                <input type="text" class="form-control" name="nip" required>
                <div class="invalid-feedback">
                  Please choose a username.
                </div>
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
          <th>Pass</th>
          <th>Nama</th>
          <th>JK</th>
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
            <td>{{ $content->nip_ps }}</td>
            <td>{{ $content->pass_unhash }}</td>
            <td>{{ $content->nama_ps }}</td>
            <td>{{ $content->jk_ps }}</td>
            {{--  --}}
            <td>{{ $content->jurusan->nama_j }}</td>
            <td>
              <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                data-bs-target="#edit{{ $content->id_ps }}">
                Edit
              </button>
              <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                data-bs-target="#del{{ $content->id_ps }}">
                Delete
              </button>
            </td>
          </tr>
  
          {{-- SECTION MODAL EDIT --}}
  
          <div class="modal fade" id="edit{{ $content->id_ps }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Pembimbing Sekolah</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ $_SERVER['REQUEST_URI'] . '/' . $content->id_ps }}" method="post"> @csrf @method('PUT')
                  <div class="modal-body">
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon1">NIP : </span>
                      <input type="text" class="form-control" name="nip" value="{{ $content->nip_ps }}" required>
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon1">Nama : </span>
                      <input type="text" class="form-control" name="nama" value="{{ $content->nama_ps }}" required>
                    </div>
                    <div class="input-group mb-3">
                      <label class="input-group-text" for="inputGroupSelect02">JK : </label>
                      <select class="form-select" id="inputGroupSelect02" name="jk" required>
                        <option {{ $content->jk_ps == 'L' ? 'selected' : '' }} value="L">L</option>
                        <option {{ $content->jk_ps == 'P' ? 'selected' : '' }} value="P">P</option>
                      </select>
                    </div>
                    <div class="input-group mb-3">
                      <label class="input-group-text" for="inputGroupSelect01">Jurusan : </label>
                      <select class="form-select" id="inputGroupSelect01" name="jurusan" required>
                        @foreach ($dataJurusan as $jurusan)
                          <option value="{{ $content->id_jurusan }}"
                            {{ $content->id_jurusan == $jurusan->id_jurusan ? 'selected' : '' }}>
                            {{ $jurusan->nama_j }}
                          </option>
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
  
          <div class="modal fade" id="del{{ $content->id_ps }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Pembimbing Sekolah</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ $_SERVER['REQUEST_URI'] . '/' . $content->id_ps }}" method="post"> @csrf @method('DELETE')
                  <div class="modal-body">
                    {{ $content->nama_p }} <br>
                    {{ $content->alamat_p }}
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

@endsection
