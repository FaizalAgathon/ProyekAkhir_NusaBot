@extends('layouts.admin.app')

@section('content-body')
  <div class="pagetitle">
    <h1>Angkatan</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Angkatan</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="card-list p-4">
    <div class="button-group mb-3">
      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add">
        + Add
      </button>
    
      {{-- SECTION MODAL TAMBAH --}}
      <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Angkatan</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin-storeAngkatan') }}" method="post"> @csrf
              <div class="modal-body">
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1">Angkatan : </span>
                  <input type="text" class="form-control" placeholder="Angkatan" aria-label="Username"
                    aria-describedby="basic-addon1" name="angkatan" required>
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
    </div>

    <table id="datatable" class="table table-striped" style="width:100%">
      <thead>
        <tr>
          <th>#</th>
          <th>Angkatan</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1; ?>
        @foreach ($data as $item)
          <tr @if (session()->get('add') == $item->created_at) style="animation: highlight_add 3s ease-in-out;" @endif
            @if (session()->get('edit') == $item->updated_at) style="animation: highlight_edit 3s ease-in-out;" @endif>
            <td>{{ $i++ }}</td>
            <td>{{ $item->angkatan_k }}</td>
            <td>
              <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                data-bs-target="#edit{{ $item->id_kelas }}">
                Edit
              </button>
              <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#del{{ $item->id_kelas }}">
                Delete
              </button>
            </td>
          </tr>
  
          {{-- SECTION MODAL EDIT --}}
  
          <div class="modal fade" id="edit{{ $item->id_kelas }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Angkatan</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ $_SERVER['REQUEST_URI'] . '/' . $item->id_kelas }}" method="post"> @csrf @method('PUT')
                  <div class="modal-body">
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon1">Angkatan : </span>
                      <input type="text" class="form-control" placeholder="Angkatan" name="angkatan"
                        value="{{ $item->angkatan_k }}" required>
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
  
          <div class="modal fade" id="del{{ $item->id_kelas }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Angkatan</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ $_SERVER['REQUEST_URI'] . '/' . $item->id_kelas }}" method="post"> @csrf @method('DELETE')
                  <div class="modal-body">
                    {{ $item->angkatan_k }}
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
