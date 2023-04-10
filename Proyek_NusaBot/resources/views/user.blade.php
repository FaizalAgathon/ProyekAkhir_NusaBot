<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>User</title>
  <link href="{{ url('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
  
  <div class="container mt-5">
    <form action="/login" method="get" class="d-flex gap-5">
      
      <button type="submit" name="user" value="siswa" class="w-100 h-10">Siswa</button>
      <button type="submit" name="user" value="admin" class="w-100">Admin</button>
      <button type="submit" name="user" value="pSekolah" class="w-100">Pembimbing Sekolah</button>
      <button type="submit" name="user" value="pPerusahaan" class="w-100">Pembimbing Perusahaan</button>
    
    </form>
  </div>

</body>
</html>