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
  <div class="w-100 rounded-4 overflow-hidden" style="border: 2px solid #899BBD">
    <h1 class="text-center" style="background-color: #899BBD">Gambar Kegiatan</h1>
    @if (file_exists(public_path('/storage/' . $data->gambar_kegiatan_jurnal)))
      <img src="/storage/{{ $data->gambar_kegiatan_jurnal }}" alt="" class="rounded-3 w-25 m-2">
    @else
      <img src="{{ url('img/noImg.png') }}" alt="" class="rounded-3 w-25 m-2">
    @endif

  </div>
@endsection
