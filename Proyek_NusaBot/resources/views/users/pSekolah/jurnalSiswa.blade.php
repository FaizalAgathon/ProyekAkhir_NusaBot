@extends('layouts.pSekolah.app')

@section('content-pageTitle')
  <h1>{{ $data[0]->plotting->siswa->nis_siswa }} - {{ $data[0]->plotting->siswa->nama_s }}</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('pSekolah-index') }}">Dashboard</a></li>
      <li class="breadcrumb-item">Jurnal</li>
      <li class="breadcrumb-item active">{{ $data[0]->plotting->siswa->nis_siswa }}</li>
    </ol>
  </nav>
@endsection

@section('content-body')
  <div class="p-3 rounded overflow-auto" style="background-color: #899BBD;width:100%">
    <table id="datatable" class="table table-striped bg-light rounded " style="width:100%">
      <thead>
        <tr>
          <th>#</th>
          <th>Tanggal</th>
          <th>Kegiatan</th>
          <th>Kompetensi</th>
          <th>Gambar Kegiatan</th>
          <th>Paraf</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1; ?>
        @foreach ($data as $item)
          <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $item->tanggal_jurnal }}</td>
            <td class="kegiatan">
              <span class="kegiatan-text">{!! $item->kegiatan_jurnal !!}</span>
            </td>
            <td class="kompetensi">
              <span class="kompetensi-text">{!! $item->kompetensi_jurnal !!}</span>
            </td>
            <td>
              @if (file_exists(public_path('/storage/' . $item->gambar_kegiatan_jurnal)))
                <img src="/storage/{{ $item->gambar_kegiatan_jurnal }}" alt="" class="rounded w-100">
              @else
                <img src="{{ url('img/noImg.png') }}" alt="" class="rounded w-100">
              @endif
            </td>
            <td id="paraf">
              {!! $item->paraf_pp_jurnal == null ? $parafFalse : $parafTrue !!}
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
