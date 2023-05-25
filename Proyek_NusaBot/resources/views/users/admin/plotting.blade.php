@extends('layouts.admin.app')

@section('content-body')
  <div class="pagetitle">
    <h1>Penempatan</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Penempatan</li>
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
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Penempatan</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin-storePlotting') }}" method="post"> @csrf
              <div class="modal-body">
                <div class="input-group mb-3">
                  <label class="input-group-text" for="inputGroupSelect01">Angkatan : </label>
                  <select class="form-select" id="angkatan" name="angkatan" required>
                    <option selected>Choose...</option>
                    @foreach ($dataKelas as $item)
                      <option value="{{ $item->id_kelas }}">{{ $item->angkatan_k }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="input-group mb-3">
                  <label class="input-group-text" for="inputGroupSelect01">Jurusan : </label>
                  <select class="form-select" id="jurusan" name="jurusan" required>
                    <option selected>Choose...</option>
                    @foreach ($dataJurusan as $item)
                      <option value="{{ $item->id_jurusan }}">{{ $item->nama_j }}</option>
                    @endforeach
                  </select>
                </div>
                <button type="button" id="btnCariNIS" class="btn btn-primary">Cari</button>
                <div class="input-group mb-3">
                  <label class="input-group-text" for="inputGroupSelect01">Siswa : </label>
                  <select class="form-select" id="siswa" name="siswa" required>
                    <option selected>Choose...</option>
                    @foreach ($dataSiswa as $item)
                      <option value="{{ $item->id_siswa }}">
                        {{ $item->kelas->angkatan_k . $item->jurusan->nama_j }} - {{ $item->nis_siswa }} -
                        {{ $item->nama_s }}
                      </option>
                    @endforeach
                  </select>
                </div>
                <div class="input-group mb-3">
                  <label class="input-group-text" for="inputGroupSelect01">Pembimbing Sekolah : </label>
                  <select class="form-select" id="pSekolah" name="pSekolah" required>
                    <option selected>Choose...</option>
                    @foreach ($dataPS as $item)
                      <option value="{{ $item->id_ps }}">{{ $item->jurusan->nama_j }} - {{ $item->nama_ps }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="input-group mb-3">
                  <label class="input-group-text" for="inputGroupSelect01">Perusahaan : </label>
                  <select class="form-select" id="pSekolah" name="perusahaan" required>
                    <option selected>Choose...</option>
                    @foreach ($dataPerusahaan as $item)
                      <option value="{{ $item->id_perusahaan }}">{{ $item->nama_p }}</option>
                    @endforeach
                  </select>
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
          <th>NIS</th>
          <th>Nama Siswa</th>
          <th>NIP</th>
          <th>Nama P.Sekolah</th>
          <th>Perusahaan</th>
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
            <td>{{ $content->siswa->nis_siswa }}</td>
            <td>{{ $content->siswa->nama_s }}</td>
            <td>{{ $content->pembimbing_sekolah->nip_ps }}</td>
            <td>{{ $content->pembimbing_sekolah->nama_ps }}</td>
            <td>{{ $content->perusahaan->nama_p }}</td>
            <td>
              <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                data-bs-target="#edit{{ $content->id_plotting }}">
                Edit
              </button>
              <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                data-bs-target="#del{{ $content->id_plotting }}">
                Delete
              </button>
            </td>
          </tr>

          {{-- SECTION MODAL EDIT --}}
          <div class="modal fade" id="edit{{ $content->id_plotting }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Penempatan</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/admin/plotting/{{ $content->id_plotting }}" method="post"> @csrf @method('PUT')
                  <div class="modal-body">
                    <div class="row">
                      <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect02">Siswa : </label>
                        <select class="form-select" id="inputGroupSelect02" name="siswa" required>
                          @foreach ($dataSiswa as $item)
                            <option {{ $item->id_siswa == $content->id_siswa ? 'selected' : '' }}
                              value="{{ $content->id_siswa }}">
                              {{ $item->nis_siswa }} -
                              {{ $item->kelas->angkatan_k . $item->jurusan->nama_j }} -
                              {{ $item->nama_s }}
                            </option>
                          @endforeach
                        </select>
                      </div>
                      <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect02">Pembimbing Sekolah : </label>
                        <select class="form-select" id="inputGroupSelect02" name="pSekolah" required>
                          @foreach ($dataPS as $item)
                            <option {{ $item->id_ps == $content->id_ps ? 'selected' : '' }}
                              value="{{ $content->id_ps }}">
                              {{ $item->jurusan->nama_j }} {{ $item->nama_ps }}
                            </option>
                          @endforeach
                        </select>
                      </div>
                      <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect01">Perusahaan : </label>
                        <select class="form-select" id="inputGroupSelect01" name="perusahaan" required>
                          @foreach ($dataPerusahaan as $item)
                            <option value="{{ $item->id_perusahaan }}"
                              {{ $content->id_perusahaan == $item->id_perusahaan ? 'selected' : '' }}>
                              {{ $item->nama_p }}
                            </option>
                          @endforeach
                        </select>
                      </div>
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
          <div class="modal fade" id="del{{ $content->id_plotting }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Siswa</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/admin/plotting/{{ $content->id_plotting }}" method="post"> @csrf @method('DELETE')
                  <div class="modal-body">
                    {{ $content->nama_s }} <br>
                    {{ $content->siswa->kelas->angkatan_k . $content->siswa->jurusan->nama_j }}
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

@section('admin-script')
  <script>
    // let angkatan = '#angkatan';
    // let jurusan = '#jurusan';
    //   $('#btnCariNIS').on('click', function() {
    //     $.ajax({
    //       type: 'POST',
    //       url: "{{ $_SERVER['REQUEST_URI'] }}/getsiswa",
    //       data: {
    //         _token : $('meta[name="csrf-token"]').attr('content'),
    //         angkatan : $(angkatan).val(),
    //         jurusan : $(jurusan).val()
    //       },
    //       success: function(data) {
    //         console.log(data)
    //         // $("#siswa").html(data.siswa)
    //       },
    //     });
    //   })
  </script>
@endsection
