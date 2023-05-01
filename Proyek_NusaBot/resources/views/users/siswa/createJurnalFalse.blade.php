@extends('layouts.siswa.app')

@section('content-pageTitle')
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('siswa-index') }}">Dashboard</a></li>
      <li class="breadcrumb-item active">Tambah Jurnal</li>
    </ol>
  </nav>
@endsection

@section('content-body')
  <div class="alert alert-success text-center" role="alert">
    <h4>
      Anda sudah mengisi jurnal hari ini.
      <a href="{{ route('siswa-index') }}" class="alert-link">Klik di sini untuk kembali</a>
    </h4>
  </div>
@endsection
