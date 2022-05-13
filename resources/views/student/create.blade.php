@extends('layouts.app')

@push('plugin-css')
    <link rel="stylesheet" href="{{ asset('vendors/modules/dropify/dropify.min.css') }}">
@endpush

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tambah Mahasiswa</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></div>
            <div class="breadcrumb-item"><a href="{{ route('student.index') }}">Mahasiswa</a></div>
            <div class="breadcrumb-item">Tambah</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title text-right">Form Tambah Mahasiswa</h4>
                <a href="{{ route('student.index') }}" class="btn btn-primary">Kembali</a>
            </div>
            <form action="{{ route('student.store') }}" enctype="multipart/form-data" method="POST" autocomplete="off"> @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan nama lengkap" value="{{ old('name') }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>NIM</label>
                        <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror numeric" placeholder="Masukkan nim" value="{{ old('nim') }}" maxlength="7">
                        @error('nim')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Umur</label>
                        <input type="number" name="age" class="form-control @error('age') is-invalid @enderror" placeholder="Masukkan umur" value="{{ old('age') }}">
                        @error('age')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Jurusan</label>
                        <select id="major" name="major" class="form-control @error('major') is-invalid @enderror">
                            <option selected disabled>--Pilih Jurusan--</option>
                            @php
                                $major = ['Teknik Informatika', 'Sistem Informasi', 'Akutansi', 'Manajemen'];
                            @endphp
                            @foreach ($major as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                        @error('major')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Masukkan alamat" value="{{ old('address') }}">
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" id="input-file-now" name="image" class="dropify">
                    </div>
                    <button class="btn btn-block btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@push('plugin-js')
<script src="{{ asset('vendors/modules/dropify/dropify.min.js') }}"></script>
@endpush

@push('custom-js')
<script>
    $('.numeric').on('input', function (event) { 
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $('.dropify').dropify({
        messages: {
            'default': '',
            'replace': 'Drag and drop or click to replace',
            'remove':  'Remove',
            'error':   'Ooops, something wrong happended.',
        }
    });
</script>
@endpush