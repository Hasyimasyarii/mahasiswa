@extends('layouts.auth')

@section('content')

<div class="d-flex flex-wrap align-items-stretch">
    <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
      <div class="p-4 m-3">

        <h4 class="text-dark font-weight-normal">Selamat Datang di <span class="font-weight-bold">Manajemen Kelas</span></h4>
        <p class="text-muted">Sebelum anda masuk ke halaman website ini , anda harus login terlebih dahulu</p>
        <form class="form" method="POST" action="{{ route('login') }}" autocomplete="off">
          @csrf

          <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"   autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="form-group">
            <div class="d-block">
              <label for="password" class="control-label">Password</label>
              <div class="input-group">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" autocomplete="password" name="password">
                <div class="input-group-append">
                    <button class="btn btn-sm btn-primary" type="button">
                        <span toggle="#password" class="fa fa-eye field-icon toggle-password"></span>
                    </button>
                </div>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
              </div>
            </div>
          </div>

          {{-- <div class="form-group">
            <div class="custom-control custom-checkbox">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                    {{ __('Ingat Saya') }}
                </label>
            </div>
          </div> --}}

          <div class="form-group text-right">
            <button type="submit" class="btn btn-primary btn-lg btn-icon btn-block" tabindex="4">
              Login
            </button>
          </div>

        </form>
   
      </div>
    </div>
    <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom" data-background="{{ asset('vendors/img/unsplash/login-bg.jpg') }}">
      <div class="absolute-bottom-left index-2">
      </div>
    </div>
  </div>
@endsection

@push('custom-js')
    <script>
      $(".toggle-password").click(function() {
          $(this).toggleClass("fa-eye fa-eye-slash");
          let input = $($(this).attr("toggle"));
          if (input.attr("type") === "password") {
              input.attr("type", "text");
          } else {
              input.attr("type", "password");
          }
      });
    </script>
@endpush