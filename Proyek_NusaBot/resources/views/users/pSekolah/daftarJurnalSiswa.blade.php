@extends('layouts.pSekolah.app')

@section('content-pageTitle')
  <h1>Daftar Jurnal Siswa</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('pSekolah-index') }}">Dashboard</a></li>
      <li class="breadcrumb-item active">Jurnal</li>
    </ol>
  </nav>
@endsection

@section('content-body')
  <div class="card-list p-4">
    <table id="datatable" class="table table-striped bg-light rounded " style="width:100%">
      <thead>
        <tr>
          <th>#</th>
          <th>NIS</th>
          <th>Nama</th>
          <th>Perusahaan</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1; ?>
        @foreach ($listSiswa as $item)
          <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $item->siswa->nis_siswa }}</td>
            <td>{{ $item->siswa->nama_s }}</td>
            <td>{{ $item->perusahaan->nama_p }}</td>
            <td>
              <a href="{{ $_SERVER['REQUEST_URI'] . '/' . $item->id_plotting }}">
                <button class="btn btn-info">
                  Detail
                </button>
              </a>
            </td>
          </tr>
  
          {{-- SECTION MODAL EDIT --}}
  
          <div class="modal fade" id="edit{{ $item->id_jurnal }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Angkatan</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/admin/angkatan/{{ $item->id_jurnal }}" method="post"> @csrf @method('PUT')
                  <div class="modal-body">
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon1">Angkatan : </span>
                      <input type="text" class="form-control" placeholder="Angkatan" name="angkatan"
                        value="{{ $item->angkatan_k }}">
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
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
