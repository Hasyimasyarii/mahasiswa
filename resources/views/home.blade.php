@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Home</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Home</div>
        </div>
    </div>
    <div class="section-body">
        <h2 class="section-title font-weight-bold">SuperAdmin</h2>
        <p class="section-lead font-weight-bold text-dark">Selamat Datang {{ auth()->user()->name }}</p>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-primary">
                    <i class="fas fa-users"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Total Mahasiswa</h4>
                    </div>
                    <div class="card-body">
                      {{ $mahasiswa->count() }}
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
</section>
@endsection