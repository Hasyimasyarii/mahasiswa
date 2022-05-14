@extends('layouts.app')

@push('plugin-css')
    <link rel="stylesheet" href="{{ asset('vendors/modules/dropify/dropify.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
@endpush

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Mahasiswa</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></div>
            <div class="breadcrumb-item"><a href="{{ route('student.index') }}">Mahasiswa</a></div>
            <div class="breadcrumb-item">Edit</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title text-right">Form Edit Mahasiswa</h4>
                <a href="{{ route('student.index') }}" class="btn btn-primary">Kembali</a>
            </div>
            <form action="{{ route('student.update', $student->id) }}" enctype="multipart/form-data" method="POST" autocomplete="off"> @csrf @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan nama lengkap" value="{{ old('name', $student->name) }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>NIM</label>
                        <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror numeric" placeholder="Masukkan nim" value="{{ old('nim', $student->nim) }}" maxlength="7">
                        @error('nim')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Umur</label>
                        <input type="number" name="age" class="form-control @error('age') is-invalid @enderror" placeholder="Masukkan umur" value="{{ old('age', $student->age) }}">
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
                                @if ($item == $student->major)
                                    <option value="{{ $item }}" selected>{{ $item }}</option>
                                @else
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endif
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
                        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Masukkan alamat" value="{{ old('address', $student->address) }}">
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" id="input-file-now" name="image" class="dropify" data-max-file-size="3M" data-allowed-file-extensions="jpg png jpeg">
                    </div>
                    <div class="form-group">
                        @if ($student->photo == null)
                            <a data-fancybox="gallery" href="{{ $student->avatar_url }}">
                                <img alt="image" src="{{ $student->avatar_url }}" class="img-thumbnail" width="100">
                            </a>
                        @else
                            <a data-fancybox="gallery" href="{{ $student->photo }}">
                                <img alt="image" src="{{ $student->photo }}" class="img-thumbnail" width="100">
                            </a>
                        @endif
                    </div>
                    <button class="btn btn-block btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</section>
<div class="float-right">
    <button type="button" onclick="Delete(this.id)"  id="{{ $student->id }}" class="btn btn-danger">
        Hapus Data
    </button>
</div>
@endsection

@push('plugin-js')
    <script src="{{ asset('vendors/modules/dropify/dropify.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script src="{{ asset('vendors/modules/sweetalert/sweetalert.min.js') }}"></script>
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
    function Delete(id) {
            swal({
                title: 'Apakah kamu yakin?',
                text: 'Apakah Anda ingin menghapus data ini?',
                icon: 'warning',
                buttons: ['Cancel','Ya, hapus!'],
                closeOnClickOutside: false,
                closeOnEsc: false,
                dangerMode: true,
            }).then(function(isConfirm) {
                if (isConfirm) {
                    //ajax delete
                    jQuery.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    jQuery.ajax({
                        url: "{{ route('student.index') }}/"+id,
                        data: {
                            id : id
                        },
                        type: 'DELETE',
                        success: function (response) {
                            console.log(response);
                            if (response.status === "success") {
                                swal({
                                    title: 'Success!',
                                    text: 'Data successfully removed',
                                    icon: 'success',
                                    timer: 5000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    window.location = "{{ url("student") }}";
                                });
                            } else {
                                swal({
                                    title: 'Failed!',
                                    text: 'Data failed to remove',
                                    icon: 'error',
                                    timer: 5000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    location.reload();
                                });
                            }
                        }
                    });
                } else {
                    return true;
                }
            })
        }
    </script>
</script>
@endpush