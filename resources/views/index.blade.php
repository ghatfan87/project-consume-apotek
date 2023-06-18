<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Consume REST API Students</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">
          <img src="{{asset('assets/img/222.png')}}" width="50" height="50" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto"> 
            <li class="nav-item active">
              <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/trash">Data Trash</a>
            </li>
            <form action="" class="d-flex" role="search" method="GET" style="margin-left:700px">
                @csrf
                <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-success" type="submit">Search</button>
            </form>
            
          </ul>
        </div>
      </nav>
      
    <div class="container">
        <div class="row">
            <div class="my-4 col-12">
                <h1 class="float-left">Daftar Pasien</h1>
                <a class="btn btn-primary mt-2" style="display: flex; float:right; " href="/add" role="button">Tambah Data</a>
            </div>            
            @if (Session::get('success'))
                <div style="width: 100%; background: green; color:white; padding: 10px;">
                    {{ Session::get('success') }}
                </div>
            @endif

            <table class="table table-striped table-hover">
                <tr class="text-center">
                    <th>No</th>
                    <th>Nama</th>
                   <th>Rujukan</th>
                    <th>Rumah Sakit</th>
                    <th>Obat</th>
                    <th>Harga Satuan</th>
                    <th>Total Harga</th>
                    <th>Apoteker</th>
                    <th>Action</th>
                </tr>

                @php
                    $no = 1;
                @endphp

                @foreach ($apoteks as $apotek)
                    <tr class="text-center">
                        <td>{{ $no++ }}</td>
                        <td>{{ $apotek['nama'] }}</td>
                        <td> 
                            @if ($apotek['rujukan']== 1)
                                Ya Diterima
                            @else
                                Tidak Diterima
                            @endif
                        </td>
                        <td>
                            @if ($apotek['rujukan']== 1)
                                {{$apotek['rumah_sakit']}}
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ implode(', ', $apotek['obat']) }}</td>
                        <td>{{ implode(', ', $apotek['harga_satuan']) }}</td>
                        <td>{{ $apotek['total_harga'] }}</td>
                        <td>{{ $apotek['apoteker'] }}</td>
                        <td style="display: flex" class="text-center">
                            <a href="{{ route('edit', $apotek['id']) }}" class="btn btn-primary btn-sm"
                                style="float: left; margin-right:5px;">Edit</a>
                            <form action="{{ route('delete', $apotek['id']) }}" method="POST" style="float: left;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                </tr>
            </table>
</body>
@include('sweetalert::alert')

</html>
