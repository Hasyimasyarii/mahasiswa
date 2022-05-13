@extends('layouts.app')

@push('custom-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
@endpush

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Detail Mahasiswa</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></div>
            <div class="breadcrumb-item"><a href="{{ route('student.index') }}">Mahasiswa</a></div>
            <div class="breadcrumb-item">Detail</div>
        </div>
    </div>
    <section class="section-body">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title text-right">Form Detail Mahasiswa</h4>
                <a href="{{ route('student.index') }}" class="btn btn-primary">Kembali</a>
            </div>
            <div class="card-body">
                <table>
                    <tr>
                        <td>Nama Lengkap</td>
                        <td>: {{ $student->name }}</td>
                    </tr>
                    <tr>
                        <td>NIM</td>
                        <td>: {{ $student->nim }}</td>
                    </tr>
                    <tr>
                        <td>Umur</td>
                        <td>: {{ $student->age }}</td>
                    </tr>
                    <tr>
                        <td>Jurusan</td>
                        <td>: {{ $student->major }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>: {{ $student->address }}</td>
                    </tr>
                    <tr>
                        <td>Foto</td>
                        <td>: 
                            @if ($student->photo == null)
                                <a data-fancybox="gallery" href="{{ $student->avatar_url }}">
                                    <img alt="image" src="{{ $student->avatar_url }}" class="rounded-circle" width="30">
                                </a>
                            @else
                                <a data-fancybox="gallery" href="{{ $student->photo }}">
                                    <img alt="image" src="{{ $student->photo }}" class="rounded-circle" width="30">
                                </a>
                            @endif
                            
                        </td>
                    </tr>
                    <tr>
                        <td>Dibuat tanggal</td>
                        <td>: {{ Carbon\Carbon::parse($student->created_at)->timezone('Asia/Jakarta')->locale('id_ID')->isoFormat('DD MMMM Y HH:mm:ss A') }} </td>
                    </tr>
                    <tr>
                        <td>Diupdate tanggal</td>
                        <td>: {{ Carbon\Carbon::parse($student->updated_at)->timezone('Asia/Jakarta')->locale('id_ID')->isoFormat('DD MMMM Y HH:mm:ss A') }} </td>
                    </tr>
                </table>
            </div>
        </div>
    </section>
</section>
@endsection

@push('plugin-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
@endpush