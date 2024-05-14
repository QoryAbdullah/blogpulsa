@extends('adminlte.layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Daftar Pulsa</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Daftar Pulsa</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container mt-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('storePulsa') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nama_provider">Nama Provider</label>
                            <select name="id_provider" id="id_provider" class="form-control" required="required">
                                @foreach ($providers as $provider)
                                <option value="{{ $provider->id }}">{{ $provider->nama_provider }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Gambar</label>
                            <input type="file" class="form-control @error ('gambar') is-invalid @enderror" name="gambar">

                            <!-- Error message for title -->
                            @error('gambar')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Jenis Pulsa</label>
                            <input type="text" class="form-control @error ('jenis_pulsa') is-invalid @enderror" value="{{ old('jenis_pulsa') }}" name="jenis_pulsa">

                            <!-- Error message for title -->
                            @error('jenis_pulsa')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Harga</label>
                            <input type="text" class="form-control @error ('harga') is-invalid @enderror" value="{{ old('nama_provider') }}" name="harga">{{ old('nama_provider') }}

                            <!-- Error message for title -->
                            @error('harga')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-md btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-md btn-warning">Reset</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'nama_provider' );
</script>
@endsection