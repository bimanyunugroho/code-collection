@extends('welcome')

@section('auth')
<div class="row">
    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
    <div class="col-lg-7">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Daftar Sekarang!</h1>
            </div>
            <form class="user" action="{{ route('register') }}" method="POST">
                @csrf
                @method('POST')
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" class="form-control form-control-user first_name" id="exampleFirstName"
                            placeholder="First Name" name="first_name" required autocomplete="false" autofocus value="{{ old('first_name') }}">
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user last_name" id="exampleLastName"
                            placeholder="Last Name" name="last_name" required autocomplete="false" value="{{ old('last_name') }}">
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control form-control-user username" id="exampleInputUsername"
                        placeholder="Username by generate" name="username" @readonly(true) value="{{ old('username') }}">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                        placeholder="Email Address" name="email" required autocomplete="false" value="{{ old('email') }}">
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="password" required>
                    </div>
                    <div class="col-sm-6">
                        <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password" name="password_confirmation" required>
                    </div>
                </div>
                <button class="btn btn-primary btn-user btn-block" type="submit">Register</button>
            </form>
            <hr>
            <div class="text-center">
                <a class="small" href="{{ route('login.index') }}">Sudah punya akun? Login!</a>
            </div>
        </div>
    </div>
</div>
@endsection
@push('styles')
<style>
    .is-valid {
        border-color: #28a745 !important;
    }
    .is-invalid {
        border-color: #dc3545 !important;
    }

</style>
@endpush
@push('scripts-login-register')
<script>
    $(document).ready(function() {
        $('.first_name, .last_name').on('input', function() {
            var first_name = $('.first_name').val();
            var last_name = $('.last_name').val();
            var full_name = first_name + '_' + last_name;

            var username = full_name.replace(/\s+/g, '').toLowerCase();
            console.log(username);
            $('.username').val(username);
        });

        $('input[name="password_confirmation"]').on('input', function() {
            var password = $('input[name="password"]').val();
            var password_confirmation = $('input[name="password_confirmation"]').val();

            if (password === password_confirmation) {
                $('input[name="password_confirmation"]').removeClass('is-invalid').addClass('is-valid');
            } else {
                $('input[name="password_confirmation"]').removeClass('is-valid').addClass('is-invalid');
            }
        });
    });
</script>
@endpush