<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('assets/img/222.png') }}" width="50" height="50" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="my-4 col-12">
                <h1 class="float-left">Daftar Sampah</h1>
                <a class="btn btn-primary mt-2" style="display: flex; float:right; " href="/add" role="button">Tambah Data</a>
            </div>            
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

                @foreach ($ApoteksTrash as $show)
                    <tr class="text-center">
                        <td>{{ $no++ }}</td>
                        <td>{{ $show['nama'] }}</td>
                        <td> {{ $show['rujukan'] }}</td>
                        <td>{{ $show['rumah_sakit'] }}</td>
                        <td>
                            @foreach ($show['obat'] as $obat)
                                {{ $obat }}
                            @endforeach
                        </td>
                        <td>
                            @foreach ($show['harga_satuan'] as $harga)
                                {{ $harga }}
                            @endforeach
                        </td>
                        <td>{{ $show['total_harga'] }}</td>
                        <td>{{ $show['apoteker'] }}</td>
                        <td style="display: flex" class="text-center">
                            <a href="{{ route('restore', $show['id']) }}" class="btn btn-primary btn-sm"
                                style="float: left; margin-right:5px;">Restore</a>

                                <a href="{{route('permanent',$show['id'])}}" class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                @endforeach
                    
                </tr>
            </table>
        </div>
    </div>
    
</body>

</html>
