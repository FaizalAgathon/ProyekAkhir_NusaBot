@extends('layouts.pPerusahaan.app')

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
              <button type="button" class="btn btn-info" data-bs-toggle="modal"
                data-bs-target="#paraf{{ $item->id_jurnal }}">
                Paraf
              </button>
            </td>
          </tr>

          {{-- SECTION MODAL PARAF --}}

          <div class="modal fade" id="paraf{{ $item->id_jurnal }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Paraf Jurnal</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url($_SERVER['REQUEST_URI']) . '/edit/' . $item->id_jurnal }}" method="post"> @csrf
                  @method('PUT')
                  <div class="modal-body">
                    <div class="w-100 p-2 rounded-4 border border-2 mb-3">
                      <h2 class="m-0">KEGIATAN YANG DILAKUKAN</h2>
                      <hr class="mt-1 mb-2">
                      <textarea class="default" disabled>{!! $item->kegiatan_jurnal !!}</textarea>
                    </div>
                    <div class="w-100 p-2 rounded-4 border border-2 mb-3">
                      <h2 class="m-0">KOMPETENSI YANG DIDAPATKAN</h2>
                      <hr class="mt-1 mb-2">
                      <textarea class="default" disabled>{{ $item->kompetensi_jurnal }}</textarea>
                    </div>
                    <div class="w-100 p-2 rounded-4 border border-2 mb-3">
                      <h2 class="m-0">GAMBAR KEGIATAN</h2>
                      <hr class="mt-1 mb-2">
                      <img src="{{ url('img/noImgProfile.png') }}" alt="..." class="mb-2" width="250"
                        id="img">
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

          {{-- !SECTION MODAL PARAF --}}
        @endforeach
      </tbody>
    </table>
  </div>
@endsection

@section('content-script')
  <script>
    tinymce.init({
      selector: 'textarea.default',
      skin: 'oxide-dark',
      height: 350,
      statusbar: false,
      promotion: false,
    });
  </script>
@endsection