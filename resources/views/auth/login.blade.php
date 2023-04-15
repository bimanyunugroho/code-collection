@extends('welcome')

@section('auth')
<div class="row">
    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
    <div class="col-lg-6">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
            </div>
            <form class="user" method="POST" action="{{ route('login') }}">
                @csrf
                @method('POST')
                <div class="form-group">
                    <input type="email" class="form-control form-control-user"
                        id="exampleInputEmail" aria-describedby="emailHelp"
                        placeholder="Enter Email Address..." name="email" required autocomplete="false" autofocus>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control form-control-user"
                        id="exampleInputPassword" placeholder="Password" name="password" required autocomplete="false">
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember
                            Me</label>
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
    });
</script>
@endpush