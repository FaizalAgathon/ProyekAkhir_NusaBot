@extends('layouts.siswa.app')

@section('content-pageTitle')
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('siswa-index') }}">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="{{ route('siswa-readJurnal') }}">Jurnal</a></li>
      <li class="breadcrumb-item active">{{ $data->tanggal_jurnal }}</li>
    </ol>
  </nav>
@endsection

@section('content-body')
  <div class="w-50 rounded-4 overflow-auto mx-auto mb-4" style="border: 2px solid #899BBD; min-height: 300px;">
    <h1 class="text-center" style="background-color: #899BBD">Gambar Kegiatan</h1>
    @if (file_exists(public_path('/storage/' . $data->gambar_kegiatan_jurnal)))
      <img src="/storage/{{ $data->gambar_kegiatan_jurnal }}" alt="" class="rounded-3 w-50 m-2 mx-auto d-block">
    @else
      <img src="{{ url('img/noImg.png') }}" alt="" class="rounded-3 w-50 m-2 mx-auto d-block">
    @endif
    <footer class="text-center fst-italic fs-5 text-secondary">{{ $data->tanggal_jurnal }}</footer>
  </div>
  <div class="row gap-4">
    <div class="col p-0 rounded-4 overflow-hidden" style="border: 2px solid #899BBD; min-height: 300px;">
      <h1 class="text-center" style="background-color: #899BBD">Kegiatan</h1>

      <div class="kegiatan-content m-3">
        {!! $data->kegiatan_jurnal !!}
      </div>

    </div>
    <div class="col p-0 rounded-4 overflow-hidden" style="border: 2px solid #899BBD; min-height: 300px;">
      <h1 class="text-center" style="background-color: #899BBD">Kompetensi</h1>

      <div class="kompetensi-content m-3">
        {!! $data->kompetensi_jurnal !!}
      </div>

    </div>
  </div>
@endsection
