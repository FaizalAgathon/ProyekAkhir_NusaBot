<!DOCTYPE html>
<html>

<head>
  <style>
    h1 {
      margin-top: 300px;
    }

    h1,
    #customers {
      font-family: Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    #customers td,
    #customers th {
      border: 1px solid #00ae6e;
      padding: 6px;
    }

    #customers tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    #customers th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      background-color: #00ae6e;
      color: white;
    }

    .footer {
      border: 1px solid;
      position: absolute;
      right: 0;
      bottom: 0;
    }

    .border {
      position: absolute;
      left: 0;
      right: 0;
      bottom: 33px;
    }
  </style>
</head>

<body>

  <h1 style="text-align: center">TABEL AKUN PEMBIMBING SEKOLAH</h1>

  <div style="page-break-after: always;"></div>

  <table id="customers">
    <tr>
      <th>NIP</th>
      <th>NAMA</th>
      <th>PASS</th>
    </tr>
    @php($i = 1)
    @php($page = 1)
    {{-- <span class="footer">{{ $page }}</span> --}}
    @foreach ($user as $item)
      <tr>
        <td>{{ $item->nip_ps }}</td>
        <td>{{ $item->nama_ps }}</td>
        <td>{{ $item->pass_unhash }}</td>
      </tr>
      @if ($i % 29 == 0)
        {{-- <span class="footer">{{ $page++ }}</span> --}}
        <tr>
          <th>NIP</th>
          <th>NAMA</th>
          <th>PASS</th>
        </tr>
        {{-- <hr class="border"> --}}
      @endif
      @php($i++)
    @endforeach
    {{-- <span class="footer">{{ $page }}</span> --}}
  </table>

</body>

</html>
