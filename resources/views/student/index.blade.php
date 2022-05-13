@extends('layouts.app')

@push('plugin-css')
    <link rel="stylesheet" href="{{ asset('vendors/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/modules/datatables/dataTables.bootstrap4.min.css') }}">
@endpush

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Mahasiswa</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></div>
            <div class="breadcrumb-item">Mahasiswa</div>
        </div>
    </div>
    <section class="section-body">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title text-right">Daftar Mahasiswa</h4>
            </div>
            <div class="card-body">
                <select id="status" name="status" class="form-control mb-2" style="width: 200px">
                    <option value="">--Filter Jurusan--</option>
                    @php
                        $major = ['Teknik Informatika', 'Sistem Informasi', 'Akutansi', 'Manajemen'];
                    @endphp
                    @foreach ($major as $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
                <div class="table-responsive">
                    <table class="table table-striped datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jurusan</th>
                                <th>Foto</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</section>
@endsection

@push('plugin-js')
    <script src="{{ asset('vendors/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('vendors/modules/datatables/dataTables.bootstrap4.min.js') }}"></script>
@endpush

@push('custom-js')
    <script>
        var table = $('.datatable').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            info: true,
            filter: true,
            ajax:  {
                url : "{{ route('student.index') }}",
                data: function (d) {
                    d.status = $('#status').val(),
                    d.search = $('input[type="search"]').val()
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'major', name: 'major'},
                {
                    data: 'photo_profile', 
                    name: 'photo_profile',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            language: {
                search: "Cari Mahasiswa"
            }
        });
        $('#status').change(function(){
            table.draw();
        });
    </script>
@endpush