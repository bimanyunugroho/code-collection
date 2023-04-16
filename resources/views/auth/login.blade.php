@extends('welcome')

@section('auth')
<div class="row">
    <div class="col-lg-6 d-none d-lg-block bg-login-image">
        <div class="d-flex align-content-center flex-wrap justify-content-center my-4">
            <span class="font-weight-bolder text-center m-0 badge badge-primary">Agar gambar bisa terganti tekan <b>CTRL + SHIFT + R</b></span>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
            </div>
            <form class="user" method="POST" action="{{ route('login') }}">
                @csrf
                @method('POST')
                <div class="form-group">
                    <input type="text" name="username" id="username" class="form-control form-control-user"
                        placeholder="Enter email/username..." required autocomplete="false" autofocus>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input type="password" class="form-control form-control-user"
                            id="exampleInputPassword" placeholder="Password" name="password" required autocomplete="false">
                        <div class="input-group-append">
                            <span class="input-group-text" id="password-toggle"><i class="fas fa-eye"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="remember">{{ __('Remember me') }}</label>
                    </div>
                </div>

                <button class="btn btn-primary btn-block btn-user" type="submit">Login</button>
            </form>
            <hr>
            <div class="text-center">
                <a class="small btnForgot" href="#">Lupa Password?</a>
            </div>
            <div class="text-center">
                <a class="small" href="{{ route('register.index') }}">Buat akun baru!</a>
            </div>
        </div>
    </div>
</div>
@endsection
@push('styles')
<style>
    // Do something
</style>
@endpush
@push('scripts-login-register')
<script>
    $(document).ready(function() {
        $('.btnForgot').on('click', function() {
            Swal.fire(
                'Oops!',
                '<b>Lupa password</b>, masih dalam pengembangan kami!',
                'warning'
            );
        });

        $('#password-toggle').on('click', function() {
            var passwordField = $('#exampleInputPassword');
            var passwordFieldType = passwordField.attr('type');
            if (passwordFieldType == 'password') {
                passwordField.attr('type', 'text');
                $(this).html('<i class="fas fa-eye-slash"></i>');
            } else {
                passwordField.attr('type', 'password');
                $(this).html('<i class="fas fa-eye"></i>');
            }
        });
    });
</script>
@endpush
