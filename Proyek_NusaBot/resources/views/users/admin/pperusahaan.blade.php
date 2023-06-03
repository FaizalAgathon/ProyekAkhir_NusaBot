@extends('layouts.admin.app')

@section('content-body')
  <div class="pagetitle">
    <h1>Pembimbing Perusahaan</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Pembimbing Perusahaan</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="card-list p-4">
    <div class="button-group mb-3">
      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add">
        + Add
      </button>
    
      <a href="{{ url('/admin/pperusahaan/pdf') }}" target="_blank">
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
            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pembimbing Perusahaan</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="{{ route('admin-storePPerusahaan') }}" method="post"> @csrf
            <div class="modal-body">
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Email : </span>
                <input type="text" class="form-control" name="email" required>
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Nama : </span>
                <input type="text" class="form-control" name="nama" required>
              </div>
              <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect02">JK : </label>
                <select class="form-select" id="inputGroupSelect02" name="jk" required>
                  <option selected value="L">L</option>
                  <option value="P">P</option>
                </select>
              </div>
              <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01">Perusahaan : </label>
                <select class="form-select" id="inputGroupSelect01" name="perusahaan" required>
                  <option selected>Choose...</option>
                  @foreach ($dataPerusahaan as $item)
                    <option value="{{ $item->id_perusahaan }}">{{ $item->nama_p }}</option>
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
          <th>Email</th>
          <th>Pass</th>
          <th>Nama</th>
          <th>JK</th>
          <th>Perusahaan</th>
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
            <td>{{ $content->email_pp }}</td>
            <td>{{ $content->pass_unhash }}</td>
            <td>{{ $content->nama_pp }}</td>
            <td>{{ $content->jk_pp }}</td>
            {{--  --}}
            <td>{{ $content->perusahaan->nama_p }}</td>
            <td>
              <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                data-bs-target="#edit{{ $content->id_pp }}">
                Edit
              </button>
              <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                data-bs-target="#del{{ $content->id_pp }}">
                Delete
              </button>
            </td>
          </tr>
  
          {{-- SECTION MODAL EDIT --}}
          <div class="modal fade" id="edit{{ $content->id_pp }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Pembimbing Perusahaan</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ $_SERVER['REQUEST_URI'] . '/' . $content->id_pp }}" method="post"> @csrf @method('PUT')
                  <div class="modal-body">
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon1">Email : </span>
                      <input type="text" class="form-control" name="email" value="{{ $content->email_pp }}" required>
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon1">Nama : </span>
                      <input type="text" class="form-control" name="nama" value="{{ $content->nama_pp }}" required>
                    </div>
                    <div class="input-group mb-3">
                      <label class="input-group-text" for="inputGroupSelect02">JK : </label>
                      <select class="form-select" id="inputGroupSelect02" name="jk" required>
                        <option {{ $content->jk_pp == 'L' ? 'selected' : '' }} value="L">L</option>
                        <option {{ $content->jk_pp == 'P' ? 'selected' : '' }} value="P">P</option>
                      </select>
                    </div>
                    <div class="input-group mb-3">
                      <label class="input-group-text" for="inputGroupSelect01">Perusahaan : </label>
                      <select class="form-select" id="inputGroupSelect01" name="perusahaan" required>
                        @foreach ($dataPerusahaan as $perusahaan)
                          <option value="{{ $content->id_perusahaan }}" {{ $content->id_perusahaan == $perusahaan->id_perusahaan ? 'selected' : '' }}>
                            {{ $perusahaan->nama_p }}
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
          <div class="modal fade" id="del{{ $content->id_pp }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Pembimbing Perusahaan</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ $_SERVER['REQUEST_URI'] . '/' . $content->id_pp }}" method="post"> @csrf @method('DELETE')
                  <div class="modal-body">
                    {{ $content->email_pp }} <br>
                    {{ $content->nama_pp }} <br>
                    {{ $content->perusahaan->nama_p }}
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
