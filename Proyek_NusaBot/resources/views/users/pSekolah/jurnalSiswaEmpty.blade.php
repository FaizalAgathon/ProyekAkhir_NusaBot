@extends('layouts.pSekolah.app')

@section('content-pageTitle')
  <h1>{{ $data[0]->siswa->nis_siswa }} - {{ $data[0]->siswa->nama_s }}</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('pSekolah-index') }}">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="{{ route('pSekolah-daftarJurnal') }}">Jurnal</a></li>
      <li class="breadcrumb-item active">{{ $data[0]->siswa->nis_siswa }}</li>
    </ol>
  </nav>
@endsection

@section('content-body')
  <div class="alert alert-warning text-center" role="alert">
    Belum ada data, <a href="{{ route('pSekolah-index') }}" class="alert-link">klik untuk kembali</a>.
  </div>
@endsection
