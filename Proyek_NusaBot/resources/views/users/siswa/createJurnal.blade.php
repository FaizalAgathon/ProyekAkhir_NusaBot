@extends('layouts.siswa.app')

@section('content-body')
  <div class="pagetitle">
    <h1>{{ Auth::guard('siswa')->user()->nama_s }}</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('siswa-index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Tambah Jurnal</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <form action="{{ route('siswa-storeJurnal') }}" method="post" enctype="multipart/form-data"> @csrf
    <div class="w-100 p-2 rounded-4 border border-2 mb-3">
      <h2 class="m-0">KEGIATAN YANG DILAKUKAN</h2>
      <hr class="mt-1 mb-2">
      <textarea name="kegiatan" class="default"></textarea>
    </div>
    <div class="w-100 p-2 rounded-4 border border-2 mb-3">
      <h2 class="m-0">KOMPETENSI YANG DIDAPATKAN</h2>
      <hr class="mt-1 mb-2">
      <textarea name="kompetensi" class="default"></textarea>
    </div>
    <div class="w-100 p-2 rounded-4 border border-2 mb-3">
      <h2 class="m-0">GAMBAR KEGIATAN</h2>
      <hr class="mt-1 mb-2">
      <img src="{{ url('img/noImgProfile.png') }}" alt="..." class="mb-2" width="250" id="img">
      <input type="file" name="gambar" class="form-control" id="input">
    </div>
    <button type="submit" class="btn btn-success w-100">Kirim</button>
  </form>
@endsection

@section('content-script')
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.4.1/tinymce.min.js"
    integrity="sha512-in/06qQzsmVw+4UashY2Ta0TE3diKAm8D4aquSWAwVwsmm1wLJZnDRiM6e2lWhX+cSqJXWuodoqUq91LlTo1EA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

  <script>
    tinymce.init({
      selector: 'textarea.default',
      skin: 'oxide-dark',
      height: 350,
      statusbar: false,
      promotion: false,
    });

    let img = document.getElementById('img')
    let imgSrc = document.getElementById('img').src
    let input = document.getElementById('input')
    input.onchange = (e) => {
      if (input.files[0]) img.src = URL.createObjectURL(input.files[0])
      else if (!input.files[0]) img.src = imgSrc
    }
  </script>
@endsection
