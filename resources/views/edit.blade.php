<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/css/ge.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>



<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/img/222.png') }}" width="60" height="60" alt="">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ url('/') }}">Home</a>
                        </li>
                    </ul>
                </div>
        </div>
    </nav>

    <div class="container d-flex justify-content-center align-items-center">
        <form method="POST" action="{{ route('update', $apoteks['id']) }}" class="pt-1 px-4">
            @csrf
            @method('PATCH')
            <div class="text-left mt-1">
                <b> <span class="info-text">please fill all the input with the right value</span></b>
            </div>
            <div class="position-relative mt-3  form-input">
                <label>Name</label>
                <input name="nama" class="form-control" value="{{ $apoteks['nama'] }}" type="text"
                    placeholder="Masukan Nama">
            </div>
            <div class="mb-3">
                <label for="examplename" class="form-label">Rujukan</label>
                <select name="rujukan" id="" class="form-control" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                    <option selected hidden></option>
                    <option value="1" {{ $apoteks['rujukan'] == '1' ? 'selected' : '' }}>Ya</option>
                    <option value="0" {{ $apoteks['rujukan'] == '0' ? 'selected' : '' }}>Tidak</option>
                </select>
                
            </div>
            <div class="position-relative mt-1  form-input">
                <label>Rumah Sakit</label>
                <input name="rumah_sakit" class="form-control" value="{{ $apoteks['rumah_sakit'] }}" type="text"
                    placeholder="Masukan Rumah Sakit">
            </div>
            <div class="form-row row">
                <div class="form-group col-md-6">
                    <label>Obat</label>
                    <input type="text" name="obat"
                        value="{{ implode(', ', $apoteks['obat']) }}"class="form-control" placeholder="">
                </div>
                <div class="form-group col-md-6">
                    <label>Harga Satuan</label>
                    <input type="text" name="harga_satuan" value="{{ implode(', ', $apoteks['harga_satuan']) }}"
                        class="form-control" placeholder="">
                </div>
            </div>
            <div class="position-relative mt-1  form-input ">
                <label>Apoteker</label>
                <input name="apoteker" class="form-control" value="{{ $apoteks['apoteker'] }}" type="text"
                    placeholder="Kak Fema">
            </div>
            <br>
            <button type="submit" class="btn btn-primary w-100">Create New</button>
        </form>
    </div>
</body>
@include('sweetalert::alert')

</html>
