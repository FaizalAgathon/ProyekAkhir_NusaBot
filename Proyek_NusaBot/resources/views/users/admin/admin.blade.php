@extends('layouts.admin.app')

@section('content-body')
  <div class="pagetitle">
    <h1>Admin</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Admin</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="card-list p-4">
    <div class="button-group mb-3">
      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add">
        + Add
      </button>
    </div>

    {{-- SECTION MODAL TAMBAH --}}
    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Admin</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="{{ route('admin-storeAdmin') }}" method="post"> @csrf
            <div class="modal-body">
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Email : </span>
                <input type="email" class="form-control" name="email" required>
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
            <td>{{ $content->email_a }}</td>
            <td>{{ $content->pass_unhash }}</td>
            <td>
              @if (Auth::guard('admin')->user()->id_a != $content->id_a)
                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                  data-bs-target="#edit{{ $content->id_a }}">
                  Edit
                </button>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                  data-bs-target="#del{{ $content->id_a }}">
                  Delete
                </button>
              @else
              <span class="badge text-bg-success">Active</span>
              @endif
            </td>
          </tr>
  
          {{-- SECTION MODAL EDIT --}}
          <div class="modal fade" id="edit{{ $content->id_a }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Admin</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ $_SERVER['REQUEST_URI'] . '/' . $content->id_a }}" method="post"> @csrf @method('PUT')
                  <div class="modal-body">
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon1">Email : </span>
                      <input type="email" class="form-control" name="email" value="{{ $content->email_a }}" required>
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
          <div class="modal fade" id="del{{ $content->id_a }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Admin</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ $_SERVER['REQUEST_URI'] . '/' . $content->id_a }}" method="post"> @csrf @method('DELETE')
                  <div class="modal-body">
                    {{ $content->email_a }}
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